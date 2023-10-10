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
                    @if ($post->isShared())
                        @php 
                            $originalPost = $post->originalPost;
                        @endphp
                        <div class="d-flex align-items-center">
                            <div class="text ms-3 m-1">Shared from
                                <a class="text-dark" href="{{ route('post.show', $originalPost->id) }}">
                                    {{ $originalPost->user->username }}'s Post
                                </a>
                            </div>
                        </div>
                    @endif
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
                        @include('post.form_actions')
                    </div>
                    <div class="row">
                        <div class="row text-center">
                        @can('edit', $post)
                            <a href="{{ route('post.edit', $post) }}" class="btn btn-dark">Edit Post</a>
                        @endcan

                        @can('delete', $post)
                            <form id="delete-post-form" method="POST" action="{{ route('post.destroy', $post) }}">
                                @csrf
                                @method('DELETE')
                                <button type="button" class="btn btn-danger" onclick="confirmDelete()">Delete Post</button>
                            </form>

                            <script>
                                function confirmDelete() {
                                    if (confirm('Are you sure you want to delete this post?')) {
                                        document.getElementById('delete-post-form').submit();
                                    }
                                }
                            </script>
                        @endcan
                        </div>
                    </div>
                    @include('post.form_comment')
                </div>
            </div>
        </div>
    </div>
    </div>
    @include('partials._footer')
@endsection
