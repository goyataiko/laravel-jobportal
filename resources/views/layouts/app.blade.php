<!doctype html>
<html lang="{{ app()->getLocale() }}">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
  </head>
  <body>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>

    <nav class="navbar navbar-expand-lg bg-dark border-bottom border-body" data-bs-theme="dark">
        <div class="container">
            <a class="navbar-brand" href="#">Navbar</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav ms-auto">
                <a class="nav-link active" aria-current="page" href="#">Home</a>
                @if(!@Auth::check())
                <a class="nav-link" href="{{route('login')}}">Login</a>
                  <a class="nav-link" href="{{route('create.seeker')}}">Job Seeker</a>
                  <a class="nav-link" href="#">Employer</a>
                @endif
                @if(@Auth::check())
                  <a class="nav-link" id="logout" href="#">LogOut</a>
                @endif
                <form id="form_logout" action="{{route('logout')}}" method="post">@csrf</form>
            </div>
            </div>
        </div>
    </nav>
    
    @yield('content')
    <script>
      let logout = document.getElementById('logout');
      let form = document.getElementById('form_logout');
      logout.addEventListener('click', function(){
        form.submit();
      })
    </script>
  </body>
</html>