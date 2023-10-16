@extends('layouts.app')

@section('content')

@include('partials._header')
<div id="page-content">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <img src="{{ asset('assets/images/microblog-logo-iconx30.png') }}" alt="Image">
                <a class="text-dark" href="{{ route('profile.index') }}">{{ $post->user->username }}</a>
                <div class="container p-3">
                    <form method="POST" action="{{ route('post.update', $post) }} " enctype="multipart/form-data">
                        @csrf
                        
                        @method('PUT')
                        <div class="form-group my-3">
                            <textarea id="content" name="content" class="form-control" rows="2" placeholder="Enter your microblog here...">{{ $post->content }}</textarea>
                        </div>
                            @if ($post->media)
                                <img id="preview-image" src="{{ asset($post->media->getFilePathAttribute()) }}" style="max-width: 100%; height: auto;">
                            @endif
                        <div class="form-group my-3">
                            <label for="photo">Update Photo:</label>
                            <input type="file" id="photo" name="image">
                        </div>

                        @error('content')
                        <span class="text-danger" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                        
                        @error('image')
                        <span class="text-danger" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror

                        @error('content')
                        <span class="text-danger" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
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
                        
                        <div class="text-end">
                            <a href="{{ route('home') }}" class="btn btn-secondary"> {{ __('Cancel') }} </a>
                            <button type="submit" class="btn btn-dark">Update Post</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@include('partials._footer')

@endsection
<script type="module" src="{{ asset('assets/js/post_create.js')}}"></script>
