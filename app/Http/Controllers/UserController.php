<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

use App\Models\User;
use App\Http\Requests\RegistrationRequest;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    const JOB_SEEKR = 'seeker';
    const JOB_POSTER = 'employer';

    public function createSeeker(){
        return view('user.seeker-register');
    }
    public function createEmployer(){
        return view('user.employer-register');
    }

    public function storeSeeker(RegistrationRequest $request){
        $user = User::create([
            'name'=> request('name'),
            'email'=> request('email'),
            'password'=> bcrypt(request('password')),
            'user_type'=> self::JOB_SEEKR
        ]);
        // 가입하면 우선 로그인이 됨
        Auth::login($user);
        // 인증메일 발송
        $user->sendEmailVerificationNotification();

        return response()->json('success');
        // return redirect()->route('verification.notice')->with('successMessage','your account is created');
    }

    public function storeEmployer(RegistrationRequest $request){
        $user = User::create([
            'name'=> request('name'),
            'email'=> request('email'),
            'password'=> bcrypt(request('password')),
            'user_type'=> self::JOB_POSTER,
            'user_trial'=> now()->addWeek()
        ]);
        Auth::login($user);
        $user->sendEmailVerificationNotification();

        return response()->json('success');
        // return redirect('login')->with('successMessage','your account is created');
    }

    public function login(){
        return view('user.login');
    }

    public function postLogin(Request $request){
        $request -> validate([
            'email'=>'required',
            'password'=>'required',
        ]);

        $credential = $request-> only('email','password');
        if(Auth::attempt($credential)){
            return redirect('/dashboard');
        }
        return "Wrong ID of Password";
    }

    public function logout() {
        auth()->logout();
        return redirect()->route('login');
    }
}
