@extends('layouts.app')
@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                @if($listing->feature_image)
                <img src="{{Storage::url($listing->feature_image)}}" class="card-img-top" alt="Cover Image"
                height="150" style="object-fit: cover;">
                @else
                <img src="https://placehold.co/800" class="card-img-top" alt="Cover Image" 
                height="150" style="object-fit: cover;">
                @endif
                <div class="card-body">
                    <h2 class="card-title">{{$listing->title}}</h2>
                    <span class="badge bg-primary">{{$listing->job_type}}</span>
                    <p>Salary: ￥{{number_format($listing->salary)}}</p>
                    <p>Address: {{$listing->address}}</p>
                    <h4 class="mt-4">Description</h4>
                    <!-- html태그를 불러올때는 아래와 같이 {!! 내용물 !!} -->
                    <p class="card-text">{!!$listing->description!!}</p>

                    <h4>Roles and Responsibilities</h4>
                    <p class="card-text">{!!$listing->roles!!}</p>

                    <p class="card-text mt-4">Application closing date: {{$listing->application_close_date}}</p>

                    <a href="#" class="btn btn-primary mt-3">Apply Now</a>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection