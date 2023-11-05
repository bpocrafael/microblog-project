@extends('layouts.app')

@section('content')

@include('partials._header')
<div id="page-content">
    <div class="container-fluid my-5">
        <div class="row g-2 justify-content-center">
            <div class="col-auto">
                <x-profile-component :user="$post->user" />
            </div>
            <div class="col-md-6">
                <div class="row justify-content-between align-items-center">
                    <div class="col-auto">
                        <a class="text-dark" href="{{ route('profile.show', $post->user->id) }}">
                            <div class="name">
                                {{ $post->user->full_name }}
                            </div>
                        </a>
                    </div>
                    <x-follow-button :user="$post->user" />
                    @can('delete-post', $post)
                        <div class="col-auto">
                            <button type="button" class="button button-danger" data-bs-toggle="modal" data-bs-target="#deletePostModal">
                                <i class="fa-regular fa-trash-can"></i>
                            </button>
                            <div class="modal fade" id="deletePostModal" tabindex="-1" role="dialog" aria-labelledby="deletePostModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content light-card">
                                        <div class="modal-header">
                                            <h6 class="" id="deletePostModalLabel">Confirm Deletion</h6>
                                            <button type="button" class="button button-secondary" data-bs-dismiss="modal" aria-label="Close">
                                                <i class="fa-solid fa-xmark"></i>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            Are you sure you want to delete this post?
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="button button-secondary" data-bs-dismiss="modal">Cancel</button>
                                            <form id="delete-post-form" method="POST" action="{{ route('post.destroy', $post) }}">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="button button-danger">
                                                    <span class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span>
                                                    Delete
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endcan
                    <i class="date">
                        @if ($post->isEdited())
                            {{ $post->updated_at->format('F j, Y h:i A') }}  <i class="fa-solid fa-pen"></i>  Edited
                        @else
                            {{ $post->created_at->format('F j, Y h:i A') }}
                        @endif
                    </i>
                </div>
                <div class="card post-card my-2">
                    <div class="card-body m-2 mb-0">
                        <form method="POST" action="{{ route('post.update', $post) }} " enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="mb-3">
                                <textarea id="content" name="content" class="form-control" rows="1" placeholder="Enter your microblog here..." autofocus>{{ $post->content }}</textarea>
                                @error('content')
                                <span class="text-danger" role="alert">
                                    <i>{{ $message }}</i>
                                </span>
                                @enderror
                            </div>
                            @if ($post->media && !$post->isShared())
                                <div class="container-fluid text-center">
                                    <img id="postImage" src="{{ $post->media ? asset($post->media->file_path) : '' }}" class="rounded img-fluid my-2">
                                </div>
                            @endif

                            <div class="mt-3">
                                <div class="row justify-content-between align-items-center">
                                    <div class="col-auto">
                                        @if (!$post->isShared())
                                            <label for="post_image">
                                                <a class="button button-secondary"><i class="fa-regular fa-image"></i></a>
                                            </label>
                                            <input type="file" id="post_image" name="image" hidden>
                                            @error('image')
                                            <span class="text-danger" role="alert">
                                                <i>{{ $message }}</i>
                                            </span>
                                            @enderror
                                        @endif
                                    </div>
                                    <div class="col-auto">
                                        <a href="{{ route('home') }}" class="button button-secondary me-3"> {{ __('Cancel') }} </a>
                                        <button type="submit" class="button button-primary">
                                            <span class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span>
                                            Update Post
                                        </button>
                                    </div>
                                </div>
                            </div>                       
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@include('partials._footer')

@endsection
