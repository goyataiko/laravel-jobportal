@extends('layouts.app')
@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                @if($listing->feature_image)
                <img src="{{Storage::url($listing->feature_image)}}" class="card-img-top" alt="Cover Image" height="150" style="object-fit: cover;">
                @else
                <img src="{{secure_asset('image/jobHeader.jpg')}}" class="card-img-top" alt="Cover Image" height="150" style="object-fit: cover;">
                @endif
                <div class="card-body">

                    <a href="{{route('company', [$listing->user_id])}}" style="text-decoration: none;">
                        <img src="{{Storage::url($listing->profile->profile_pic)}}" alt="Logo" width="60" height="60" class="rounded-circle">
                    </a>
                    <b>{{$listing->profile->name}}</b>


                    <h2 class="card-title">{{$listing->title}}</h2>
                    @include('message')
                    <span class="badge bg-primary">{{$listing->job_type}}</span>
                    <p>Salary: ￥{{number_format($listing->salary)}}</p>
                    <p>Address: {{$listing->address}}</p>
                    <h4 class="mt-4">Description</h4>
                    <p class="card-text">{!!$listing->description!!}</p>

                    <h4>Roles and Responsibilities</h4>
                    <p class="card-text">{!!$listing->roles!!}</p>

                    <p class="card-text mt-4">Application closing date: {{$listing->application_close_date}}</p>

                    @if(Auth::check())
                    @if(empty(auth()->user()->resume))
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#applyModal">
                        Upload Resume
                    </button>
                    <!-- Modal -->
                    <div class="modal fade" id="applyModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <form action="{{route('application.submit', [$listing->id])}}" method="post">@csrf
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Upload Resume</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <input type="file" name="resume" />
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" id="btnApply" class="btn btn-primary" disabled>Apply</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    @else
                    <form action="{{ route('application.submit', [$listing->id]) }}" method="post">
                        @csrf
                        <button type="submit" class="btn btn-primary mt-3">Apply Now</button>
                    </form>
                    @endif
                    @else
                    <p class="fw-bold">Please log in to apply</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // Get a reference to the file input element
    const inputElement = document.querySelector('input[type="file"]');

    // Create a FilePond instance
    const pond = FilePond.create(inputElement);

    pond.setOptions({
        server: {
            url: '/resume/upload',
            process: {
                method: 'POST',
                withCredentials: false,
                headers: { //@csrf 대신 이것을 붙여줌 
                    'X-CSRF-TOKEN': '{{csrf_token()}}'
                },
                //데이터를 받음
                ondata: (formData) => {
                    console.log(pond.getFiles()[0].file);
                    formData.append('file', pond.getFiles()[0].file, pond.getFiles()[0].file.name);

                    return formData;
                },
                //성공하면 로드함
                onload: (response) => {
                    document.getElementById('btnApply').removeAttribute('disabled')
                },
                //실패하면 여기 에러
                onerror: (response) => {
                    console.log("error while uploading.", response);
                },
            },
        },
    });
</script>
@endsection