@extends('layouts.app')

@section('content')

@include('partials._header')

@php
	$authUser = auth()->user();
@endphp

<div id="page-content">
	<div class="p-3">
		<div class="row justify-content-center">
			<div class="col-md-4 text-center">
				<img class="img-fluid w-50" src="{{ asset('assets/images/microblog-logo.png') }}" alt="Microblog Logo">
			</div>
			<div class="col-6 pt-1">
				<div class="row justify-content-between">
					<div class="col">
						<label>Name</label>
						<p class="fw-bold">{{ $user->full_name }}</p>
					</div>
					<div class="col-2 align-self-center">
						@if($authUser->isNot($user))
							@if($authUser->isFollowing($user))
								<form method="POST" action="{{ route('follow.destroy', $user->id) }}">
									@csrf
									@method('DELETE')
									<button class="btn btn-dark" type="submit">Unfollow</button>
								</form>
							@else
								<form method="POST" action="{{ route('follow.update', $user->id) }}">
									@csrf
									@method('PUT')
									<button class="btn btn-dark" type="submit">Follow</button>
								</form>
							@endif

						@endif
					</div>
					<div class="col-3 align-self-center">
						<form method="GET" action="{{ route('follow.show', $user->id) }}">
							<button class="btn btn-dark" type="submit">Follower List</button>
						</form>
					</div>
				</div>
				<div class="row">
					<label>Username</label>
					<p class="fw-bold">{{ $user->username }}</p>
				</div>
				<div class="row">
					<label>Email</label>
					<p class="fw-bold">{{ $user->email}}</p>
				</div>
				<div class="row">
					<label>Bio</label>
					<p class="fw-bold">{{ $user->information->bio }}</p>
				</div>
				<div class="row">
					<label>Gender</label>
					<p class="fw-bold">{{ $user->information->gender }}</p>
				</div>
				<div class="row">
					<div class="col">
						<label>User created at</label>
						<p class="fw-bold">{{ $user->created_at->format('F j, Y') }}</p>
					</div>
					<div class="col">
						@if ($user->updated_at)
						<label>Updated at</label>
							<p class="fw-bold">{{ $user->updated_at->format('F j, Y') }}</p>
						@endif
					</div>
				</div>
				<div class="card m-1 mb-3">
					<div class="card-body">
						<div class="row">
							<div class="col offset-1">
								<label>Followers</label>
								<p class="fw-bold mt-1">{{ $user->followers->count() }}</p>
							</div>
							<div class="col">
								<label>Posts</label>
								<p class="fw-bold mt-1">{{ $user->posts->count() }}</p>
							</div>
							<div class="col">
								<label>Likes</label>
								<p class="fw-bold mt-1">{{ $user->likes }}</p>
							</div>
						</div>
					</div>
				</div>
				@can('update-user-profile', $user)
					<div class="row justify-content-center">
						<div class="col-3">
							<a href="{{ route('profile.edit', $user->id) }}" class="btn btn-secondary">Update Information</a>
						</div>
					</div>
				@endcan
			</div>
		</div>
	</div>
	@foreach ($posts as $post)
		<x-post-component :post="$post" :user="$user"/>
	@endforeach
	<div class="container m-3">
		{{ $posts->links('pagination::bootstrap-5') }}
	</div>
</div>

@include('partials._footer')

@endsection
