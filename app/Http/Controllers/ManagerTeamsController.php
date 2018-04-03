<?php

namespace App\Http\Controllers;

use App\Jobs\InviteTeamMembers;
use App\Jobs\TeamRemovals;
use App\TeamMember;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Team;
use App\User;
use App\City;
use Yajra\Datatables\Datatables;
use DB;

class ManagerTeamsController extends Controller
{
    public function index()
    {
        //
        $employee_count = count(User::where('creator_id',Auth::user()->id)->get());
        return view('manager_teams.index',compact('employee_count'));
    }

    public function getTeams(){
        $teams = DB::table('teams')
            ->join('users','users.id','teams.creator')
            ->join('cities','teams.city_id','cities.id')
            ->where('users.id',Auth::user()->id)
            ->select('teams.*','users.name','users.surname','cities.city_name')->get();
        return DataTables::of($teams)
            ->addColumn('action', function ($team) {
                return '<a href="manager_teams/' . $team->id . '" title="View Team" class="btn btn-xs btn-success"><i class="glyphicon glyphicon-eye-open"></i></a><a href="manager_teams/' . $team->id . '/edit" style="margin-left:0.5em" title="Edit Team" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i></a><a href="manager_delete_team/' . $team->id . '" style="margin-left:0.5em" class="btn btn-xs btn-danger" title="Delete Team"><i class="glyphicon glyphicon-trash "></i></a>';
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
//        dd($users);
        return view('manager_teams.create_team',compact('users','cities'));
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
//        dd($request);
        $team_id = '';
        DB::beginTransaction();
        try {
            $team = Team::create($request->all());
            DB::commit();

        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }
        return view('manager_teams.team_members',compact('team'));
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
//        dd($team);
        $team = Team::where('id',$id)->first();
        $team_members = TeamMember::join('users','users.id','team_members.team_member_id')
                        ->join('teams','teams.id','team_members.member_team_id')
                        ->select('users.*')
            ->where('teams.id',$id)
                        ->get();
//        dd($team_members);
        $cities = City::all();
        return view('manager_teams.view',compact('team','cities','team_members'));
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
        $team = Team::where('id',$id)->first();
        $team_members = TeamMember::join('users','users.id','team_members.team_member_id')
            ->join('teams','teams.id','team_members.member_team_id')
            ->where('teams.id',$id)
            ->select('users.*')
            ->get();
        $team_member_ids = TeamMember::join('users','users.id','team_members.team_member_id')
            ->join('teams','teams.id','team_members.member_team_id')
            ->where('teams.id',$id)
            ->pluck('users.id');
//        dd($team_member_ids);

        $available_team_members = Team::join('users','users.creator_id','teams.creator')
            ->where('teams.id',$id)
            ->whereNotIn('users.id',$team_member_ids)
            ->select('users.*')
            ->get();
        $cities = City::all();
        return view('manager_teams.edit',compact('team','cities','team_members','available_team_members'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $team_cur = Team::where('id',$id)->first();

        DB::beginTransaction();
        try {
            $team = $team_cur->update($request->all());
            DB::commit();
//            dd($team);
            $team_members = TeamMember::join('users','users.id','team_members.team_member_id')
                ->join('teams','teams.id','team_members.member_team_id')
                ->where('teams.id',$id)
                ->select('users.*')
                ->get();

            $team_member_ids = TeamMember::join('users','users.id','team_members.team_member_id')
                ->join('teams','teams.id','team_members.member_team_id')
                ->where('teams.id',$id)
                ->pluck('users.id');

            $available_team_members = Team::join('users','users.creator_id','teams.creator')
                ->where('teams.id',$id)
                ->whereNotIn('users.id',$team_member_ids)
                ->select('users.*')
                ->get();
            $cities = City::all();
            return view('manager_teams.edit',compact('team','cities','team_members','available_team_members'));
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }
        return view('manager_teams.team_members',compact('team'));
    }

    public function updateTeamMembers(Request $request){
//        dd($request->all());
        $input = $request->all();
//        dd($input);
        $team_id = $input['team_id'];
        $cur_team = Team::where('id',$team_id)->first();
        $team_members= array_values(array_except($input,['_token','team_id']));
//        dd($team_members);
        $cur_team_members = TeamMember::where('member_team_id',$team_id)->pluck('team_member_id')->toArray();
//        dd(in_array(62,$cur_team_members));
        foreach ($cur_team_members as $key){
            if(!in_array($key,$team_members)){
                $user = User::where('id',$key)->first();
//                dd($user);
               TeamMember::where('team_member_id',$key)->delete();
                event($user);
                dispatch(new TeamRemovals($user,$cur_team->team_name));
            }
        }

        foreach($team_members as $key) {
            DB::beginTransaction();
            try {
                $cur_team_member = TeamMember::where('team_member_id',$key)->where('member_team_id',$team_id)->first();
                if($cur_team_member==null){
                    $user = User::where('id',$key)->first();
                    $email_token = base64_encode($user->email);
                    $team_member= TeamMember::create(['member_team_id'=>$team_id,'team_member_id'=>$key,'email_token'=>$email_token,'verified'=>0]);
//                    dd($team_member);
                    DB::commit();
                    event($user);
                    dispatch(new InviteTeamMembers($team_member));
                }

            } catch (\Exception $e) {
                DB::rollback();
                throw $e;
            }

        }
        $team_members = TeamMember::join('users','users.id','team_members.team_member_id')
            ->join('teams','teams.id','team_members.member_team_id')
            ->where('teams.id',$team_id)
            ->select('users.*')
            ->get();
        $team_member_ids = TeamMember::join('users','users.id','team_members.team_member_id')
            ->join('teams','teams.id','team_members.member_team_id')
            ->where('teams.id',$team_id)
            ->pluck('users.id');
        $available_team_members = Team::join('users','users.creator_id','teams.creator')
            ->where('teams.id',$team_id)
            ->whereNotIn('users.id',$team_member_ids)
            ->select('users.*')
            ->get();
        $cities = City::all();
        $team = Team::where('id',$team_id)->first();
        return view('manager_teams.edit',compact('team','cities','team_members','available_team_members'));
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
        return redirect('manager_teams');
    }
}
