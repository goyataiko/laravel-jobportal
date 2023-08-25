<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use App\Http\Requests\JobPostFormRequest;
use App\Http\Requests\JobEditFormRequest;
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
        $this ->middleware('auth');
    }

    public function index() {
        $jobs = Listing::where('user_id', auth()->user()->id)-> get();
        return view('job.index', compact('jobs'));
    }

    public  function create(){        
        return view('job.create');
    }

    public function store(JobPostFormRequest $request) {
        // JobPost의 결과물($this ->job)을 JobPostFormRequest로 유효성 검사해서 store함
        $this->job->store($request);
        return back();
    }

    public function edit(Listing $listing){
        return view('job.edit', compact('listing'));
    }

    public function update($id, JobEditFormRequest $request){
        $this->job->updatePost($id, $request);
        return back()->with('successMessage','Your job has been successfully updated'); 
    }

}
