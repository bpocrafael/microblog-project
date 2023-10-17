@extends('layouts.app')

@section('content')

@include('partials._header')

<div id="page-content">
    <div class="post-container my-5">
        <div class="row g-2 justify-content-center">
            <div class="col-auto">
                <a class="text-dark" href="{{ route('profile.show', $post->user->id) }}">
                    @if ($post->user->image_path === "assets/images/user-solid.svg")
                        <div class="profile-button" id="profileButtonContainer1">
                            <div class="bg">
                                <div class="letter">
                                    {{ substr($post->user->full_name, 0, 1) }}
                                </div>
                            </div>
                        </div>
                    @else
                        <button class="custom-profile-button" id="profileButtonContainer1">
                            <div class="image-bg">
                                <img src="{{ asset($post->user->image_path) }}" alt="Profile Image">
                            </div>
                        </button>
                    @endif
                </a>
            </div>
            <div class="col-md-6">
                <div class="row justify-content-between">
                    <div class="col-auto">
                        <a class="text-dark" href="{{ route('profile.show', $post->user->id) }}">
                            <div class="name">
                                {{ $post->user->full_name }}
                            </div>
                        </a>
                    </div>
                    <div class="col-auto">
                        @can('edit-post', $post)
                            <a href="{{ route('post.edit', $post) }}" class="button button-light">
                                <i class="fa-solid fa-pen"></i>
                            </a>
                        @endcan
                    </div>
                    @include('partials._follow')
                    <i class="date">
                        @if ($post->updated_at != $post->created_at)
                            {{ $post->updated_at->format('F j, Y') }}  <i class="fa-solid fa-pen"></i>  Edited
                        @else
                            {{ $post->created_at->format('F j, Y') }}
                        @endif
                    </i>
                    @can('view-post', $post)
                        <div class="my-2">
                            @if ($post->isShared())
                                @php 
                                    $originalPost = $post->originalPost;
                                @endphp
                                <div class="d-flex align-items-center">
                                    <div class="text-share m-1">Shared from
                                        <a class="text-share-link" href="{{ route('post.show', $originalPost->id) }}">
                                            {{ $originalPost->user->username }}'s Post
                                        </a>
                                    </div>
                                </div>
                            @endif
                            @if ($post->isContentAvailableFor($authUser))
                                <div class="card post-card">
                                    <div class="card-body m-2">
                                        <p>{{ $post->content }}</p>
                                        @if ($post->media)
                                            <img src="{{ asset($post->media->getFilePathAttribute()) }}" style="max-width: 100%; height: auto;" alt="Post Image">
                                        @endif
                                    </div>
                                </div>
                            @else
                                <div class="card bg-light">
                                    <div class="card-body m-2">
                                        <i class="text-share">Content unavailable.</i>
                                    </div>
                                </div>
                            @endif
                            @include('post.form_actions')
                            @include('post.form_comment')
                        </div>
                    @else
                        <div class="my-2">
                            <div class="card bg-light">
                                <div class="card-body m-2">
                                    <i class="text-share">This content is private. Follow the user to view posts.</i>
                                </div>
                            </div>
                        </div>
                    @endcan
                </div>
            </div>
        </div>
    </div>
</div>
@include('partials._footer')

@endsection
