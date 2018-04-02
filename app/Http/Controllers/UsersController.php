<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Role;
use Yajra\Datatables\Datatables;
use DB;
use App\Package;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('users.index');
    }

    public function getUsers(){
        $users = DB::table('users')
                ->join('packages','packages.id','users.package_id')
                ->select('users.*','packages.package_name')->get();
        return DataTables::of($users)
            ->addColumn('action',function($user){
                return '<a href="user/' . $user->id . '" title="View User" class="btn btn-xs btn-success"><i class="glyphicon glyphicon-eye-open"></i></a><a href="user/' . $user->id . '/edit" style="margin-left:0.5em" title="Edit User" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i></a><a href="delete_user/' . $user->id . '" style="margin-left:0.5em" class="btn btn-xs btn-danger" title="Delete User"><i class="glyphicon glyphicon-trash "></i></a>';
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
        $roles = Role::all();
        $packages = Package::all();
        return view('users.create_user',compact('roles','packages'));
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
        return redirect('user');
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
        return view('users.view',compact('roles','user','packages'));
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
        return view('users.edit',compact('roles','user','packages'));
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

        return redirect('/user');
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
        return redirect('/user');
    }
}
