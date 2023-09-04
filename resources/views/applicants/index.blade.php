@extends('layouts.admin.main')
@section('content')

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <h1>All Jobs</h1>
            @include('message')
            <div class="card mb-4 mt-4">
                <div class="card-header">
                    <i class="fas fa-table me-1"></i>
                    Applicants
                </div>
                <div class="card-body">
                    <table id="datatablesSimple">
                        <thead>
                            <tr>
                                <th>Title</th>
                                <th>End Date</th>
                                <th>Total Applicant</th>
                                <th>View Job</th>
                                <th>View Applicant</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($listings as $listing)

                            <tr>
                                <td>{{$listing->title}}</td>
                                <td>{{$listing->application_close_date}}</td>
                                <td>{{$listing->users_count}}</td>
                                <td><a href="{{route('job.show', $listing->slug)}}">view</a></td>
                                <td><a href="{{route('applicant.show', $listing->slug)}}">view</a></td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection