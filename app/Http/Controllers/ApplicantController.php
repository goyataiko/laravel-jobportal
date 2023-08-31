<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ApplicantController extends Controller
{
    public function index()
    {   //현 로그인 아이디로 작성한 Listing을 모두 취득
        $listings = Listing::withCount('users')->where('user_id', auth()->user()->id)->get();

        return view('applicants.index', compact('listings'));
            // //listing_user테이블에서, 위에서 나온 listing들이 갖는 모든 레코드를 찾아오기
            // // $records = DB::table('listing_user')->whereIn('listing_id', $listings->pluck('id'))->get();


    }
}
