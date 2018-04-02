<?php

namespace App\Http\Controllers;

use App\Role;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Calendar;
use App\Shift;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        $role = Role::where('id',$user->role_id)->first();
//        dd($role);
        if($role->name =="Manager"){
            $events = [];
            $data = Shift::where('creator_id',Auth::user()->id)->get();
            if($data->count()) {
                foreach ($data as $key => $value) {
                    $events[] = Calendar::event(
                        $value->shift_title,
                        true,
                        new \DateTime($value->start_date),
                        new \DateTime($value->end_date),
                        null,
                        // Add color and link on event
                        [
                            'color' => '#f05050',
                            'url' => 'shifts/'.$value->id,
                        ]
                    );
                }
            }
            $calendar = Calendar::addEvents($events);
            return view('manager',compact('role','calendar'));
        }
        else if($role->name == "Employee"){
            $events = [];
            $data = Shift::join('team_members','team_members.member_team_id','shifts.team_id')
                    ->join('users','users.id','team_members.team_member_id')
                    ->where('users.id',Auth::user()->id)
                    ->select('shifts.*')
                    ->get();

            if($data->count()) {
                foreach ($data as $key => $value) {
                    $events[] = Calendar::event(
                        $value->shift_title,
                        true,
                        new \DateTime($value->start_date),
                        new \DateTime($value->end_date),
                        null,
                        // Add color and link on event
                        [
                            'color' => '#f05050',
                            'url' => '',
                        ]
                    );
                }
            }
            $calendar = Calendar::addEvents($events);
            return view('employee',compact('role','calendar'));
        }
        else{
            return view('home',compact('role'));
        }

    }


}
