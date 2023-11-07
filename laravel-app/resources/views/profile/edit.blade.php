@extends('layouts.app')

@section('content')
    @include('partials._header')
    @if (session('success'))
        @include('partials._toast')
    @endif
    @include('partials._alert')
    <div class="edit-profile">
        <div class="container text-center">
            <div class="row justify-content-center">
                <div class="col-lg-5 text-center mb-5">
                    <div class="row justify-content-center text-center my-4">
                        <div class="col-auto">
                            @if ($user->image_path === "assets/images/user-solid.svg")
                                <div class="profile-letter">
                                    <div class="letter-bg">
                                        {{ $user->first_letter }}
                                    </div>
                                </div>
                            @else
                                <img id="profileImage" class="img-fluid w-50 profile-image" src="{{ asset($user->image_path) }}" alt="Profile Picture">
                            @endif
                        </div>
                    </div>
                    <form method="POST" action="{{ route('profile.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="row justify-content-center align-items-center">
                            <div class="col-auto">
                                <div class="form-group">
                                    <label for="profile_image">
                                        <a class="button button-secondary"><i class="fa-regular fa-image"></i></a>
                                        <input type="file" class="form-control-file" id="profile_image" name="profile_image" hidden>
                                    </label>
                                </div>
                            </div>
                            <div class="col-auto">
                                <button type="submit" class="button button-primary">
                                    <span class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span>
                                    Upload Image
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-lg p-5 light-card">
                    @include('profile.form')
                </div>
            </div>
        </div>
    </div>
    @include('partials._footer')
@endsection
