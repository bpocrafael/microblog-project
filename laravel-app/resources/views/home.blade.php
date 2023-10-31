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
            <div class="col-9">
                <div class="card background-light p-3">
                    <div class="card-body text-center">
                        <h5 class="card-title">MicroPost🎉</h5>
                        <p class="card-text">Create a MicroPost!</p>
                        <a href="{{ route('post.create')}}" class="button button-primary">Create</a>
                    </div>
                </div>
            </div>
        </div>
        @foreach ($user->following_posts as $post)
            <x-post-component :post="$post" />
        @endforeach

        {{ $user->following_posts->links() }}
        @if ($user->hasNoDashboardPost())
            <div class="row my-5 text-center">
                <div class="col">
                    <img src="{{ asset('assets/images/coffee-vector-min.webp') }}" alt="Coffee">
                    <div class="my-3">
                        <h5 class="">No posts yet</h5>
                        <i class="text-share">Follow microblog users or create one :)</i>
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>
@include('partials._footer')

@endsection
