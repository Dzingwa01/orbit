<?php

namespace App\Http\Controllers;

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
        return view('manager_teams.index');
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
        return redirect('manager_teams');
    }
}
