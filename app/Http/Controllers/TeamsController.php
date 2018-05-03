<?php

namespace App\Http\Controllers;

use App\Jobs\InviteTeamMembers;
use App\Shift;
use App\TeamMember;
use Carbon\Carbon;
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
            event($team_member);
            dispatch(new InviteTeamMembers($team_member));
            } catch (\Exception $e) {
                DB::rollback();
                throw $e;
            }
        }
        return redirect('manager_teams');
    }

    public function acceptTeamMember($email_token){
//        dd($email_token);
        $user = TeamMember::where('email_token', $email_token)->first();
//        dd($user);
        $user->verified = 1;
        if ($user->save()) {
            return view('emails.team_member_invite_success', ['user' => $user]);
        }
    }

    public function apiGetTeams(User $user){
        $teams = Team::join('cities','cities.id','teams.city_id')->where('creator',$user->id)->select('team_name','city_name','team_description')->get();
        return response()->json(["teams" => $teams]);
    }

    public function getEmployeeTeams(User $user){
       $teams = TeamMember::join('teams','teams.id','team_members.member_team_id')->where('team_member_id',$user->id)->select('teams.*')->get();
        return response()->json(["teams" => $teams]);
    }

    public function storeChatMessage(Request $request){
        $input = $request->all();
        $user_id = $input['user_id'];
        $team = TeamMember::where('team_member_id',$user_id)->first();
        $input['team_id'] = $team->id;
        try {
            $input['picture_url'] = "none";
            if (array_key_exists('image', $input)) {
                $main_picture_url = $request->file('image');
                $dir = "photos/";
                if (File::exists(public_path($dir)) == false) {
                    File::makeDirectory(public_path($dir), 0777, true);
                }
                $img = Image::make($main_picture_url->path());
                $path = "{$dir}" . uniqid() . "." . $main_picture_url->getClientOriginalExtension();
                $img->save(public_path($path));
                $input['picture_url'] = $path;
            }

            $cur_post = Comment::updateOrcreate($input);

            return response()->json(["status" => "200", "message" => "Message published successfully", "message" => $cur_post]);

        } catch (\Exception $e) {
            throw $e;
            return response()->json(["status" => "500", "message" => $e]);
        }
        return [];
    }

    public function getChatMessages(User $user){
        $team = TeamMember::where('team_member_id',$user->id)->first();
        $comments = Comment::where('team_id',$team->id)->orderBy('created_at', 'desc')->get();
        return response()->json(["messages" => $comments, "status" => "203", "message" => "Success"]);
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
