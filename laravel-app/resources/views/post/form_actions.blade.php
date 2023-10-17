<form class="like-form" data-post-id="{{ $post->id }}"
	action="{{ route($post->likes->contains('user_id', $post->user->id) ? 'post.unlike' : 'post.like', $post) }}"
	method="POST">
	@if ($post->isContentAvailableFor($authUser))
		<div class="row justify-content-end align-items-center p-2">
			<div class="col-auto">
				@csrf
				<a href="{{ route('share', $post->id) }}" class="button button-light">
					<i class="fa-regular fa-share-from-square"></i>
				</a>
			</div>
			<div class="col-auto">
				<a href="{{ route('post.show', $post->id) }}" class="button button-light">
					{{ $post->comments->count() }}
					<i class="fa-regular fa-comment"></i>
				</a>
			</div>
			@csrf
			@if ($post->likes->contains('user_id', $post->user->id))
				@method('DELETE')
				<div class="col-auto">
					<button type="submit" class="button button-secondary">
						{{ $post->likes->count() }}
						<i class="fa-solid fa-thumbs-up"></i>
					</button>
				</div>
			@else
				<div class="col-auto">
					<button type="submit" class="button button-light like-button">
						{{ $post->likes->count() }}
						<i class="fa-regular fa-thumbs-up"></i>
					</button>
				</div>
			@endif
		</div>
	@endif
</form>
