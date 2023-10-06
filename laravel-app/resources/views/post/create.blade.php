@extends('layouts.app')

@section('content')

@include('partials._header')
<div id="page-content">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <img src="{{ asset('assets/images/microblog-logo-iconx30.png') }}" alt="Image">
                <a class="text-dark" href="{{ route('profile.show', $user->id) }}">{{ $user->username }}</a>

                <div class="container p-3">
                    <form method="POST" action="{{ route('post.store', $user->id)}}">
                        
                        @csrf
                        <div class="form-group my-3">
                            <textarea id="content" name="content" class="form-control" rows="2" placeholder="Enter your microblog here..."></textarea>
                        </div>
                        
                        @error('content')
                        <span class="text-danger" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                        
                        <div class="text-end">
                            <a href="{{ route('home') }}" class="btn btn-secondary"> {{ __('Cancel') }} </a>
                            <button type="submit" class="btn btn-dark">Create Post</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@include('partials._footer')

@endsection
