@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="row justify-content-center mt-2">
                <div class="col">
                    <div class="hero-section" style="background-color:#f5f5f5;width:100%;height:200px;">
                        <img src="{{secure_asset('image/jobHeader.jpg')}}" class="card-img-top" alt="Cover Image" height="200" style="object-fit: cover;">
                    </div>
                </div>
            </div>

            <div class="row mt-5">
                <div class="col">
                    <img src="{{Storage::url($company->profile_pic)}}" width="60" alt="Company Logo" class="img-fluid rounded-circle">
                    <h2>{{$company->name}}</h2>
                    <p>{{$company->address}}</p>
                </div>
            </div>

            <div class="row mt-5">
                <div class="col">
                    <h3>About</h3>
                    <p>{!!$company->about!!}</p>
                </div>
            </div>

            <div class="row mt-5">
                <div class="col-md-12 mb-5">
                    <h3>List of Jobs</h3>
                    @foreach($company->jobs as $job)
                    <div class="card mb-1 p-1">
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
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>

@endsection