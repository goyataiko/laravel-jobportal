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
                    Your Jobs
                </div>
                <div class="card-body">
                    <table id="datatablesSimple">
                        <thead>
                            <tr>
                                <th>Title</th>
                                <th>Created at</th>
                                <th>Edit</th>
                                <th>Delete</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>Title</th>
                                <th>Created at</th>
                                <th>Edit</th>
                                <th>Delete</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @foreach($jobs as $job)
                            <tr>
                                <td>{{$job->title}}</td>
                                <td>{{$job->created_at->format('Y-m-d')}}</td>
                                <td><a href="{{route('job.edit', [$job->id])}}">Edit</a></td>
                                <td><a href="#" data-bs-toggle="modal" data-bs-target="#exampleModal{{$job->id}}">Delete</a></td>
                            </tr>
                            <!-- Modal -->
                            <div class="modal fade" id="exampleModal{{$job->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="exampleModalLabel">Delete Confimation</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <p>This action cannot be undone. <br>Are you sure you want to proceed?</p>
                                        </div>
                                        <form action="{{route('job.delete', [$job->id])}}" method="post">@csrf
                                            @method('DELETE')
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary">Delete</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            @endforeach
                            <!-- https://getbootstrap.com/docs/5.3/components/modal/#how-it-works -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection