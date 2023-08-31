<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ApplicantController extends Controller
{
    public function index()
    {   //현 로그인 아이디로 작성한 Listing을 모두 취득
        $listings = Listing::where('user_id', auth()->user()->id)->get();
        //listing_user테이블에서, 위에서 나온 listing들이 갖는 모든 레코드를 찾아오기
        // $records = DB::table('listing_user')->whereIn('listing_id', $listings->pluck('id'))->get();

        foreach ($listings as $listing) {
            $applicants = $listing->users()->get();
            $applicantCount = $listing->users()->count();

            echo "Listing Title: $listing->title<br>";
            echo "Number of Applicant: $applicantCount<br>";

            foreach ($applicants as $applicant) {
                echo " Aplicant Name: $applicant->name  <br>";
            }

            echo "<br>";

        }
    }
}
