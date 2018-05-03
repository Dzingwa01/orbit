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

    public function updatePermission(Request $request,Permission $permission){
        DB::beginTransaction();
        try {
            $permission = $permission->update($request->all());
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }
        return redirect('permissions');
    }

    public function editPermission(Permission $permission){
        return view('authentication.edit_permission',compact('permission'));
    }
    public function viewPermission(Permission $permission){
        return view('authentication.view_permission',compact('permission'));
    }
    public function getPermissions()
    {
        $permissions = Permission::all();
        return DataTables::of($permissions)
            ->addColumn('action', function ($permission) {
                return '<a href="view_permission/'. $permission->id . '" title="View Permission" class=""><i class="glyphicon glyphicon-eye-open"></i></a><a href="edit_permission/' . $permission->id . '" style="margin-left:1em" title="Edit Permission" class=""><i class="glyphicon glyphicon-edit"></i></a><a href="delete_permission/' . $permission->id . '" style="margin-left:1em" class="" title="Delete Permission"><i class="glyphicon glyphicon-trash "></i></a>';
            })
            ->make(true);
    }

    public function deletePermission(Permission $permission){
        $permission->delete();
        return redirect('permissions');
    }
}
