<?php 

namespace App\Post;

use App\Models\Listing;
use Carbon\Carbon;
use Illuminate\Support\Str;

class JobPost {

    protected $listing;
    //Listing 모델 레코드를 ($this -> listing)로 받음
    public function __construct(Listing $listing)
    {
        $this -> listing = $listing;
    }


    public function store($data):void{
        // dd($data['date']);

        $feature_image = $data -> file('feature_image');
        $imagePath = $feature_image->store('public/images');
        $this -> listing -> feature_image = $imagePath;

        $this -> listing -> user_id = auth()->user()->id;
        
        $this -> listing -> title = $data['title'];
        $this -> listing -> description = $data['description'];
        $this -> listing -> roles = $data['roles'];
        $this -> listing -> job_type = $data['job_type'];
        $this -> listing -> address = $data['address'];
        $this -> listing -> application_close_date = \Carbon\Carbon::createFromFormat('m/d/Y', $data['date'])->format('Y-m-d');
        $this -> listing -> salary = $data['salary'];        
        $this -> listing -> slug = Str::slug($data['title']).'.'.Str::uuid();

        $this -> listing -> save();
    }
}
