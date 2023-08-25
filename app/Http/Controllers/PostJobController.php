<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use App\Http\Requests\JobPostFormRequest;
use App\Post\JobPost;  //job 저장을 따로 export함
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class PostJobController extends Controller
{
    protected $job;
    //JobPost의 결과물을 받아 $this ->job에 저장
    public function __construct(JobPost $job)
    {
        $this ->job = $job;        
    }


    public  function create(){        
        return view('job.create');
    }

    public function store(JobPostFormRequest $request) {
        // JobPost의 결과물($this ->job)을 JobPostFormRequest로 유효성 검사해서 store함
        $this->job->store($request);
        return back();
    }

    
}
