@extends('layouts.app')

@section('content')

@include('partials._header')
<div id="page-content">
    <div class="container my-5 pb-5">
        @if (session('success'))
            <div class="position-fixed bottom-0 end-0 p-3" style="z-index: 11">
                <div id="successToast" class="toast hide" role="alert" aria-live="assertive" aria-atomic="true">
                    <div class="toast-header alert-success">
                        <label class="fw-bold text-share me-auto">Success</label>
                        <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                    </div>
                    <div class="toast-body">
                        {{ session('success') }}
                    </div>
                </div>
            </div>
        @endif

        <div class="row justify-content-center g-0">
            <div class="col-lg order-2 order-lg-1">
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
            <div class="col-lg-3 order-1 order-lg-2 mb-5">
                <div class="card light-card post-card-secondary p-4 mb-5">
                    <div class="card-body text-center">
                        <h6 class="card-text mb-4">Create a MicroPost!🎉</h6>
                        <a href="{{ route('post.create')}}" class="button button-primary button-big">
                            <i class="fa-solid fa-plus fa-lg"></i>
                            Create
                        </a>
                    </div>
                </div>
                @if ($user->hasNoProfile())
                    <div class="card light-card p-4 mb-5">
                        <div class="card-body text-center">
                            <h6 class="card-text mb-4">Setup your Profile</h6>
                            <a href="{{ route('profile.edit', $user->id) }}" class="button button-secondary">
                                Setup
                            </a>
                        </div>
                    </div>
                @endif
                @if ($user->recommended_users->count())
                    <i class="text-share">People you may know</i>
                @endif
                @foreach ($user->recommended_users as $recommend)
                    <x-user-component :user="$recommend" />
                @endforeach
            </div>
        </div>
    </div>
</div>
@include('partials._footer')

@endsection
