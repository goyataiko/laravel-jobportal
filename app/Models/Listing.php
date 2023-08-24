<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Listing extends Model
{
    use HasFactory;


    public static $rules = array(
        'feature_image' => 'required|mimes:png,jpeg,jpg|max:2048',
        'title' => 'required|min:5',
        'description' => 'required|min:20',
        'roles' => 'required',
        'job_type' => 'required',
        'address' => 'required',
        'date' => 'required',

        'salary' => 'required',
        // 'application_close_date',
        'slug',
    );
}
