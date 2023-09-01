<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Listing extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'feature_image',
        'title',
        'description',
        'roles',
        'job_type',
        'address',
        'salary',
        'application_close_date',
        'slug',  
    ];

    public function users()
    {
        return $this->belongsToMany(User::class, 'listing_user', 'listing_id', 'user_id')
            ->withPivot('shortlisted')
            ->withTimestamps();
    }

    public function profile()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
