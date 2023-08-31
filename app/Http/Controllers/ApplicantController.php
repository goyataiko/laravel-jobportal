<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ApplicantController extends Controller
{
    public function index()
    {   //현 로그인 아이디로 작성한 Listing을 모두 취득
        //latest로 최근 순으로
        $listings = Listing::latest()->withCount('users')->where('user_id', auth()->user()->id)->get();

        return view('applicants.index', compact('listings'));
    }

    public function show(Listing $listing)
    {
        $listings = Listing::with('users')->where('slug', $listing->slug)->first();
        // dd($listings);
        return view('applicants.show', compact('listings'));
    }
}
