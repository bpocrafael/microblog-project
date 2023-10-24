@if ($authUser->id)
	<a class="text-dark" href="{{ route('profile.show', $authUser->id) }}">
		@if ($authUser->image_path === "assets/images/user-solid.svg")
			<div class="profile-button" id="profileButtonContainer1">
				<div class="bg">
					<div class="letter">
						{{ ucfirst(substr($authUser->full_name, 0, 1)) }}
					</div>
				</div>
			</div>
		@else
			<button class="custom-profile-button" id="profileButtonContainer1">
				<div class="image-bg">
					<img src="{{ asset($authUser->image_path) }}" alt="Profile Image">
				</div>
			</button>
		@endif
	</a>
@else
	<a class="text-dark" href="{{ route('profile.show', $post->user->id) }}">
		@if ($post->user->image_path === "assets/images/user-solid.svg")
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