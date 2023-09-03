@extends('layouts.app')
@section('content')

<div class="container mt-5">
    <div class="d-flex justify-content-between">
        <h3>Find Your Employer</h3>
    </div>

    <div class="row my-2 g-1">
        @foreach(\App\Models\User::where('user_type','employer')->take(6)->orderBy('id','ASC')->get() as $employer)
        <div class="col-md-4 px-2 py-1">
            <div class="card p-1">
                <div class="col-md-10">
                    <div class="text-center mt-2 p-3">
                        <img alt="Company Image" src="{{Storage::url($employer->profile_pic)}}" width="50" height="50" class="rounded-circle mb-1">
                        <span class="ms-2 fs-4">{{$employer->name}}</span>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <div class="row mx-1 my-3 centered-content">
        @if(!@Auth::check())
        <p class="lead"><a href="/login"> <button class="btn btn-dark">Sign in</button></a> or
            <button class="btn btn-dark">Register</button></a>
            to manage your profile, start applying jobs.
        </p>
        @else
        <p class="lead">
            An IT agenda search site that helps users find information about IT-related topics.
        </p>
        @endif
    </div>

    <div class="d-flex justify-content-between my-2">
        <h4>Recommended Jobs</h4>
        <div class="dropdown">
            <button class="btn btn-dark dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                Salary
            </button>
            <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="{{route('home', ['salary' => 'salary_high_to_low'])}}">High to Low</a></li>
                <li><a class="dropdown-item" href="{{route('home', ['salary' => 'salary_low_to_high'])}}">Low to High</a></li>
            </ul>

            <button class="btn btn-dark dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                Date
            </button>
            <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="{{route('home', ['date' => 'latest'])}}">Latest</a></li>
                <li><a class="dropdown-item" href="{{route('home', ['date' => 'oldeset'])}}">Oldest</a></li>
            </ul>

            <button class="btn btn-dark dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                Job Type
            </button>
            <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="{{route('home', ['job_type' => 'all'])}}">All</a></li>
                <li><a class="dropdown-item" href="{{route('home', ['job_type' => 'fullTime'])}}">Full Time</a></li>
                <li><a class="dropdown-item" href="{{route('home', ['job_type' => 'partTime'])}}">Part Time</a></li>
                <li><a class="dropdown-item" href="{{route('home', ['job_type' => 'casual'])}}">Casual</a></li>
                <li><a class="dropdown-item" href="{{route('home', ['job_type' => 'contract'])}}">Contract</a></li>
            </ul>
        </div>
    </div>
    <div class="row mt-2 g-1">
        @foreach($jobs as $job)
        <div class="col-md-3 p-2">
            <div class="card p-2 {{$job->job_type}}">
                <div class="text-right"><small class="text-bg-info badge">{{$job->job_type}}</small></div>
                <div class="text-center mt-2 p-3">
                    <img alt="Company Image" src="{{Storage::url($job->profile->profile_pic)}}" width="100" height="100" class="rounded-circle">
                    <span class="d-block fw-bold">{{$job->title}}</span>
                    <hr>
                    <span>{{$job->profile->name}}</span>
                    <div class="d-flex flex-row aligh-item-center justify-content-center">
                        <small class="ml-1">{{$job->address}}</small>
                    </div>
                    <div class="d-flex justify-content-between mt-3">
                        <span>￥{{number_format($job->salary)}}</span>
                        <a href="{{route('job.show', [$job->slug])}}"><button class="btn btn-dark">Apply</button></a>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>

<style>
    .fulltime {
        background-color: green;
        color: #fff;
    }

    .parttime {
        background-color: blue;
        color: #fff;
    }

    .casual {
        background-color: red;
        color: #fff;
    }

    .contract {
        background-color: purple;
        color: #fff;
    }

    .centered-content {
        display: flex;
        align-items: center;
        text-align: center;
        padding-top: 1rem;
        height: 100px;
        margin-bottom: 3rem;
        background-color: #f5f5f5;
    }
</style>
@endsection