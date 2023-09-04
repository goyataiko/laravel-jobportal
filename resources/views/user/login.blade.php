@extends('layouts.app')
@section('content')

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-4">
            @include('message')
            <div class="card shadow">
                <div class="card-header">Login</div>
                <form action="{{route('login.post')}}" method="post">@csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label for="">Email</label>
                            <input type="text" name="email" class="form-control">
                        </div>
                        @if($errors->has('name'))
                        <span class="text-danger">{{$errors->first('email')}}</span>
                        @endif
                        <div class="form-group">
                            <label for="">Password</label>
                            <input type="password" name="password" class="form-control">
                        </div>
                        @if($errors->has('name'))
                        <span class="text-danger">{{$errors->first('password')}}</span>
                        @endif
                        <br>
                        <div class="form-group text-center">
                            <button type="submit" class="btn btn-primary">Login</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="mt-5 d-flex justify-content-center">
            <div class="p-3 card">
                <p>Employer</p>
                <p>id: micro@test.com</p>
                <p>pw: password123</p>
            </div>
            <div class="p-3 card">
                <p>Seeker</p>
                <p>id: test1@test1.com</p>
                <p>pw: password123</p>
            </div>
        </div>
    </div>
</div>


@endsection