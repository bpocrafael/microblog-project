<!-- Comment Form -->
@if ($post->isContentAvailableFor($authUser))
	<div class="container">
		<div class="row justify-content-center">
			<div class="col">
				<form action="{{ route('comment.store', $post) }}" method="POST">
					@csrf

					<div class="form-group mt-3">
						<textarea id="comment" name="comment" class="form-control" rows="3" placeholder="Add a comment"></textarea>
					</div>

					@error('comment')
						<span class="text-danger" role="alert">
							<strong>{{ $message }}</strong>
						</span>
					@enderror

					<div class="text-end m-2">
						<button type="submit" class="button button-primary">
							<span class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span>
							Comment
						</button>
					</div>
				</form>
			</div>
		</div>
		<x-comment :comments="$post->comment" :post="$post" />
	</div>
@endif
