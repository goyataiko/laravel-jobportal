<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class PostJobController extends Controller
{
    public  function create(){
        
        return view('job.create');
    }

    public function store(Request $request) {
        // dd($request ->date);
        // dd(\Carbon\Carbon::createFromFormat('m/d/Y', $request ->date)->format('Y-m-d'));
        $this -> validate($request, Listing::$rules);
        
        $imagePath = $request -> file('feature_image')->store('public/images');
        $post = new Listing;
        $post -> user_id = auth()->user()->id;

        $post -> feature_image = $imagePath;
        $post -> title = $request ->title;
        $post -> description = $request ->description;
        $post -> roles = $request ->roles;
        $post -> job_type = $request ->job_type;
        $post -> address = $request ->address;
        $post -> application_close_date = \Carbon\Carbon::createFromFormat('m/d/Y', $request ->date)->format('Y-m-d');
        $post -> salary = $request ->salary;
        $post -> slug = Str::slug($request->title).'.'.Str::uuid();

        $post -> save();

        return back();
    }
}
