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
            @if (session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif
            <div class="row justify-content-center">
                <div class="col-md-5 text-center">
                    <div class="row justify-content-center text-center my-4">
                        <div class="col-auto">
                            <div class="d-flex justify-content-center align-items-center">
                                @if (!$user->image_path)
                                    <div class="profile-letter">
                                        <div class="letter-bg">
                                            {{ $user->first_letter }}
                                        </div>
                                    </div>
                                    <img id="profileImage" class="img-fluid w-50 profile-image" hidden>
                                @else
                                    <img id="profileImage" class="img-fluid w-50 profile-image"
                                        src="{{ asset($user->image_path) }}" alt="Profile Picture">
                                @endif
                            </div>
                            <div class="d-flex align-items-center justify-content-center my-3">
                                <form id="delete-profile-image" method="POST"
                                    action="{{ route('profile.destroy', $user) }}">
                                    @csrf
                                    @method('DELETE')
                                    <div class="col-auto">
                                        <button type="submit" class="button button-danger deleteButton me-5"
                                            onclick="confirmDelete()">
                                            <i class="fa-regular fa-trash-can"></i>
                                        </button>
                                    </div>
                                </form>
                                <form method="POST" action="{{ route('profile.store') }}" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row justify-content-center align-items-center g-0">
                                        <div class="col-auto">
                                            <div class="form-group">
                                                <label for="profile_image">
                                                    <a class="button button-secondary me-3"><i
                                                            class="fa-regular fa-image"></i></a>
                                                    <input type="file" class="form-control-file" id="profile_image"
                                                        name="profile_image" hidden>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <button type="submit" class="button button-primary">Upload Image</button>
                                        </div>
                                    </div>
                                </form>
                                <script>
                                    function confirmDelete() {
                                        if (confirm('Are you sure you want to delete this post?')) {
                                            document.getElementById('delete-profile-image').submit();
                                        }
                                    }
                                </script>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col p-5 post-card">
                    @include('profile.form')
                </div>
            </div>
        </div>
    </div>
    @include('partials._footer')
@endsection
