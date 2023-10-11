<form class="like-form" data-post-id="{{ $post->id }}"
	action="{{ route($post->likes->contains('user_id', $post->user->id) ? 'post.unlike' : 'post.like', $post) }}"
	method="POST">
	<div class="row justify-content-end align-items-center p-2">
		<div class="col-md-2">
			@csrf
			<a href="{{ route('share', $post->id) }}" class="btn btn-secondary">Share</a>
		</div>
		<div class="col-md-2">
			<div class="card p-1 text-center likes-count" data-post-id="{{ $post->id }}">
				{{ $post->likes->count() }} Likes
			</div>
		</div>
		@csrf
		@if ($post->likes->contains('user_id', $post->user->id))
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
