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

    public function createSeeker()
    {
        return view('user.seeker-register');
    }
    public function createEmployer()
    {
        return view('user.employer-register');
    }

    public function storeSeeker(RegistrationRequest $request)
    {
        $user = User::create([
            'name' => request('name'),
            'email' => request('email'),
            'password' => bcrypt(request('password')),
            'user_type' => self::JOB_SEEKR
        ]);
        // 가입하면 우선 로그인이 됨
        Auth::login($user);
        // 인증메일 발송
        $user->sendEmailVerificationNotification();

        return response()->json('success');
        // return redirect()->route('verification.notice')->with('successMessage','your account is created');
    }

    public function storeEmployer(RegistrationRequest $request)
    {
        $user = User::create([
            'name' => request('name'),
            'email' => request('email'),
            'password' => bcrypt(request('password')),
            'user_type' => self::JOB_POSTER,
            'user_trial' => now()->addWeek()
        ]);
        Auth::login($user);
        $user->sendEmailVerificationNotification();

        return response()->json('success');
        // return redirect('login')->with('successMessage','your account is created');
    }

    public function login()
    {
        return view('user.login');
    }

    public function postLogin(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        $credential = $request->only('email', 'password');
        if (Auth::attempt($credential)) {
            if(auth()->user()->user_type === 'employer'){
                return redirect('/dashboard');
            } else {
                return redirect('/#notEmployer');
            }
        }
        return "Wrong ID or Password";
    }

    public function logout()
    {
        auth()->logout();
        return redirect()->route('login');
    }

    public function profile()
    {
        return view('profile.index');
    }

    public function profileUpdate(Request $request)
    {
        if ($request->hasFile('profile_pic')) {
            $image_path = $request->file('profile_pic')->store('public/profile');
            User::find(auth()->user()->id)->update(['profile_pic' => $image_path]);
        }
        User::find(auth()->user()->id)->update($request->except('profile_pic'));

        return back()->with('successMessage', 'Your profile has been successfully updated'); 
    }
}
