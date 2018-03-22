<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\EmployeeRole;
use Illuminate\Support\Facades\Auth;
use Yajra\Datatables\Datatables;
use DB;

class EmployeeRolesController extends Controller
{
    public function index(){
//        dd(EmployeeRole::all());
        return view('employee_roles.index');
    }

    public function createRole(){
        return view('employee_roles.create_role');
    }

    public function saveRole(Request $request){
        DB::beginTransaction();
        try {
            $role = EmployeeRole::create($request->all());
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }
        return redirect('employee_roles');
    }

    public function getRoles()
    {
        $roles = EmployeeRole::where('role_creator',Auth::user()->id)->get();
        return DataTables::of($roles)
            ->addColumn('action', function ($role) {
                return '<a href="employee_view_role/' . $role->id . '" title="View Role" class="btn btn-xs btn-success"><i class="glyphicon glyphicon-eye-open"></i></a><a href="employee_edit_role/' . $role->id . '" style="margin-left:0.5em" title="Edit User" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i></a><a href="employee_delete_role/' . $role->id . '" style="margin-left:0.5em" class="btn btn-xs btn-danger" title="Delete User"><i class="glyphicon glyphicon-trash "></i></a>';
            })
            ->make(true);
    }

    public function updateRole(Request $request,EmployeeRole $role){
        DB::beginTransaction();
        try {
            $role = $role->update($request->all());
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }
        return redirect('employee_roles');
    }

    public function editRole(EmployeeRole $role){
        return view('employee_roles.edit_role',compact('role'));
    }

    public function viewRole(EmployeeRole $role){
        return view('employee_roles.view_role',compact('role'));
    }

    public function deleteRole(EmployeeRole $role){
//        dd($role);
        EmployeeRole::destroy($role->id);
        return redirect('employee_roles');
    }
}
