@extends('layouts.app')

@section('content')
    @include('partials._header')
    <div id="page-content">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif
                    <a class="text-dark" href="{{ route('profile.show', $post->user->id) }}">
                        <img src="{{ asset('assets/images/microblog-logo-iconx30.png') }}" alt="Image">
                        {{ $post->user->username }}
                    </a>
                    <div class="container p-3">
                        <div class="card">
                            <div class="card-body">
                                <p>{{ $post->content }}</p>
                            </div>
                            <div class="card-footer fst-italic">
                                @if ($post->deleted_at)
                                    Deleted at: {{ $post->deleted_at->format('F j, Y') }}
                                @elseif ($post->updated_at)
                                    Updated at: {{ $post->updated_at->format('F j, Y') }}
                                @else
                                    Created at: {{ $post->created_at->format('F j, Y') }}
                                @endif
                            </div>
                        </div>
                    </div>
                    <!-- Comment Form -->
                    <x-comment :comments="$post->comment" :post="$post" />
                    <div class="container mb-5">
                        <form action="{{ route('comments.store', $post) }}" method="POST">
                            @csrf

                            <div class="form-group mt-3">
                                <textarea id="content" name="content" class="form-control" rows="3" placeholder="Add a comment"></textarea>
                            </div>

                            @error('content')
                                <span class="text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror

                            <div class="text-end">
                                <button type="submit" class="btn btn-dark">Add Comment</button>
                            </div>
                        </form>
                    </div>
                    <form class="like-form" data-post-id="{{ $post->id }}"
                        action="{{ route($post->likes->contains('user_id', $post->user->id) ? 'post.unlike' : 'post.like', $post) }}"
                        method="POST">
                        <div class="row justify-content-end align-items-center p-1">
                            <div class="card p-1 likes-count" data-post-id="{{ $post->id }}">
                                {{ $post->likes->count() }} Likes
                            </div>
                        </div>
                        @csrf
                        @if ($post->likes->contains('user_id', $post->user->id))
                            @method('DELETE')
                            <div class="col-md-2 text-center">
                                <button type="submit" class="btn btn-secondary unlike-button">Unlike</button>
                            </div>
                        @else
                            <div class="col-md-2 text-center">
                                <button type="submit" class="btn btn-dark like-button">Like</button>
                            </div>
                        @endif
                </div>
                </form>
            </div>
        </div>
    </div>
    </div>
    @include('partials._footer')
@endsection
