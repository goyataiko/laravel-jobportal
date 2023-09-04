@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="row justify-content-center mt-2">
                <div class="col">
                    <div class="hero-section" style="background-color:#f5f5f5;width:100%;height:200px;">
                        <img src="{{asset('image/jobHeader.jpg')}}" class="card-img-top" alt="Cover Image" height="200" style="object-fit: cover;">
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
                <div class="col-md-8">
                    <h3>List of Jobs</h3>
                    @foreach($company->jobs as $job)
                    <div class="card mb-3">
                        <div class="card-body">
                            <h5 class="card-title">{{$job->name}}</h5>
                            <p class="card-text">Location: {{$job->address}}</p>
                            <p class="card-text">Salary: ${{number_format($job->salary,)}} per year</p>
                            <a href="{{route('job.show', [$job->slug])}}" class="btn btn-primary">View</a>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>

@endsection