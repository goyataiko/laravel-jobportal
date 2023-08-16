<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

use App\Models\User;
use App\Http\Requests\SeekerRegistrationRequest;

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
}
