<!-- Comment Form -->
@if ($post->isContentAvailableFor($authUser))
	<div class="container">
		<div class="row g-2">
			<div class="col-auto">
				<x-profile-component :authUser="$authUser" />
			</div>
			<div class="col">
				<a class="text-dark" href="{{ route('profile.show', $authUser->id) }}">
					<div class="name my-2">
						{{ $authUser->full_name }}
					</div>
				</a>
				<div class="row justify-content-center">
					<div class="col">
						<form action="{{ route('comments.store', $post) }}" method="POST">
							@csrf
		
							<textarea id="comment" name="comment" class="form-control comment" rows="1" placeholder="Add a comment"></textarea>
		
							@error('comment')
								<span class="text-danger" role="alert">
									<i>{{ $message }}</i>
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
			</div>
		</div>
		<x-comment :comments="$post->comment" :post="$post" />
	</div>
@endif
