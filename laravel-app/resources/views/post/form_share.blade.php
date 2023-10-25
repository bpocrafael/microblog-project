<form method="POST" action="{{ route('share', $post->id)}}" enctype="multipart/form-data">
	@csrf
	
	<div class="form-group my-3">
		<textarea id="content" name="content" class="form-control" rows="2" placeholder="Enter caption..." autofocus></textarea>
	</div>

	@error('content')
	<span class="text-danger" role="alert">
		<i>{{ $message }}</i>
	</span>
	@enderror

	<div class="text-end">
		<a href="{{ route('home') }}" class="button button-secondary me-3"> {{ __('Cancel') }} </a>
		<button type="submit" class="button button-primary">
			<span class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span>
			Share
		</button>
	</div>
</form>
