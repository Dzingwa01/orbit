<?php

namespace App\Http\Controllers;

use App\ShiftSchedule;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Shift;
use Yajra\Datatables\Datatables;
use DB;
use App\Team;
use App\TeamMember;

class ShiftsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('shifts.index');
    }

    public function getShifts(){
        $shifts = Shift::where('creator_id',Auth::user()->id)->get();
        return DataTables::of($shifts)
            ->addColumn('action', function ($shift) {
                return '<a href="shifts/' . $shift->id . '" title="View Shift" class="btn btn-xs btn-success"><i class="glyphicon glyphicon-eye-open"></i></a><a href="shifts/' . $shift->id . '/edit" style="margin-left:0.5em" title="Edit Shift" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i></a><a href="delete_shift/' . $shift->id . '" style="margin-left:0.5em" class="btn btn-xs btn-danger" title="Delete Shift"><i class="glyphicon glyphicon-trash "></i></a>';
            })
            ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $teams = Team::where('creator',Auth::user()->id)->get();
        return view('shifts.create',compact('teams'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
//        dd($request->all());
        DB::beginTransaction();
        try {
            $shift = Shift::create($request->all());
            DB::commit();
            return view('shifts.assign_dates',compact('shift'));

        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }
       return redirect('shifts');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $shift = Shift::where('id',$id)->first();
        $teams = Team::where('creator',Auth::user()->id)->get();
        $team_members = TeamMember::join('users','users.id','team_members.team_member_id')
            ->join('teams','teams.id','team_members.member_team_id')
            ->where('teams.id',$shift->team_id)
            ->where('creator_id',Auth::user()->id)
            ->select('users.*')
            ->get();
        return view('shifts.view',compact('shift','teams','team_members'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $shift = Shift::where('id',$id)->first();

        $teams = Team::where('creator',Auth::user()->id)->get();
        $team_members = TeamMember::join('users','users.id','team_members.team_member_id')
            ->join('teams','teams.id','team_members.member_team_id')
            ->where('teams.id',$shift->team_id)
            ->where('creator_id',Auth::user()->id)
            ->select('users.*')
            ->get();
        return view('shifts.edit',compact('shift','teams','team_members','team'));
    }
    public function getCurrentShift(User $user){
        $current_date = Carbon::now()->format('Y-m-d');
//        dd($user->id);
        $current_shift = ShiftSchedule::join('shifts','shifts.id','shift_schedules.shift_id')
            ->join('teams','teams.id','shifts.team_id')
            ->where('shift_schedules.employee_id',$user->id)
            ->where('shift_schedules.shift_date','=',$current_date)
            ->select('shifts.*','team_name')
            ->get();
        return response()->json(["shifts" => $current_shift]);
    }

    public function getCurrentShifts(User $user){
        $current_date = Carbon::now()->format('Y-m-d');
//        dd($user->id);
        $current_shift = ShiftSchedule::join('shifts','shifts.id','shift_schedules.shift_id')
            ->join('teams','teams.id','shifts.team_id')
            ->where('shift_schedules.employee_id',$user->id)
            ->where('shift_schedules.shift_date','>=',$current_date)
            ->select('shifts.*','team_name','shift_date')
            ->get();
        return response()->json(["shifts" => $current_shift]);
    }

    public function getCurrentShiftsManager(User $user){
        $current_date = Carbon::now()->format('Y-m-d');
//        dd($user->id);
        $current_shift = ShiftSchedule::join('shifts','shifts.id','shift_schedules.shift_id')
            ->where('shifts.creator_id',$user->id)
            ->where('shift_schedules.shift_date','=',$current_date)
            ->select('shifts.*')
            ->distinct()
            ->get();
        return response()->json(["shifts" => $current_shift]);
    }

    public function getCurrentShiftsManagerAll(User $user){
        $current_date = Carbon::now()->format('Y-m-d');
        $current_shift = ShiftSchedule::join('shifts','shifts.id','shift_schedules.shift_id')
            ->where('shifts.creator_id',$user->id)
            ->where('shift_schedules.shift_date','>=',$current_date)
            ->select('shifts.*')
            ->distinct()
            ->get();
        return response()->json(["shifts" => $current_shift]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Shift $shift)
    {
        $input = $request->all();
        $input_team_members = array_except($input,['shift_title','creator_id','start_date','end_date','_token','shift_duration','team_id']);
        $team_cur = Team::where('id',$input['team_id'])->first();
        $cur_members = TeamMember::where('member_team_id',$team_cur->id)->get();
        DB::beginTransaction();
        try {
            $shift = $shift->update($request->all());
            foreach ($cur_members as $member)
            {
                $member->delete();
            }
            foreach($input_team_members as $key) {
                $user = User::where('id',$key)->first();
                $email_token = base64_encode($user->email);
                TeamMember::create(['member_team_id'=>$team_cur->id,'team_member_id'=>$key,'email_token'=>$email_token,'verified'=>0]);
            }
            DB::commit();

        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }
        return redirect('schedules');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Shift $shift)
    {
        //
        $shift->delete();
        return redirect('shifts');
    }
}
