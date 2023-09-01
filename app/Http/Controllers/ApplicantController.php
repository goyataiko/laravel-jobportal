<?php

namespace App\Http\Controllers;

use App\Mail\ShortlistMail;
use App\Models\Listing;
use App\Models\User;
use Illuminate\Support\Facades\Mail;

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
        // //해당 listing을 만든사람만 지원자를 볼 수 있도록함
        // if($listing->user_id != auth()->id()){
        //     abort(403);
        // }
        $this->authorize('view', $listing);

        $listing = Listing::with('users')->where('slug', $listing->slug)->first();

        return view('applicants.show', compact('listing'));
    }

    public function shortlist($listingID, $userID)
    {
        $listing = Listing::find($listingID);
        $user = User::find($userID);

        if ($listing) {
            $listing->users()->updateExistingPivot($userID, ['shortlisted' => true]);
            
            Mail::to($user->email)->queue(new ShortlistMail($user->name, $listing->title));

            return back()->with('successMessage', 'User is shortlisted successfully');
        }

        return back();
    }
}
