<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Permission;
use Yajra\Datatables\Datatables;
use DB;

class PermissionsController extends Controller
{
    //
    public function index(){
//        dd(Role::all());
        return view('authentication.permissions_index');

    }

    public function createPermission(){
        return view('authentication.create_permission');
    }

    public function savePermission(Request $request){
//        dd($request->all());
        DB::beginTransaction();
        try {
            $role = Permission::create($request->all());
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;

        }
        return redirect('permissions');
    }
    public function getPermissions()
    {
        $permissions = Permission::all();
        return DataTables::of($permissions)
            ->addColumn('action', function ($permission) {
                return '<a href="view_user/' . $permission->_id . '" title="View Role" class="btn btn-xs btn-success"><i class="glyphicon glyphicon-eye-open"></i></a><a href="edit_role/' . $permission->_id . '" style="margin-left:0.5em" title="Edit User" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i></a><a href="delete/' . $permission->_id . '" style="margin-left:0.5em" class="btn btn-xs btn-danger" title="Delete User"><i class="glyphicon glyphicon-trash "></i></a>';
            })
            ->make(true);
    }
}
