@extends('layouts.app')
@section('content')

<div class="container mt-5 mb-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h2>Edit Your Profile</h2>
            @include('message')
            <form action="{{route('profile.update')}}" method="post" enctype="multipart/form-data">@csrf
                <div class="form-group">
                    <label for="logo">Profile Image</label>
                    <input type="file" id="logo" name="profile_pic" class="form-control">
                    @if(auth()->user()->profile_pic)
                    <img src="{{Storage::url(auth()->user()->profile_pic)}}" width="150" class="mt-3">
                    @endif
                </div>
                <div class="form-group">
                    <label for="name">Your Name</label>
                    <input type="text" id="logo" name="name" class="form-control" value="{{auth()->user()->name}}">
                </div>
                <div class="form-group mt-3">
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>
    </div>

    <div class="row justify-content-center mt-5">
        <div class="col-md-8">
            <h2>Change Passwrd</h2>
            <form action="{{route('user.password')}}" method="post">@csrf
                <div class="form-group">
                    <label for="current_password">Your Current Password</label>
                    <input type="password" name="current_password" class="form-control" id="current_password">
                    @if($errors->has('current_password'))
                    <span class="text-danger">{{$errors->first('current_password')}}</span>
                    @endif
                </div>
                <div class="form-group">
                    <label for="new_password">Your New Password</label>
                    <input type="password" name="new_password" class="form-control" id="new_password">
                    @if($errors->has('new_password'))
                    <span class="text-danger">{{$errors->first('new_password')}}</span>
                    @endif
                </div>
                <div class="form-group">
                    <label for="confirm_password">Confirm Password</label>
                    <input type="password" name="confirm_password" class="form-control" id="confirm_password">
                </div>
                <div class="form-group mt-3">
                    <button type="submit" class="btn btn-primary">Change Password</button>
                </div>
            </form>
        </div>
    </div>

    <div class="row justify-content-center mt-5">
        <div class="col-md-8">
            <h2>Update Resume</h2>
            <form action="{{route('upload.resume')}}" method="post" enctype="multipart/form-data">@csrf
                <div class="form-group">
                    <label for="resume">Upload a Resume</label>
                    <input type="file" name="resume" class="form-control" id="resume">
                </div>
                @if($errors->has('resume'))
                    <span class="text-danger">{{$errors->first('resume')}}</span>
                @endif
                <div class="form-group mt-3">
                    <button type="submit" class="btn btn-primary">Upload</button>
                </div>
            </form>
        </div>
    </div>

</div>
@endsection