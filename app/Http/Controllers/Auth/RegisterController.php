<?php

namespace App\Http\Controllers\Auth;

use App\Package;
use App\Role;
use App\User;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\RegistersUsers;

/**
 * Class RegisterController
 * @package %%NAMESPACE%%\Http\Controllers\Auth
 */
class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Show the application registration form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showRegistrationForm()
    {

        return view('adminlte::auth.register');
    }

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name'     => 'required|max:255',
            'username' => 'sometimes|required|max:255|unique:users',
            'email'    => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
            'terms'    => 'required',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        $team_size = Package::where('id',$data['package_id'])->select('number_of_members')->first();
        $role_id = "";

        if($team_size->number_of_members>1){
            $role = Role::where('name','Manager')->first();
            $role_id = $role->id;
        }
        else{
            $role = Role::where('name','Employee')->first();
            $role_id = $role->id;
        }

        $fields = [
            'name'     => $data['name'],
            'email'    => $data['email'],
            'surname'    => $data['surname'],
            'contact_number' =>$data['contact_number'],
            'company_name' =>$data['company_name'],
            'user_name' =>$data['user_name'],
            'role_id'=> $role_id,
            'package_id' => $data['package_id'],
            'terms' =>$data['terms'],
            'password' => bcrypt($data['password']),
        ];
//        dd($fields);
//        if (config('auth.providers.users.field','email') === 'username' && isset($data['username'])) {
//            $fields['username'] = $data['username'];
//        }
        return User::create($fields);
    }
}
