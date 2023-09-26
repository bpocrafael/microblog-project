@extends('layouts.app')

@section('content')

@include('partials._header')
<div class="container py-4">
    <div class="row justify-content-center mb-4">
        <div class="alert alert-success alert-dismissible fade show" role="alert">
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
    <div class="row justify-content-center mb-4">
        <div class="col-md">
            <div class="p-4">
                <div class=" text-center">
                    <img class="mr-0 w-25" src="{{ asset('assets/images/empty.png') }}" alt="Empty picture">
                </div>
            </div>
        </div>
    </div>
</div>
@include('partials._footer')

@endsection
