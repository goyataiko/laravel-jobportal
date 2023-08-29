@extends('layouts.admin.main')
@section('content')

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h2>Edit Your Profile</h2>
            @include('message')
            <form action="{{route('profile.update')}}" method="post" enctype="multipart/form-data">@csrf
                <div class="form-group">
                    <label for="logo">Logo</label>
                    <input type="file" id="logo" name="profile_pic" class="form-control">
                    @if(auth()->user()->profile_pic)
                        <img src="{{Storage::url(auth()->user()->profile_pic)}}" width="150" class="mt-3">
                    @endif
                </div>
                <div class="form-group">
                    <label for="name">Company Name</label>
                    <input type="text" id="logo" name="name" class="form-control" value="{{auth()->user()->name}}">
                </div>
                <div class="form-group mt-3">
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection