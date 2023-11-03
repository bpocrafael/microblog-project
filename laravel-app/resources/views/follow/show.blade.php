@extends('layouts.app')

@section('content')

@include('partials._header')

@php
    $authUser = auth()->user();
@endphp

<div id="page-content">
    <div class="container">
        <div class="row justify-content-center mb-5">
            <div class="col-lg-5">
                <h4>Followers</h4>
                <div class="card p-4">
                @foreach ($followers as $follower)
                <div class="card post-card mb-2">
                        <div class="card-body">
                            <div class="row justify-content-between align-items-center">
                                <div class="col-auto">
                                    <div class="row align-items-center">
                                        <div class="col-auto">
                                            <x-profile-component :user="$follower" />
                                        </div>
                                        <div class="col-auto">
                                            <label class="name">
                                                <a class="text-dark" href="{{ route('profile.show', $follower->id) }}">
                                                    {{ $follower->full_name }}
                                                </a>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <x-follow-button :user="$follower" />
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
                @if ($followers->count() == 0)
                <div class="card post-card mb-2">
                    <div class="card-body">
                        <div class="row justify-content-between align-items-center">
                            <div class="col-auto">
                                You currently have no followers.
                            </div>
                        </div>
                    </div>
                </div>
                @endif
                </div>
            </div>
            <div class="col-lg-5">
                <h4>Following</h4>
                <div class="card p-4">
                @foreach ($followings as $following)
                    <div class="card post-card mb-2">
                        <div class="card-body">
                            <div class="row justify-content-between align-items-center">
                                <div class="col-auto">
                                    <div class="row align-items-center">
                                        <div class="col-auto">
                                            <x-profile-component :user="$following" />
                                        </div>
                                        <div class="col-auto">
                                            <label class="name">
                                                <a class="text-dark" href="{{ route('profile.show', $following->id) }}">
                                                    {{ $following->full_name }}
                                                </a>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <x-follow-button :user="$following" />
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
                @if ($followings->count() == 0)
                <div class="card post-card mb-2">
                    <div class="card-body">
                        <div class="row justify-content-between align-items-center">
                            <div class="col-auto">
                                You are currently not following any users.
                            </div>
                        </div>
                    </div>
                </div>
                @endif
                </div>
            </div>
        </div>
    </div>
</div>

@include('partials._footer')

@endsection
