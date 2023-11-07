@extends('layouts.app')

@section('content')

@include('partials._header')

@if (session('success'))
    @include('partials._toast')
@endif
<div class="profile-page">
    <div class="container-fluid">
        <div class="row justify-content-center light-card p-5">
            <div class="col-md-5 text-center mb-5">
                <div class="row justify-content-center text-center">
                    <div class="col-auto">
                        @if ($user->image_path === "assets/images/user-solid.svg")
                            <div class="profile-letter">
                                <div class="letter-bg">
                                    {{ $user->first_letter }}
                                </div>
                            </div>
                        @else
                            <img id="profile-image" class="img-fluid w-50 profile-image" src="{{ asset($user->image_path) }}" alt="Profile Picture">
                        @endif
                    </div>
                </div>
                <div class="row m-4 justify-content-center">
                    <div class="col-auto mx-3">
                        <a class="text-share fw-bold text-share-link" href="{{ route('follow.show', $user->id) }}">{{ $user->followers->count() }} Followers</a>
                    </div>
                    <div class="col-auto mx-3">
                        <label class="text-share fw-bold">{{ $user->posts->count() }} Posts</label>
                    </div>
                    <div class="col-auto mx-3">
                        <label class="text-share fw-bold">{{ $user->likes }} Likes</label>
                    </div>
                </div>
                @can('update-user-profile', $user)
                    <div class="row justify-content-center">
                        <div class="col-auto">
                            <a href="{{ route('profile.edit', $user->id) }}" class="button button-primary">
                                <i class="fa-solid fa-pen"></i>
                                Edit
                            </a>
                        </div>
                    </div>
                @endcan
                <x-follow-button :user="$user" />
            </div>
            <div class="col justify-content-center">
                <div class="row mb-5">
                    <div class="col-auto">
                        <div class="text-label">Name</div>
                    </div>
                    <div class="col-sm">
                        <div>{{ $user->full_name }}</div>
                    </div>
                </div>
                <div class="row mb-5">
                    <div class="col-auto">
                        <div class="text-label">Username</div>
                    </div>
                    <div class="col-sm">
                        <div>{{ $user->username }}</div>
                    </div>
                </div>
                <div class="row mb-5">
                    <div class="col-auto">
                        <div class="text-label">Bio</div>
                    </div>
                    <div class="col-sm">
                        <div>{{ $user->information->bio }}</div>
                    </div>
                </div>
                <div class="row mb-5">
                    <div class="col-auto">
                        <div class="text-label">Gender</div>
                    </div>
                    <div class="col-sm">
                        <div>{{ $user->information->gender }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="page-content" class="container">
        @if ($authUser->isFollowing($user) || $authUser->id === $user->id)
            @foreach ($posts as $post)
                <x-post-component :post="$post" :user="$user"/>
            @endforeach
            {{ $posts->links() }}
        @else
            <div class="row my-5 text-center">
                <div class="col">
                    <img src="{{ asset('assets/images/coffee-vector-min.webp') }}" alt="Coffee">
                    <div class="my-3">
                        <h5 class="">No posts available</h5>
                        <i class="text-share">Follow microblog users or create one :)</i>
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>

@include('partials._footer')

@endsection
