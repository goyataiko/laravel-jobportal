@extends('layouts.admin.main')
@section('content')

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h1>Post Job</h1>
            <form action="{{route('job.store')}}" method="post" enctype="multipart/form-data">@csrf
                <div class="form-group">
                    <label for="feature_image">Feature Image</label>
                    <input type="file" name="feature_image" id="feature_image" class="form-control">
                    @if($errors->has('feature_image'))
                    <span class="text-danger">{{$errors->first('feature_image')}}</span>
                    @endif
                </div>

                <div class="form-group">
                    <label for="title">title</label>
                    <input type="text" name="title" id="title" class="form-control">
                    @if($errors->has('title'))
                    <span class="text-danger">{{$errors->first('title')}}</span>
                    @endif
                </div>
                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea name="description" id="description" class="form-control summernote"></textarea>
                    @if($errors->has('description'))
                    <span class="text-danger">{{$errors->first('description')}}</span>
                    @endif
                </div>
                <div class="form-group">
                    <label for="roles">Roles and Responsibility</label>
                    <textarea name="roles" id="roles" class="form-control summernote"></textarea>
                    @if($errors->has('roles'))
                    <span class="text-danger">{{$errors->first('roles')}}</span>
                    @endif
                </div>

                <div class="form-group">
                    <label>Job Type</label>
                    <div class="form-check">
                        <input type="radio" name="job_type" id="fulltime" value="fulltime" class="form-check-input">
                        <label for="fulltime" class="form-check-label">Fulltime</label>
                    </div>
                    <div class="form-check">
                        <input type="radio" name="job_type" id="parttime" value="parttime" class="form-check-input">
                        <label for="parttime" class="form-check-label">Parttime</label>
                    </div>
                    <div class="form-check">
                        <input type="radio" name="job_type" id="casual" value="casual" class="form-check-input">
                        <label for="casual" class="form-check-label">Casual</label>
                    </div>
                    <div class="form-check">
                        <input type="radio" name="job_type" id="contract" value="contract" class="form-check-input">
                        <label for="contract" class="form-check-label">Contract</label>
                    </div>
                    @if($errors->has('job_type'))
                    <span class="text-danger">{{$errors->first('job_type')}}</span>
                    @endif
                </div>

                <div class="form-group">
                    <label for="address">Address</label>
                    <input type="text" name="address" id="address" class="form-control">
                    @if($errors->has('address'))
                    <span class="text-danger">{{$errors->first('address')}}</span>
                    @endif
                </div>
                <div class="form-group">
                    <label for="salary">Salary</label>
                    <input type="text" name="salary" id="salary" class="form-control">
                    @if($errors->has('salary'))
                    <span class="text-danger">{{$errors->first('salary')}}</span>
                    @endif
                </div>
                <div class="form-group">
                    <label for="date">Date</label>
                    <input type="text" name="date" id="datepicker" class="form-control">
                    @if($errors->has('date'))
                    <span class="text-danger">{{$errors->first('date')}}</span>
                    @endif
                </div>
                <div class="form-group mt-4">
                    <button type="submit" class="btn btn-success">Post a Job</button>
                </div>

            </form>
        </div>
    </div>
</div>

<style>
    .note-insert {
        display: none;
    }
</style>
@endsection