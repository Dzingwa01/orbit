<?php

namespace App\Http\Controllers;

use App\LeaveRequest;
use App\ShiftOffer;
use App\ShiftSchedule;
use App\SwapShift;
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
                return '<a href="shifts/' . $shift->id . '" title="View Shift" class=""><i class="glyphicon glyphicon-eye-open"></i></a><a href="shifts/' . $shift->id . '/edit" style="margin-left:1em" title="Edit Shift" class=""><i class="glyphicon glyphicon-edit"></i></a><a href="delete_shift/' . $shift->id . '" style="margin-left:1em" class="" title="Delete Shift"><i class="glyphicon glyphicon-trash "></i></a>';
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
            ->select('shift_schedules.id','shift_title','team_name','start_date','end_date','creator_id','team_id','shift_description','start_time','end_date','end_time')

            ->get();
        return response()->json(["shifts" => $current_shift]);
    }

    public function storeShiftSwapApi(Request $request){
//        dd($request->all());
        DB::beginTransaction();
        try {
            $swap_shift = SwapShift::create($request->all());
            DB::commit();
            return response()->json(["status" => "200", "message" => "Shift Offer request submitted successfuly", "swap_response" => $swap_shift]);

        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }
    }
    public function createLeaveRequest(Request $request){
        DB::beginTransaction();
        try {
            $input = $request->all();
            $start_date = Carbon::parse($input['off_start_date'])->format('Y-m-d');
            $end_date = Carbon::parse($input['off_end_date'])->format('Y-m-d');
            $input['off_start_date'] = $start_date;
            $input['off_end_date'] = $end_date;
            $leave_request = LeaveRequest::create($input);

            DB::commit();
            return response()->json(["status" => "200", "message" => "Shift Offer request submitted successfuly", "request_response" => $leave_request]);

        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }
    }

    public function getSwapRequests(User $user){
        $current_date = Carbon::now()->format('Y-m-d');

        $swap_requests = SwapShift::join('users','users.id','swap_shifts.requestor_id')
                        ->join('shift_schedules','shift_schedules.id','swap_shifts.swap_shift')
                        ->where('swap_shifts.employee_id',$user->id)
                        ->where('shift_schedules.shift_date','>=',$current_date)
                        ->select('swap_shifts.*','users.name','users.surname','shift_date')
                        ->get();
        $requests = array();
        foreach ($swap_requests as $swap_requested){
//            dd($swap_requested->with_shift);
            $exchange_shift = ShiftSchedule::where('shift_schedules.id',$swap_requested->with_shift)
                             ->select('shift_schedules.*','shift_date')
                            ->first();
//            dd($exchange_shift);
            $swap_requested->with_shift = $exchange_shift->shift_date;
            array_push($requests,$swap_requested);
        }
//        dd($swap_requests);
        $swap_requests = $requests;
        return response()->json(['swap_requests'=>$swap_requests]);
    }

    public function getOffRequests(User $user){
        $current_date = Carbon::now()->format('Y-m-d');
        $off_requests =  ShiftOffer::join('users','users.id','shift_offers.employee_id')
                        ->join('shift_schedules','shift_schedules.id','shift_offers.offer_shift')
                        ->where('team_member',$user->id)
                        ->where('shift_schedules.shift_date','>=',$current_date)
                        ->select('shift_offers.*','users.name','users.surname','shift_date')
                        ->get();
        return response()->json(['off_requests'=>$off_requests]);
    }

    public function storeShiftOfferApi(Request $request){
        DB::beginTransaction();
        try {
            $offer_shift = ShiftOffer::create($request->all());
            DB::commit();
            return response()->json(["status" => "200", "message" => "Swap request submitted successfuly", "offer_response" => $offer_shift]);

        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }
    }

    public function getCurrentShifts(User $user){
        $current_date = Carbon::now()->format('Y-m-d');
//        dd($current_date);
//        dd($user->id);
        $current_shift = ShiftSchedule::join('shifts','shifts.id','shift_schedules.shift_id')
            ->join('teams','teams.id','shifts.team_id')
            ->where('shift_schedules.employee_id',$user->id)
            ->where('shift_schedules.shift_date','>=',$current_date)
            ->select('shift_schedules.id','employee_id','shift_schedules.shift_id','shift_title','start_date','shifts.end_date','creator_id','team_id','shift_duration','start_time','end_time','shift_description','team_name','shift_date')
            ->get();
        return response()->json(["shifts" => $current_shift]);
    }

    public function getCurrentAvailableTeamMembers(User $user,ShiftSchedule $shift_schedule){
        $current_date = Carbon::now()->format('Y-m-d');
        $employee_shifts = ShiftSchedule::where('shift_id','=',$shift_schedule->shift_id)
            ->where('employee_id',$user->id)->pluck('shift_date');
        $current_shift = ShiftSchedule::join('shifts','shifts.id','shift_schedules.shift_id')
            ->join('teams','teams.id','shifts.team_id')
            ->join('users','users.id','shift_schedules.employee_id')
            ->where('shifts.id',$shift_schedule->shift_id)
            ->where('shift_schedules.employee_id','!=',$user->id)
            ->where('shift_schedules.shift_date','!=',$shift_schedule->shift_date)
            ->where('shift_schedules.shift_date','>',$current_date)
            ->select('users.*','employee_id','shift_schedules.shift_date')
            ->whereNotIn('shift_date',$employee_shifts)
            ->get();
        return response()->json(["employees" => $current_shift]);
    }

    public function getCurrentTeamMemberShifts(User $user,ShiftSchedule $shift_schedule){
        $current_date = Carbon::now()->format('Y-m-d');
//        dd($shift_schedule);
        $employee_shifts = ShiftSchedule::where('shift_id','=',$shift_schedule->shift_id)
                            ->where('employee_id',$user->id)->pluck('shift_date');

        $current_shift = ShiftSchedule::join('shifts','shifts.id','shift_schedules.shift_id')
            ->join('teams','teams.id','shifts.team_id')
            ->join('users','users.id','shift_schedules.employee_id')
            ->where('shifts.id',$shift_schedule->shift_id)
            ->where('shift_schedules.employee_id','!=',$user->id)
            ->where('shift_schedules.shift_date','>',$current_date)
            ->select('shift_schedules.id','shift_schedules.shift_id','name','surname','shift_title','start_date','shifts.end_date','shifts.creator_id','team_id','shift_duration','employee_id','start_time','end_time','shift_description','team_name','shift_date')
            ->whereNotIn('shift_date',$employee_shifts)
            ->get();
        return response()->json(["shifts" => $current_shift]);
    }


    public function getCurrentShiftsManager(User $user){
        $current_date = Carbon::now()->format('Y-m-d');
        $current_shifts = ShiftSchedule::join('shifts','shifts.id','shift_schedules.shift_id')
            ->where('shifts.creator_id',$user->id)
            ->where('shift_schedules.shift_date','=',$current_date)
            ->select('shift_schedules.id','shift_title','start_date','end_date','creator_id','team_id','shift_description','start_time','end_date','end_time')

            ->get();
        $current_temp = array();
        $current_temp_2 = array();
        foreach($current_shifts as $current_shift){
            if(!in_array($current_shift->start_date,$current_temp)){
                array_push($current_temp,$current_shift->start_date);
                array_push($current_temp_2,$current_shift);
            }
        }
        $current_shifts = $current_temp_2;
        return response()->json(["shifts" => $current_shifts]);
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
