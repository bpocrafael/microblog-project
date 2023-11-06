@if ($user->id)
	<a class="text-dark" href="{{ route('profile.show', $user->id) }}">
		@if (!$user->image_path)
			<div class="profile-button" id="profileButtonContainer1">
				<div class="bg">
					<div class="letter">
						{{ ucfirst(substr($user->full_name, 0, 1)) }}
					</div>
				</div>
			</div>
		@else
			<button class="custom-profile-button" id="profileButtonContainer1">
				<div class="image-bg">
					<img src="{{ asset($user->image_path) }}" alt="Profile Image">
				</div>
			</button>
		@endif
	</a>
@else
	<a class="text-dark" href="{{ route('profile.show', $post->user->id) }}">
		@if (!$post->user->image_path)
			<div class="profile-button" id="profileButtonContainer1">
				<div class="bg">
					<div class="letter">
						{{ substr($post->user->full_name, 0, 1) }}
					</div>
				</div>
			</div>
		@else
			<button class="custom-profile-button" id="profileButtonContainer1">
				<div class="image-bg">
					<img src="{{ asset($post->user->image_path) }}" alt="Profile Image">
				</div>
			</button>
		@endif
	</a>
@endif
