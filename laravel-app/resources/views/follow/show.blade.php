@extends('layouts.app')

@section('content')

@include('partials._header')

@php
    $authUser = auth()->user();
@endphp

<div id="page-content">
    <div class="container">
        <div class="row justify-content-center mb-5">
            <div class="col m-5">
                <h4>Followers</h4>
                @foreach ($followers as $follower)
                    <x-user-component :user="$follower" />
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
            <div class="col m-5">
                <h4>Following</h4>
                @foreach ($followings as $following)
                    <x-user-component :user="$following" />
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

@include('partials._footer')

@endsection
