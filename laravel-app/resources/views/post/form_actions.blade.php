@if ($post->isContentAvailableFor($authUser))
	<div class="row justify-content-end align-items-center p-2">
		<div class="col-auto">
			<a href="{{ route('share.create', $post->id) }}" class="button button-light">
				<i class="fa-regular fa-share-from-square"></i>
			</a>
		</div>
		<div class="col-auto">
			<a href="{{ route('post.show', $post->id) }}" class="button button-light">
				{{ $post->comments->count() }}
				<i class="fa-regular fa-comment"></i>
			</a>
		</div>
		<div
			id="likeSection"
			class="col-sm-2"
			data-is-liked="{{ $post->isLikedBy($authUser) }}"
			data-post-id="{{ $post->id }}"
			>
			<button id="saveLike" 
				class="button button-light"
				data-post-id="{{ $post->id }}"
				data-action="like"
				data-url="{{ route('post.like', ['post' => $post->id]) }}"
				>
				<span id="liked-count-{{ $post->id }}">{{ $post->likes()->count() }}</span>
				<i class="fa-regular fa-thumbs-up"></i>
			</button>
			<button id="saveUnlike" 
				class="button button-secondary"
				data-post-id="{{ $post->id }}"
				data-action="unlike"
				data-url="{{ route('post.unlike', ['post' => $post->id]) }}"
				>
				<span id="like-count-{{ $post->id }}">{{ $post->likes()->count() }}</span>
				<i class="fa-solid fa-thumbs-up"></i>
			</button>
		</div>
	</div>
	@csrf
@endif
