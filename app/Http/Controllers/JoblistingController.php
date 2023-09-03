<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use App\Models\User;
use Illuminate\Http\Request;

class JoblistingController extends Controller
{
    public function index(Request $request)
    {
        $salary = $request->query('salary');
        $date = $request->query('date');
        $jobType = $request->query('job_type');

        $listings = Listing::query();
        if ($salary === 'salary_high_to_low') {
            // salary를 string으로 지정했기에 아래와 같이 변경
            $listings->orderByRaw('CAST(salary As UNSIGNED) DESC');
        } elseif ($salary === 'salary_low_to_high') {
            $listings->orderByRaw('CAST(salary As UNSIGNED) ASC');
        }

        if ($date === 'latest') {
            $listings->orderBy('created_at', 'desc');
        } elseif ($date === 'oldeset') {
            $listings->orderBy('created_at', 'asc');
        }

        if ($jobType === 'fullTime') {
            $listings->where('job_type', 'fulltime');
        } elseif ($jobType === 'partTime') {
            $listings->where('job_type', 'parttime');
        } elseif ($jobType === 'casual') {
            $listings->where('job_type', 'casual');
        } elseif ($jobType === 'contract') {
            $listings->where('job_type', 'contract');
        }


        $jobs = $listings->with('profile')->get();
        return view('home', compact('jobs'));
    }

    public function show(Listing $listing)
    {
        return view('show', compact('listing'));
    }

    public  function company($id)
    {
                    //모델 안의 jobs함수 연동
        $company = User::with('jobs')->where('id', $id)->where('user_type', 'employer')->first();


        return view('company', compact('company'));
    }
}
