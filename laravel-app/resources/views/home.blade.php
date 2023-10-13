@extends('layouts.app')

@section('content')

@include('partials._header')
<div id="page-content">
    <div class="container mb-5 pb-5">
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        
        <div class="row justify-content-center">
            <div class="col-7">
                <div class="card background-light p-3">
                    <div class="card-body text-center">
                        <h5 class="card-title">MicroPost🎉</h5>
                        <p class="card-text">Create a MicroPost!</p>
                        <a href="{{ route('post.create')}}" class="button button-primary">Create</a>
                    </div>
                </div>
            </div>
        </div>
        @foreach ($posts as $post)
            <x-post-component :post="$post" :user=$user />
        @endforeach

        {{ $posts->links('pagination::bootstrap-5') }}
    </div>
</div>
@include('partials._footer')

@endsection
