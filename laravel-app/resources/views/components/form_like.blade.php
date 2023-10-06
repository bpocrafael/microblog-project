<form class="like-form"
	data-post-id="{{ $post->id }}"
	action="{{ route(
		$post->likes->contains('user_id', $user->id) ? 'post.unlike' : 'post.like',
		$post
	) }}" 
	method="POST">
	<div class="row justify-content-end align-items-center p-1">
		<div class="col-md-2 m-2 text-center">
			<div class="card p-1 likes-count" data-post-id="{{ $post->id }}">
				{{ $post->likes->count() }} Likes
			</div>
		</div>
		@csrf
		@if($post->likes->contains('user_id', $user->id))
			@method('DELETE')
			<div class="col-md-2 text-center">
				<button type="submit" class="btn btn-secondary unlike-button">Unlike</button>
			</div>
		@else
			<div class="col-md-2 text-center">
				<button type="submit" class="btn btn-dark like-button">Like</button>
			</div>
		@endif
	</div>
</form>
