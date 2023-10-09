@extends('layouts.app')

@section('content')

@include('partials._header')

@php
	$authUser = auth()->user();
@endphp

<div id="page-content">
	<div class="container">
		<div class="row">
			<div class="col">
				<h6>Followers</h6>
				@foreach ($followers as $follower)
					<div class="card mb-2">
						<div class="card-body">
							<div class="row">
								<div class="col">
									<a class="text-dark" href="{{ route('profile.show', $follower->id) }}">
										<img src="{{ asset('assets/images/microblog-logo-iconx30.png') }}" alt="Image">
										{{ $follower->username }}
									</a>
								</div>
								<div class="col-2">
									@if($authUser->isNot($follower))
										@if(!$authUser->isFollowing($follower))
											<form method="POST" action="{{ route('follow.update', $follower->id) }}">
												@csrf
												@method('PUT')
												<button class="btn btn-dark" type="submit">Follow</button>
											</form>
										@endif
									@endif
								</div>
							</div>
						</div>
					</div>
				@endforeach
			</div>
			<div class="col">
				<h6>Following</h6>
				@foreach ($followings as $following)
					<div class="card mb-2">
						<div class="card-body">
							<div class="row">
								<div class="col">
									<a class="text-dark" href="{{ route('profile.show', $following->id) }}">
										<img src="{{ asset('assets/images/microblog-logo-iconx30.png') }}" alt="Image">
										{{ $following->username }}
									</a>
								</div>
								<div class="col-2">
									@if($authUser->isNot($following))
										@if($authUser->isFollowing($following))
											<form method="POST" action="{{ route('follow.destroy', $following->id) }}">
												@csrf
												@method('DELETE')
												<button class="btn btn-dark" type="submit">Unfollow</button>
											</form>
										@endif
									@endif
								</div>
							</div>
						</div>
					</div>
				@endforeach
			</div>
		</div>
	</div>
</div>

@include('partials._footer')

@endsection