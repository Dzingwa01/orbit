<?php

namespace App\Http\Controllers;

use App\Jobs\ScheduleInviteMail;
use App\ShiftSchedule;
use App\TeamMember;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Shift;
use Yajra\Datatables\Datatables;
use DB;
use App\Team;

class SchedulerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return redirect('home');
    }

    public function getShifts(){
        $shifts = Shift::all();
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

    public function getTeamEmployeeShifts(Team $team){
        $team_users = TeamMember::join('shift_schedules','shift_schedules.employee_id','team_members.team_member_id')
                    ->join('shifts','shifts.id','shift_schedules.shift_id')
                    ->where('member_team_id',$team->id)
                    ->select('shift_schedules.*','team_members.team_member_id','shifts.start_time','shifts.end_time','shifts.end_date')
                    ->get();
        return response()->json(['employee_schedules'=>$team_users]);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
//        dd($request->all());
        $input = $request->all();
        $input_team_members = array_except($input,['shift_title','creator_id','start_date','end_date','_token','shift_duration','team_id','start_time','end_time','shift_description']);
        $team_cur = Team::where('id',$input['team_id'])->first();
        $cur_members = TeamMember::where('member_team_id',$team_cur->id)->get();
        $team_members_unique =[];

        DB::beginTransaction();
        try {
            $shift = Shift::create($request->all());
            foreach ($cur_members as $member)
            {
                $member->delete();
            }
            foreach($input_team_members as $key=> $member) {
                $current_member = explode('d',$key);
                if(!in_array($member,$team_members_unique)){
                    array_push($team_members_unique,$member);
                }
                $schedule = ShiftSchedule::create(['shift_id'=>$shift->id,'employee_id'=>$current_member[0],'shift_date'=>$current_member[1]]);
            }
            foreach($team_members_unique as $key) {
                $user = User::where('id',$key)->first();
                $email_token = base64_encode($user->email);
                TeamMember::create(['member_team_id'=>$team_cur->id,'team_member_id'=>$key,'email_token'=>$email_token,'verified'=>0]);
                event($user);
                dispatch(new ScheduleInviteMail($user,$team_cur->team_name,$email_token));
            }
            DB::commit();

        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }
        return redirect('home');
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
            ->select('users.*')
            ->get();
        $employee_schedules = ShiftSchedule::where('shift_id',$shift->id)->get();
        return view('shifts.view',compact('shift','teams','team_members','employee_schedules'));
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
        return view('shifts.edit',compact('shift','teams'));
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
        $shift->update($request->all());
        return redirect('shifts');
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
