<?php

namespace App\Http\Controllers;

use App\Role;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Calendar;

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
            $calendar =Calendar();
            return view('manager',compact('role','calendar'));
        }
        else if($role->name == "Employee"){
            return view('employee',compact('role'));
        }
        else{
            return view('home',compact('role'));
        }

    }
}
