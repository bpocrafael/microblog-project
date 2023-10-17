@php
	$authUser = auth()->user();
@endphp

@if($authUser->isNot($post->user))
	<div class="col-auto">
		@if($authUser->isFollowing($post->user))
			<form method="POST" action="{{ route('follow.destroy', $post->user->id) }}">
				@csrf
				@method('DELETE')
				<button class="button button-light" type="submit">
					<i class="fa-solid fa-circle-check"></i>
					Following
				</button>
			</form>
			@else
			<form method="POST" action="{{ route('follow.update', $post->user->id) }}">
				@csrf
				@method('PUT')
				<button class="button button-light" type="submit">
					<i class="fa-regular fa-circle-check"></i>
					Follow
				</button>
			</form>
		@endif
	</div>
@endif
