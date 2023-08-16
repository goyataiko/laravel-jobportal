@if(Session::has('successMessage'))
    <div class="alert alert-success shadow">{{Session::get('successMessage')}}</div>
@endif

@if(Session::has('errorMessage'))
    <div class="alert alert-danger shadow">{{Session::get('errorMessage')}}</div>
@endif