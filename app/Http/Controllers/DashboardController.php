<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Listing;

use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(){
        $listings = Listing::withCount('users')->where('user_id', auth()->user()->id)->get();
        $totalUserCount = 0;
        foreach ($listings as $listing) {
            $totalUserCount += $listing->users_count;
        }

        return view('dashboard', compact('totalUserCount'));
    }

    public function verify(){
        return view('user.verify');
    }

    public function resend(Request $request){
        $user = Auth::user();

        if($user->hasVerifiedEmail()){
            return redirect('/dashboard')->with('success','Your Email is verified');
        }

        $user->sendEmailVerificationNotification();
        
        return back()->with('success','Verification link is sent');
    }
}
