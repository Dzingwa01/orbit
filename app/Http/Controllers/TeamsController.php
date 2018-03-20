<?php

namespace App\Http\Controllers;

use App\TeamMember;
use Illuminate\Http\Request;
use App\Team;
use App\User;
use App\City;
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
        return view('teams.index');
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
        return view('teams.create_team',compact('users','cities'));
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
            TeamMember::create(['member_team_id'=>$team_id,'team_member_id'=>$key]);
        }
        return redirect('manager_teams');
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
