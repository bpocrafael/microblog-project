@extends('layouts.app')

@section('content')

@include('partials._header')
<div id="page-content">
	<div class="p-3">
		<div class="row justify-content-center">
			<div class="col-md-4 text-center">
				<img class="img-fluid w-50" src="{{ asset('assets/images/microblog-logo.png') }}" alt="Microblog Logo">
			</div>
			<div class="col-6 pt-1">
				<div class="row">
					<div class="col">
						<label>Name</label>
						<p class="fw-bold">{{ $user->user_information->first_name . ' ' . $user->user_information->middle_name . ' ' . $user->user_information->last_name}} </p>
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
					<p class="fw-bold">{{ $user->user_information->bio }}</p>
				</div>
				<div class="row">
					<label>Gender</label>
					<p class="fw-bold">{{ $user->user_information->gender }}</p>
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
								<p class="fw-bold mt-1">{{ '0' }}</p>
							</div>
							<div class="col">
								<label>Posts</label>
								<p class="fw-bold mt-1">{{ '0' }}</p>
							</div>
							<div class="col">
								<label>Likes</label>
								<p class="fw-bold mt-1">{{ '0' }}</p>
							</div>
						</div>
					</div>
				</div>
				<div class="row justify-content-center">
					<div class="col-3">
						<a href="{{ route('profile.edit', $user->id) }}" class="btn btn-secondary">Edit Information</a>
					</div>
				</div>
			</div>
		</div>
	</div>
	@foreach ($posts as $post)
		<x-post-component :post="$post" />
	@endforeach
</div>

@include('partials._footer')

@endsection
