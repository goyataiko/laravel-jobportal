@extends('layouts.app')
@section('content')

    <div class="container mt-5">
        <div class="row">
            <div class="col-md-6 text-center">
                <h1>Looking for an Emplyee?</h1>
                <h3>Please create an Account</h3>
                <img src='{{secure_asset("image/click-here.png")}}' alt="click-here">
            </div>
            <div class="col-md-6">
                <div class="card shadow" id="card">
                    <div class="card-header">Employer Register</div>
                    <form action="#" method="post" id="registationForm">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="">Company Name</label>
                                <input type="text" name="name" class="form-control required">
                                @if($errors->has('name'))
                                    <span class="text-danger">{{$errors->first('name')}}</span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="">Email</label>
                                <input type="text" name="email" class="form-control required">
                            </div>
                            @if($errors->has('name'))
                                    <span class="text-danger">{{$errors->first('email')}}</span>
                            @endif                                
                            <div class="form-group">
                                <label for="">Password</label>
                                <input type="password" name="password" class="form-control required">
                            </div>
                            @if($errors->has('name'))
                                    <span class="text-danger">{{$errors->first('password')}}</span>
                            @endif
                            <br>
                            <div class="form-group">
                                <button id="btnRegister" class="btn btn-primary">Register</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div id="message"></div>
            </div>
        </div>
    </div>

<script>

/*
html이 로드가 되기 이전에 script가 로드가 되어서.
getElementById가 제대로 작동이 안됨.
따라서, html이 로드가 된 후에 작동하기 위한  EventListener를 넣은 후에
스크립트를 넣음 
*/
document.addEventListener('DOMContentLoaded', function() {

    var url = "{{route('store.employer')}}";
    document.getElementById('btnRegister').addEventListener('click', function(e){
        // alert("A"); 제대로 연결됐는지 확인
        var card = document.getElementById('card');
        var messageDiv = document.getElementById('message');
        messageDiv.innerHTML = '';
        var form = document.getElementById('registationForm');

        //url로 보내주기 위한 데이터 폼
        var formData = new FormData(form);

        //event가 발생한 html요소를 var button으로 가져옴
        var button = event.target
        //2번 클릭 못하도록 disabled
        button.disabled = true;
        button.innerHTML = 'Sending Emial..';

        fetch(url, {
            method: 'post',            
            headers: {   //@csrf 대신 이것을 붙여줌 
                'X-CSRF-TOKEN': '{{csrf_token()}}'
            },
            body: formData
        }).then(response=> {
            if(response.ok){
                return response.json();
            }else {
                throw new Error('error!');
            }
        }).then(data=>{
            button.innerHTML = 'Register';
            button.disabled = false;
            messageDiv.innerHTML = '<div class="col-8 text-center alert alert-success">Registration is successful. <br>Please check your email for verification.</div>';
            card.style.display = 'none';
        }).catch(error => {
            button.innerHTML = 'Register';
            button.disabled = false;
            messageDiv.innerHTML = '<div class="mt-3 alert alert-danger">Registration is faild. <br>Please try again.</div>';
        })

    //button    
    })  
});
</script>

@endsection


