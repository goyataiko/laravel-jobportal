@extends('layouts.admin.main')
@section('content')

<div class="container mt-5">

    <div class="row justify-content-center">

        @foreach ($listings as $listing)
        Listing Title: {{$listing->title}}<br>
        Number of Applicant: {{$listing->users_count}}<br>

        @foreach ($listing->users()->get() as $applicant)
        Aplicant Name: {{$applicant->name}} <br>
        @endforeach
        <br>
        @endforeach

    </div>
</div>

@endsection