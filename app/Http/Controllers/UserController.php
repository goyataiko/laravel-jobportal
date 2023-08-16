<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

use App\Models\User;
use App\Http\Requests\SeekerRegistrationRequest;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    const JOB_SEEKR = 'seeker';
    public function createSeeker(){
        return view('user.seeker-register');
    }

    public function storeSeeker(SeekerRegistrationRequest $request){
        User::create([
            'name'=> request('name'),
            'email'=> request('email'),
            'password'=> bcrypt(request('password')),
            'user_type'=> self::JOB_SEEKR
        ]);

        return back();
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
