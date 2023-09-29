@extends('layouts.app')

@section('content')

@include('partials._header')
<div id="page-content">
    <div class="container mb-5 pb-5">
        <div class="row justify-content-center mb-4">
            <div class="alert alert-secondary alert-dismissible fade show" role="alert">
                @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
                @endif
                
                <h6 class="text-center">
                    👋 Hey there, Microblogger! Welcome to your dashboard 🎉 
                </h6>
                <p class="text-center">
                    Get ready to share your daily adventures, memes, and musings in 140 characters or less. 📝<br>
                </p>
                <h6 class="text-center">
                    #MicroblogMania #ShortAndSweet #WelcomeToTheMicroverse
                </h6>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card p-3">
                    <div class="card-body text-center">
                        <h5 class="card-title">MicroPost🎉</h5>
                        <p class="card-text">Create your very first MicroPost!</p>
                        <a href="{{ route('post.create')}}" class="btn btn-dark p-3">Create Post</a>
                    </div>
                </div>
            </div>
        </div>
        @foreach ($posts as $post)
            <x-post-component :post="$post" />
        @endforeach

    </div>
</div>
@include('partials._footer')

@endsection
