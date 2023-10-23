@extends('layouts.app')

@section('content')
    @include('partials._header_profile')
    <div class="edit-profile">
        <div class="container text-center">
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            <div class="row justify-content-center">
                <div class="col-md-5 text-center">
                    <div class="row justify-content-center text-center my-4">
                        <div class="col-auto">
                            @if ($user->image_path === "assets/images/user-solid.svg")
                                <div class="profile-letter">
                                    <div class="letter-bg">
                                        {{ substr($user->full_name, 0, 1) }}
                                    </div>
                                </div>
                            @else
                                <img id="profileImage" class="img-fluid w-50 profile-image" src="{{ asset($user->image_path) }}" alt="Profile Picture">
                            @endif
                        </div>
                    </div>
                    <form method="POST" action="{{ route('profile.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="row justify-content-center">
                            <div class="col-auto">
                                <div class="form-group">
                                    <label for="profile_image">
                                        <a class="button button-secondary"><i class="fa-regular fa-image"></i></a>
                                        <input type="file" class="form-control-file" id="profile_image" name="profile_image" hidden>
                                    </label>
                                </div>
                            </div>
                            <div class="col-auto">
                                <button type="submit" class="button button-primary">Upload Image</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col p-5 post-card">
                    @include('profile.form')
                </div>
            </div>
        </div>
    </div>
    @include('partials._footer')
@endsection
