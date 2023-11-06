@extends('layouts.app')

@section('content')

@include('partials._header')

@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif
@if (session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif
<div id="page-content">
    <div class="container-fluid post-container my-5 pb-5">
        <div class="row g-2 justify-content-center">
            <div class="col-auto">
                <x-profile-component :user="$post->user" />
            </div>
            <div class="col-md-6">
                <div class="row justify-content-between">
                    <div class="col-auto">
                        <a class="text-dark" href="{{ route('profile.show', $post->user->id) }}">
                            <div class="name">
                                {{ $post->user->full_name }}
                                <i class="text-identifier text-to-highlight">({{$post->user->username }})</i>
                                @if ($post->user->id === $authUser->id)
                                    <i class="fa-regular fa-user fa-xs ms-2" title="you"></i>
                                @endif
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
                    <x-follow-button :user="$post->user" />
                    <i class="date">
                        @if ($post->isEdited())
                            {{ $post->updated_at->format('F j, Y h:i A') }}  <i class="fa-solid fa-pen"></i>  Edited
                        @else
                            {{ $post->created_at->format('F j, Y h:i A') }}
                        @endif
                    </i>
                    @can('view-post', $post)
                        <div class="my-2">
                            <div class="card post-card">
                                <div class="card-body m-2">
                                    <p>{!! nl2br(e($post->content)) !!}</p>
                                    @if ($post->isShared())
                                        @php 
                                            $originalPost = $post->originalPost;
                                        @endphp
                                        <a class="text-share" href="{{ route('post.show', $originalPost->id) }}">
                                            @can ('view-post', $post)
                                                <div class="d-flex align-items-center">
                                                    <div class="text-share m-1">Shared from
                                                        {{ $originalPost->user->username }}'s Post
                                                    </div>
                                                </div>
                                                <div class="card post-card-share">
                                                    <div class="card-body mb-3">
                                                        <p>{!! nl2br(e($originalPost->content)) !!}</p>
                                                        @if ($originalPost->media)
                                                        <img src="{{ asset($originalPost->media->file_path) }}" class="post-media" alt="Post Image">
                                                        @endif
                                                    </div>
                                                </div>
                                            @else
                                                <div class="card bg-light">
                                                    <div class="card-body m-2">
                                                        <i class="text-share">Content unavailable.</i>
                                                    </div>
                                                </div>
                                            @endcan
                                        </a>
                                    @elseif ($post->media)
                                        <div class="container-fluid text-center">
                                            <img src="{{ asset($post->media->file_path) }}" class="img-fluid rounded my-2" alt="Post Image">
                                        </div>
                                    @endif
                                </div>
                            </div>
                            @include('post.form_actions')
                            @include('post.form_comment')
                        </div>
                    @else
                        @if ($post->isOriginalDeleted())
                            <div class="my-2">
                                <div class="card bg-light">
                                    <div class="card-body m-2">
                                        <i class="text-share">Original post was deleted :(</i>
                                    </div>
                                </div>
                            </div>
                        @else
                        <div class="my-2">
                            <div class="card bg-light">
                                <div class="card-body m-2">
                                    <i class="text-share">This content is private. Follow the user to view posts.</i>
                                </div>
                            </div>
                        </div>
                        @endif
                    @endcan
                </div>
            </div>
        </div>
    </div>
</div>
@include('partials._footer')

@endsection
