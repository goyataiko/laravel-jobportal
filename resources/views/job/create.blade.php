@extends('layouts.admin.main')
@section('content')

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h1>Post Job</h1>
            <form action="" method="post">@csrf
                <div class="form-group">
                    <label for="title">title</label>
                    <input type="text" name="title" id="title" class="form-control">
                </div>
                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea name="description" id="description" class="form-control"></textarea>
                </div>
                <div class="form-group">
                    <label for="roles">Roles and Responsibility</label>
                    <textarea name="roles" id="roles" class="form-control"></textarea>
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
                </div>

                <div class="form-group">
                    <label for="address">Address</label>
                    <input type="text" name="address" id="address" class="form-control">
                </div>
                <div class="form-group">
                    <label for="date">Date</label>
                    <input type="date" name="date" id="date" class="form-control">
                </div>
                <div class="form-group mt-4">
                    <button type="submit" class="btn btn-success">Post a Job</button>
                </div>

            </form>
        </div>
    </div>
</div>

@endsection