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
                <a class="text-dark" href="{{ route('profile.index', $post->user->username) }}">
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
            </div>
        </div>
    </div>
</div>
@include('partials._footer')
@endsection
