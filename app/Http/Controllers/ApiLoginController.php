<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\User;

class ApiLoginController extends Controller
{
    use AuthenticatesUsers {
        attemptLogin as attemptLoginAtAuthenticatesUsers;
//        sendLoginResponse as sendLoginResponse;
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'logout']);
    }

    /**
     * Attempt to log the user into the application.
     *
     * @param  \Illuminate\Http\Request $request
     * @return bool
     */
    protected function attemptLogin(Request $request)
    {
//        dd($request->all());
        $user = User::where('email', $request->all()['email'])->first();
        if ($user != null) {
            $verified = $user->verified;
//            dd($verified);
            if ($verified == "0") {
                return false;
            } else {
                if ($this->username() === 'email') return $this->attemptLoginAtAuthenticatesUsers($request);
                if (!$this->attemptLoginAtAuthenticatesUsers($request)) {
                    return $this->attempLoginUsingUsernameAsAnEmail($request);
                }
            }
        }
        return false;
    }

    /**
     * Attempt to log the user into application using username as an email.
     *
     * @param \Illuminate\Http\Request $request
     * @return bool
     */
    protected function attempLoginUsingUsernameAsAnEmail(Request $request)
    {

        return $this->guard()->attempt(
            ['email' => $request->input('user_name'), 'password' => $request->input('password')],
            $request->has('remember'));

    }


    public function login(Request $request)
    {
        $input = $request->all();
        $this->validateLogin($request);
        if ($this->attemptLogin($request)) {
            $user = $this->guard()->user();
//            $user->generateToken();
            return response()->json($user);
        } else {
            try {
                $user = User::where('email', $input['email'])->first();
                if ($user != null) {
                    $verified = $user->verified;
                    if ($verified == "0") {
                        return response()->json(
                            ['_id' => '700', 'message' => 'Your Account has not be verified, please check your email address ' . $user->email]
                        );
                    } else {
                        return response()->json(
                            ['_id' => '701', 'message' => trans('auth.failed')]
                        );
                    }
                } else {
                    return response()->json(
                        ['_id' => '702', 'message' => 'Your Account does not exist, please create an account ']
                    );
                }
            } catch (\ErrorException $error) {
//                dd($error);
                return response()->json(
                    ['_id' => '701', 'message' => trans('auth.failed')]
                );
            }

        }

        return $this->sendFailedLoginResponse($request);
    }

    /**
     * Send the response after the user was authenticated.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
}