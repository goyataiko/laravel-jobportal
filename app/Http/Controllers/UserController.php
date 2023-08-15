<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

use App\Models\User;

class UserController extends Controller
{
    const JOB_SEEKR = 'seeker';
    public function createSeeker(){
        return view('user.seekr-register');
    }

    public function storeSeeker(){
        User::create([
            'name'=> request('name'),
            'email'=> request('email'),
            'password'=> bcrypt(request('password')),
            'user_type'=> self::JOB_SEEKR
        ]);

        return back();
    }
}
