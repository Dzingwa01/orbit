<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Role;
use Yajra\Datatables\Datatables;
use DB;

class RolesController extends Controller
{
    //
    public function index(){
//        dd(Role::all());
        return view('authentication.index');

    }

    public function createRole(){
        return view('authentication.create_role');
    }

    public function saveRole(Request $request){
//        dd($request->all());
        DB::beginTransaction();
        try {
            $role = Role::create($request->all());
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;

        }
        return redirect('roles');
    }
    public function getRoles()
    {
        $roles = Role::all();
        return DataTables::of($roles)
            ->addColumn('action', function ($role) {
                return '<a href="view_user/' . $role->_id . '" title="View Role" class="btn btn-xs btn-success"><i class="glyphicon glyphicon-eye-open"></i></a><a href="edit_role/' . $role->_id . '" style="margin-left:0.5em" title="Edit User" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i></a><a href="delete/' . $role->_id . '" style="margin-left:0.5em" class="btn btn-xs btn-danger" title="Delete User"><i class="glyphicon glyphicon-trash "></i></a>';
            })
            ->make(true);
    }

}
