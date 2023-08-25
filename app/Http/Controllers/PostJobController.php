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

        if($request->hasFile('feature_image')){
            $feature_image = $request -> file('feature_image')->store('public/images');
            Listing::find($id)->update(['feature_image' => $feature_image]);
        }

        //"MM/DD/YYYY"인 경우 parse하기
        if (strpos($request->date, '/') !== false) {
            $parsedDate = Carbon::createFromFormat('m/d/Y', $request->date)->format('Y-m-d');

            Listing::find($id)->update(['application_close_date' => $parsedDate]);
        } 

        Listing::find($id)->update($request->except('feature_image','application_close_date'));
        

        return back()->with('successMessage','Your job has been successfully updated'); 
    }
    
}
