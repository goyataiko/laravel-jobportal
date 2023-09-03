<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Http\Request;

class JoblistingController extends Controller
{
    public function index(Request $request)
    {
        $salary = $request->query('salary');
        $date = $request->query('date');
        $jobType = $request->query('job_type');

        $listings = Listing::query();        
        if($salary === 'salary_high_to_low'){
            $listings->orderBy('salary','desc');
        } elseif($salary === 'salary_low_to_high'){
            $listings->orderBy('salary','asc');
        }

        if($date === 'latest'){
            $listings->orderBy('created_at','desc');
        } elseif($date === 'oldeset'){
            $listings->orderBy('created_at','asc');
        }

        if($jobType === 'fullTime'){
            $listings->where('job_type','fulltime');
        } elseif($jobType === 'partTime'){
            $listings->where('job_type','parttime');
        } elseif($jobType === 'casual'){
            $listings->where('job_type','casual');
        } elseif($jobType === 'contract'){
            $listings->where('job_type','contract');
        }


        $jobs = $listings->with('profile')->get();
        return view('home', compact('jobs'));
    }

    public function show(Listing $listing)
    {
        return view('show', compact('listing'));
    }
}
