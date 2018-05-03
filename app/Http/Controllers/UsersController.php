<?php

namespace App\Http\Controllers;

use App\Jobs\InviteEmployees;
use Illuminate\Http\Request;
use App\User;
use App\Role;
use Yajra\Datatables\Datatables;
use DB;
use App\Package;
use Image;
use File;

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
                return '<a href="user/' . $user->id . '" title="View User" class=""><i class="glyphicon glyphicon-eye-open"></i></a><a href="user/' . $user->id . '/edit" style="margin-left:1em" title="Edit User" class=""><i class="glyphicon glyphicon-edit"></i></a><a href="delete_user/' . $user->id . '" style="margin-left:1em" class="" title="Delete User"><i class="glyphicon glyphicon-trash "></i></a>';
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
//            dd($input);
            $password = bcrypt($input['password']);
            $input['password'] = $password;
            $input['logins_counter'] = 0;
            $input['email_token'] = base64_encode($input['email']);
            $input['verified'] = 0;
            $user = User::create($input);
            DB::commit();
            event($user);
            dispatch(new InviteEmployees($user,$input['password']));

        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }
        return redirect('user');
    }

    public function updateUserAPI(Request $request, User $user){
//        dd($user);
        $input = $request->all();
//        dd($input);
        try {

            if (array_key_exists('image', $input)) {
                $main_picture_url = $request->file('image');
                $dir = "photos/";
                if (File::exists(public_path($dir)) == false) {
                    File::makeDirectory(public_path($dir), 0777, true);
                }
                $img = Image::make($main_picture_url->path());
                $path = "{$dir}" . uniqid() . "." . $main_picture_url->getClientOriginalExtension();
//                dd($path);
                $img->save(public_path($path));
                $input['picture_url'] = $path;
            }

            DB::beginTransaction();
            try {

                $user->update($input);
                DB::commit();
                $user = User::join('packages','packages.id','users.package_id')
                    ->where('users.id',$user->id)->select('users.*','package_name')->first();

            } catch (\Exception $e) {
                DB::rollback();
                throw $e;
            }
            return response()->json(["status" => "200", "message" => "Profile update successfuly", "user" => $user]);

        } catch (\Exception $e) {
            throw $e;
            return response()->json(["status" => "500", "message" => $e]);
        }
        return [];
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getName(User $user){
//        dd($user);
        return $user->name." - ".$user->surname;
    }

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
