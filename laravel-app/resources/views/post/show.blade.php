@extends('layouts.app')

@section('content')

@include('partials._header')

<div id="page-content">
    <div class="post-container my-5">
        <div class="row g-0 justify-content-center">
            <div class="col-auto">
                <a class="text-dark" href="{{ route('profile.show', $post->user->id) }}">
                    <div class="profile-button" id="profileButtonContainer1">
                        <div class="bg">
                            <div class="letter">
                                {{ substr($post->user->full_name, 0, 1) }}
                            </div>
                        </div>
                    </div>
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
                        @can('edit', $post)
                            <a href="{{ route('post.edit', $post) }}" class="button button-light">
                                <i class="fa-solid fa-pen"></i>
                            </a>
                        @endcan
                    </div>
                    @include('partials._follow')
                    <i class="date">
                        @if ($post->deleted_at)
                            Deleted at: {{ $post->deleted_at->format('F j, Y') }}
                        @elseif ($post->updated_at != $post->created_at)
                            Updated at: {{ $post->updated_at->format('F j, Y') }}
                        @else
                            {{ $post->created_at->format('F j, Y') }}
                        @endif
                    </i>
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
                        <div class="card post-card">
                            <div class="card-body m-2">
                                @if ($post->media)
                                    <img class="image-post my-3" src="{{ asset($post->media->getFilePathAttribute()) }}" alt="Post Image">
                                @endif
                                <p>{{ $post->content }}</p>
                            </div>
                        </div>
                        @include('post.form_actions')
                        @include('post.form_comment')
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
    @include('partials._footer')
@endsection
