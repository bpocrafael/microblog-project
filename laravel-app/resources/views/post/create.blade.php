@extends('layouts.app')

@section('content')
@include('partials._header')
<div id="page-content">
    <div class="container-fluid my-5">
        <div class="row g-2 justify-content-center">
            <div class="col-auto">
                <x-profile-component :user="$user" />
            </div>
            <div class="col-md-6">
                <a class="text-dark" href="{{ route('profile.show', $user->id) }}">
                    <div class="name my-2 mb-4">
                        {{ $user->full_name }}
                    </div>
                </a>
                <div class="card post-card my-2">
                    <div class="card-body m-2">
                        <form method="POST" action="{{ route('post.store', $user->id)}}" enctype="multipart/form-data">
                            
                            @csrf
                            <div class="mb-3">
                                <textarea id="content" name="content" class="form-control" rows="2" placeholder="Fill the world with your ideas." autofocus></textarea>
                                @error('content')
                                <span class="text-danger" role="alert">
                                    <i>{{ $message }}</i>
                                </span>
                                @enderror
                            </div>
                            
                            <div id="photo-preview" class="container-fluid text-center">
                                <img id="preview-image" class="img-fluid my-2">
                            </div>                       

                            <div class="my-3">
                                <div class="row justify-content-between align-items-center">
                                    <div class="col-auto">
                                        <label for="photo">
                                            <a class="button button-secondary"><i class="fa-regular fa-image"></i></a>
                                        </label>
                                        <input type="file" id="photo" name="image" hidden>
                                        @error('image')
                                        <span class="text-danger" role="alert">
                                            <i>{{ $message }}</i>
                                        </span>
                                        @enderror
                                    </div>
                                    <div class="col-auto">
                                        <a href="{{ route('home') }}" class="button button-secondary me-3"> {{ __('Cancel') }} </a>
                                        <button type="submit" class="button button-primary">
                                            <span class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span>
                                            Create Post
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

    @include('partials._footer')
@endsection
