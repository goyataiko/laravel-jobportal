    @extends('layouts.app')
    @section('content')

        <div class="container mt-5">
            <div class="row">
                <div class="col-md-6">
                    <h1>Looking for a job?</h1>
                    <h3>Please create an Account</h3>
                    <img src='{{asset("image/click-here.png")}}' alt="click-here">
                </div>
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">Register</div>
                        <form action="{{route('store.seeker')}}" method="post">@csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="">Full Name</label>
                                    <input type="text" name="name" class="form-control">
                                    @if($errors->has('name'))
                                        <span class="text-danger">{{$errors->first('name')}}</span>
                                    @endif
                                </div>
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
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">Register</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>


    @endsection
