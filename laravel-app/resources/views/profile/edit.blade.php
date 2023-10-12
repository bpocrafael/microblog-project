@extends('layouts.app')

@section('content')
    @include('partials._header')
    <div class="container text-center">
        <div class="row justify-content-center">
            <div class="col-md-4 text-center">
                <img id="profileImage" class="img-fluid w-50" src="{{ asset($imagePath) }}" alt="Microblog Logo">
                <form method="POST" action="{{ route('profile.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="profile_image">Profile Image</label>
                        <input type="file" class="form-control-file" id="profile_image" name="profile_image">
                    </div>
                    <button type="submit" class="btn btn-primary">Upload Profile Image</button>
                </form>
            </div>
        </div>
    </div>
    <div id="page-content">
        <div class="p-3">
            <div class="row justify-content-center">
                <div class="col-4 p-5 bg-light">
                    @include('profile.form')
                </div>
            </div>
        </div>
    </div>
    @include('partials._footer')
@endsection
