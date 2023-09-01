@extends('layouts.app')
@section('content')

<div class="container mt-5">
    <div class="d-flex justify-content-between">
        <h4>Recommended Jobs</h4> <button class="btn btn-dark">view</button>
    </div>
    <div class="row mt-2 g-1">
        @foreach($jobs as $job)
        <div class="col-md-3">
            <div class="card p-2">
                <div class="text-right"><small>{{$job->job_type}}</small></div>
                <div class="text-center mt-2 p-3">
                    <img alt="Company Image" src="{{Storage::url($job->profile->profile_pic)}}" width="60" height="60" class="rounded-circle">
                    <span class="d-block fw-bold">{{$job->title}}</span>
                    <hr>
                    <span>Amazon</span>
                    <div class="d-flex flex-row aligh-item-center justify-content-center">
                        <small class="ml-1">{{$job->address}}</small>
                    </div>
                    <div class="d-flex justify-content-between mt-3">
                        <span>{{$job->salary}}</span>
                        <button class="btn btn-sm btn-outline-dark">Apply</button>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>

@endsection