@extends('layouts.app')
@section('content')

<div class="container mt-5">

    <!-- ================== Find Your Employer ================== -->
    <div class="d-flex justify-content-between">
        <h3>Find Your Employer</h3>
    </div>

    <div class="row my-2 g-1">
        @foreach(\App\Models\User::where('user_type','employer')->take(6)->orderBy('id','ASC')->get() as $employer)
        <div class="col-md-4 px-2 py-1">
            <div class="card p-1">
                <a href="{{route('company', [$employer->id])}}" class="text-decoration-none">
                    <div class="text-center mt-2">
                        <img alt="Company Image" src="{{Storage::url($employer->profile_pic)}}" width="50" height="50" class="rounded-circle mb-1">
                        <span class="ms-2 fs-4">{{$employer->name}}</span>
                    </div>
                </a>
            </div>
        </div>
        @endforeach
    </div>


    <!-- ================== Login ================== -->
    <div class="row mx-1 my-3 centered-content">
        @if(!@Auth::check())
        <p class="lead">
            <a href="/login"><button class="btn btn-dark">Sign in</button></a> or
            <a href="/register/seeker"><button class="btn btn-dark">Register</button></a>
            to manage your profile, start applying jobs.
        </p>
        @else
        <p class="lead">
            An IT agenda search site that helps users find information about IT-related topics.
        </p>
        @endif
    </div>

    <!-- ================== Recently added ================== -->
    <div class="row mt-4">
        <h4>Recently added</h4>
    </div>
    <div class="row mt-2 mx-2">
        @foreach(\App\Models\Listing::take(4)->orderBy('created_at','desc')->get() as $job)
        <div class="col-12 p-1">
            <div class="card mb-1">
                <div class="card-body d-flex justify-content-between">
                    <div>
                        <h5>{{$job->title}}</h5>
                        <span class="badge bg-secondary">{{$job->job_type}}</span> <span class="badge bg-success">￥{{number_format($job->salary,)}}</span>
                    </div>
                    <div>
                        <a href="{{route('job.show', [$job->slug])}}"><button class="btn btn-primary">Apply</button></a>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>




    <!-- ================== Our Jobs ================== -->

    <div class="d-flex justify-content-between mt-4 my-2">
        <h4>Our Jobs</h4>
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
            <div class="card p-3">
                <div><small class="text-bg-info badge">{{$job->job_type}}</small></div>
                <div class="text-center">
                    <img alt="Company Image" src="{{Storage::url($job->profile->profile_pic)}}" width="80" height="80" class="rounded-circle">
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
    span {
        color: #212529;
    }

    .card {
        transition: ease 0.7s;
    }

    .card:hover {
        background-color: #f0f0f0;
    }

    .centered-content {
        display: flex;
        align-items: center;
        text-align: center;
        padding-top: 1rem;
        height: 70px;
        margin-bottom: 3rem;
        background-color: #f5f5f5;
    }
</style>
@endsection