<!-- Comment Form -->
<div class="container mb-5">
	<x-comment :comments="$post->comment" :post="$post" />
	<div class="row justify-content-center">
		<div class="col-11">
			<form action="{{ route('comments.store', $post) }}" method="POST">
				@csrf

				<div class="form-group mt-3">
					<textarea id="content" name="content" class="form-control" rows="3" placeholder="Add a comment"></textarea>
				</div>

				@error('content')
					<span class="text-danger" role="alert">
						<strong>{{ $message }}</strong>
					</span>
				@enderror

				<div class="text-end m-2">
					<button type="submit" class="btn btn-dark">Add Comment</button>
				</div>
			</form>
		</div>
	</div>
</div>
