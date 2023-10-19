@extends('layouts.app')

@section('content')

@include('partials._header')

@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif
<div id="page-content">
    <div class="container post-container my-5">
        <div class="row g-2 justify-content-center mb-3">
			<div class="col-auto">
                <x-profile-component :authUser="$authUser"/>
            </div>
			<div class="col-md-6">
				<div class="row justify-content-between">
					<div class="col-auto">
						<a class="text-dark" href="{{ route('profile.show', $authUser->id) }}">
							<div class="name">
								{{ $authUser->full_name }}
							</div>
						</a>
					</div>
					@include('post.form_share')
				</div>
			</div>
		</div>
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
					<div class="my-2">
						@if ($post->isShared())
							@php 
								$originalPost = $post->originalPost;
							@endphp
							<div class="d-flex align-items-center">
								<div class="text-share m-1">Shared from
									<a class="text-share-link" href="{{ route('post.show', $originalPost->id) }}">
										{{ $originalPost->user->username }}
									</a>
								</div>
							</div>
							<div class="card post-card">
								<div class="card-body mb-3">
									<p>{{ $originalPost->content }}</p>
									@if ($originalPost->media)
									<img src="{{ asset($originalPost->media->getFilePathAttribute()) }}" class="post-media" alt="Post Image">
									@endif
								</div>
							</div>
						@else
							<div class="card post-card">
								<div class="card-body mb-3">
									<p>{{ $post->content }}</p>
									@if ($post->media)
									<img src="{{ asset($post->media->getFilePathAttribute()) }}" class="post-media" alt="Post Image">
									@endif
								</div>
							</div>
						@endif
					</div>
				</div>
			</div>
		</div>
    </div>
</div>
@include('partials._footer')

@endsection
