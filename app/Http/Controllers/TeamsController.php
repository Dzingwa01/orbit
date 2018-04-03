<?php

namespace App\Http\Controllers;

use App\Jobs\InviteTeamMembers;
use App\TeamMember;
use Illuminate\Http\Request;
use App\Team;
use App\User;
use App\City;
use Illuminate\Support\Facades\Auth;
use Yajra\Datatables\Datatables;
use DB;

class TeamsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $employee_count = count(User::where('creator_id',Auth::user()->id)->get());
        return view('teams.index',compact('employee_count'));
    }

    public function getTeams(){
        $teams = DB::table('teams')
                ->join('users','users.id','teams.creator')
                ->join('cities','teams.city_id','cities.id')
                ->select('teams.*','users.name','users.surname','cities.city_name');
        return DataTables::of($teams)
            ->addColumn('action', function ($team) {
                return '<a href="team/' . $team->id . '" title="View Team" class="btn btn-xs btn-success"><i class="glyphicon glyphicon-eye-open"></i></a><a href="team/' . $team->id . '/edit" style="margin-left:0.5em" title="Edit Team" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i></a><a href="delete_team/' . $team->id . '" style="margin-left:0.5em" class="btn btn-xs btn-danger" title="Delete Team"><i class="glyphicon glyphicon-trash "></i></a>';
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
        $users = User::all();
        $cities = City::all();
        $employee_count = count(User::where('creator_id',Auth::user()->id)->get());
        return view('teams.create_team',compact('users','cities','employee_count'));
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
        $team_id = '';
        DB::beginTransaction();
        try {
            $team = Team::updateOrCreate($request->all());
            DB::commit();
            return view('teams.team_members',compact('team'));
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }
        return redirect('team');
    }

    public function managersTeamMembers(Request $request){
        $input = $request->all();
        $team_id = $input['team_id'];
        $team_members= array_values(array_except($input,['_token','team_id']));
//        dd($team_members);
        foreach($team_members as $key) {
            DB::beginTransaction();
            try {
            $user = User::where('id',$key)->first();
            $email_token = base64_encode($user->email);
            $team_member = TeamMember::create(['member_team_id'=>$team_id,'team_member_id'=>$key,'email_token'=>$email_token,'verified'=>0]);
            DB::commit();
            event($user);
            dispatch(new InviteTeamMembers($team_member));
            } catch (\Exception $e) {
                DB::rollback();
                throw $e;
            }
        }
        return redirect('manager_teams');
    }

    public function acceptTeamMember($email_token){
        $user = TeamMember::where('email_token', $email_token)->first();
        $user->verified = 1;
        if ($user->save()) {
            return view('emails.team_member_invite_success', ['user' => $user]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Team $team)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Team $team)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Team $team)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Team $team)
    {
        //
        $team->delete();
        return redirect('team');
    }
}
