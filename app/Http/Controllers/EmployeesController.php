<?php

namespace App\Http\Controllers;

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
            ->select('users.*','packages.package_name')->get();
        return DataTables::of($users)
            ->addColumn('action',function($user){
                return '<a href="employees/' . $user->id . '" title="View Employee" class="btn btn-xs btn-success"><i class="glyphicon glyphicon-eye-open"></i></a><a href="employees/' . $user->id . '/edit" style="margin-left:0.5em" title="Edit Employee" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i></a><a href="delete_employee/' . $user->id . '" style="margin-left:0.5em" class="btn btn-xs btn-danger" title="Delete Employee"><i class="glyphicon glyphicon-trash "></i></a>';
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
        $role = Role::where('name','Employee')->first();
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
            $password = bcrypt($input['password']);
            $input['password'] = $password;
            $input['logins_counter'] = 0;
            $user = User::create($input);
            DB::commit();
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
        $user->delete();
        return redirect('/employees');
    }
}
