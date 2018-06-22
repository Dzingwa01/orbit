<?php

namespace App\Http\Controllers;

use App\EmployeeRole;
use App\Jobs\InviteEmployees;
use App\TeamMember;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Role;
use Yajra\Datatables\Datatables;
use DB;
use App\Package;

class EmployeesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('employees.index');
    }

    public function getUsers(){
        $users = DB::table('users')
            ->join('packages','packages.id','users.package_id')
            ->where('users.creator_id',Auth::user()->id)
            ->whereNull('users.deleted_at')
            ->select('users.*','packages.package_name')->get();
        return DataTables::of($users)
            ->addColumn('action',function($user){
                return '<a href="employees/' . $user->id . '" title="View Employee" class=""><i class="glyphicon glyphicon-eye-open"></i></a><a href="employees/' . $user->id . '/edit" style="margin-left:1em" title="Edit Employee" class=""><i class="glyphicon glyphicon-edit"></i></a><a href="delete_employee/' . $user->id . '" style="margin-left:1em" class="" title="Delete Employee"><i class="glyphicon glyphicon-trash "></i></a>';
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

        $role = Role::where('name','Employee')->first();
//        dd($role);
        $package = Package::where('package_name','Individual Account')->first();
//        dd($package);
        return view('employees.create_user',compact('role','package'));
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
        DB::beginTransaction();
        try {
            $input = $request->all();
//            dd($input);
            $plain_password =  $input['password'];
            $password = bcrypt($input['password']);
            $input['password'] = $password;
            $input['logins_counter'] = 0;
            $input['verified'] = 0;
            $input['email_token'] = base64_encode($input['email']);
            $user = User::create($input);
//            dd($user);
            DB::commit();
            event($user);
            dispatch(new InviteEmployees($user,$plain_password));

        } catch (\Exception $e) {
            DB::rollback();
            throw $e;

        }
        return redirect('employees');
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
        $user = User::find($id);
        $roles = Role::all();
        $packages = Package::all();
        return view('employees.view',compact('roles','user','packages'));
    }

    public  function apiGetEmployees($id){
        $users = User::where('creator_id',$id)->get();
        return response()->json(["users" => $users]);
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        $roles = Role::all();
        $packages = Package::all();
        return view('employees.edit',compact('roles','user','packages'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $input = $request->all();
        $user = User::find($id);
        if(is_null($input['password'])){
            unset($input['password']);
            $user->update($input);
        }else{
            $password = bcrypt($input['password']);
            $input['password'] = $password;
            $user->update($input);
        }

        return redirect('employees');
    }



    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $user = User::find($id);
        DB::beginTransaction();
        try {
            TeamMember::where('team_member_id',$user->id)->delete();
            $user->delete();
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return redirect('/employees')->with('error','Error occured during deleting the employee');
        }
        return redirect('/employees')->with('status','Employee deleted successfully');
    }
}
