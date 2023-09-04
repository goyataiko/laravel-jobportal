@extends('layouts.app')
@section('content')

<div class="container mt-5">
    <div class="row">
        <div class="row mt-5 justify-content-center">
            <div class="col-md-6">
                <h3>Applied Jobs</h3>
                @foreach($users as $user)
                @foreach($user->listings as $listing)
                <div class="card mb-1 p-1">
                    <div class="card-body d-flex justify-content-between">
                        <div>
                            <h5 class="card-title">{{$listing->title}}</h5>
                            <p class="card-text">Applied: {{$listing->pivot->created_at}}</p>
                        </div>
                        <div>
                            <a href="{{route('job.show', [$listing->slug])}}" class="btn btn-primary">View</a>
                        </div>
                    </div>
                </div>
                @endforeach
                @endforeach
            </div>
        </div>
    </div>
</div>

@endsection