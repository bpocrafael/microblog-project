@extends('layouts.app')

@section('content')

@include('partials._header')

@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif
<div id="page-content">
    <div class="container-fluid post-container my-5 pb-5">
        <div class="row g-2 justify-content-center">
            <div class="col-auto">
                <x-profile-component :post="$post" />
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
                    <x-follow-button :user="$post->user" />
                    <i class="date">
                        @if ($post->updated_at != $post->created_at)
                            {{ $post->updated_at->format('F j, Y h:i a') }}  <i class="fa-solid fa-pen"></i>  Edited
                        @else
                            {{ $post->created_at->format('F j, Y h:i a') }}
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
                                            @can ('view-post', $originalPost)
                                                <div class="d-flex align-items-center">
                                                    <div class="text-share m-1">Shared from
                                                        @if ($post->isOriginalDeleted())
                                                            a deleted Post
                                                        @else
                                                        {{ $originalPost->user->username }}'s Post
                                                        @endif
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
