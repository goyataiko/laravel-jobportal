<!doctype html>
<html lang="{{ app()->getLocale() }}">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>LaraJobPortal</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
  <!-- upload기능 -->
  <link href="https://unpkg.com/filepond@^4/dist/filepond.css" rel="stylesheet" />
</head>

<body>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
  <script src="https://unpkg.com/filepond@^4/dist/filepond.js"></script>

  <nav class="navbar navbar-expand-lg bg-dark border-bottom border-body" data-bs-theme="dark">
    <div class="container">
      <a class="navbar-brand" href="/">
        <img src="{{asset('image/logo.png')}}" height="35" alt="logo">
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
        <div class="navbar-nav ms-auto">
          <a class="nav-link active" aria-current="page" href="/">Home</a>
          @if(@Auth::check())
          <div class="dropdown ms-2">
            <a class="dropdown-toggle text-decoration-none" type="button" data-bs-toggle="dropdown" aria-expanded="false">
              @if( empty(auth()->user()->profile_pic))
              <img src="{{asset('image/profile.svg')}}" width="35" class="rounded-circle mt-1">
              @else
              <img src="{{Storage::url(auth()->user()->profile_pic)}}" 
              width="35" height="35" class="rounded-circle mt-1">
              @endif
            </a>
            <ul class="dropdown-menu dropdown-menu-end text-center">
              <li><a class="dropdown-item nav-link" aria-current="page" href="{{route('seeker.profile')}}">Profile</a></li>
              <li><a class="dropdown-item nav-link" aria-current="page" href="{{route('job.applied')}}">Job Applied</a></li>
              <li><a class="dropdown-item nav-link" id="logout" href="#">LogOut</a></li>
              <form id="form_logout" action="{{route('logout')}}" method="post">@csrf</form>
            </ul>
          </div>
          @endif

          @if(!@Auth::check())
          <a class="nav-link" href="{{route('login')}}">Login</a>
          <a class="nav-link" href="{{route('create.seeker')}}">Job Seeker</a>
          <a class="nav-link" href="{{route('create.employer')}}">Employer</a>
          @endif

        </div>
      </div>
    </div>
  </nav>

  @yield('content')
  <script>
    let logout = document.getElementById('logout');
    let form = document.getElementById('form_logout');
    logout.addEventListener('click', function() {
      form.submit();
    })

    $(document).on('click', '#modal', function(e) {
      // 이벤트를 원래의 modal에 전달합니다.
      e.stopPropagation();
      $(this).modal('show');
    });
  </script>
</body>

</html>