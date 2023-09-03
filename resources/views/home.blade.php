@extends('layouts.app')
@section('content')

<div class="container mt-5">
    <div class="d-flex justify-content-between">
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
        <div class="col-md-3">
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

</style>
@endsection