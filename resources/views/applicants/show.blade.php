@extends('layouts.admin.main')
@section('content')

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8 mt-5">
            <h1>{{$listing->title}}</h1>
            @include('message')
            @foreach($listing->users as $user)
            <div class="card mt-5 {{$user->pivot->shortlisted ? 'card-bg' : ''}}">
                <div class="row g-0">
                    <div class="col-auto">
                        @if($user->profile_pic)
                        <img src="{{Storage::url($user->profile_pic)}}" class="rounded-circle" width="150" height="150px" class="mt-3">
                        @else
                        <img src="https://placehold.co/400" class="rounded-circle" width="150px" alt="Profile Picture">
                        @endif
                    </div>
                    <div class="col-auto">
                        <div class="card-body">
                            <p class="fw-bold">{{$user->name}}</p>
                            <p class="card-text">{{$user->email}}</p>
                            <p class="card-text">{{$user->pivot->created_at}}</p>
                        </div>
                    </div>
                    <div class="col-auto align-self-center ms-auto me-3">
                        <form action="{{route('applicant.shortlist', [$listing->id,$user->id])}}" method="post">@csrf
                            <a href="{{Storage::url($user->resume)}}" target="_blank" class="btn btn-primary">Download Resume</a>
                            <button type="submit" class="btn {{$user->pivot->shortlisted ? ' btn-success' : 'btn-dark'}}">
                                {{$user->pivot->shortlisted ? 'Shortlisted' : 'Shortlist'}}
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>

<style>
    .card-bg {
        background-color: green;
    }
</style>

@endsection