@extends('layouts.app')

@section('content')

@include('partials._header')

@php
    $authUser = auth()->user();
@endphp

<div id="page-content">
    <div class="container">
        <div class="row justify-content-center mt-3">
            <div class="col-md-6">
                <div class="card light-card px-5">
                    <div class="card-body">
                        <form class="mx-auto my-auto" role="search" action="{{ route('search.followers', $user) }}" method="GET">
                            <div class="input-group">
                                <input class="form-control text-center" id="query" type="search" name="query" placeholder="Search Followers and Followings" aria-label="Search user" autocomplete="off">
                                <label for="query" class="tan-label ms-1"><i class="fa-solid fa-magnifying-glass fa-xs pt-3"></i></label>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="row justify-content-center mb-5">
            <div class="col m-5">
                <h4>Followers ( {{ $user->followers->count() }} )</h4>
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
                <h4>Following ( {{ $user->following->count() }} ) </h4>
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
