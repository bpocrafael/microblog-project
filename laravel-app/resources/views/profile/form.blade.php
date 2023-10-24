<form method="POST" action="{{ route('profile.update', $user->id) }}">
	@csrf
	@method('PUT')
	
	<div class="row justify-content-center my-3">
		<div class="col-md">
			<div class="text-label">First Name*</div>
			<input id="first_name" type="text" class="form-control @error('first_name') is-invalid @enderror" name="first_name" value="{{ $user->information->first_name }}" autocomplete="first_name" placeholder="First name">

			@error('first_name')
				<span class="invalid-feedback" role="alert">
					<i>{{ $message }}</i>
				</span>
			@enderror
		</div>
		<div class="col-md">
			<div class="text-label">Middle Name</div>
			<input id="middle_name" type="text" class="form-control @error('middle_name') is-invalid @enderror" name="middle_name" value="{{ $user->information->middle_name }}" autocomplete="middle_name" placeholder="Middle name">

			@error('middle_name')
				<span class="invalid-feedback" role="alert">
					<i>{{ $message }}</i>
				</span>
			@enderror
		</div>
		<div class="col-md">
			<div class="text-label">Last Name*</div>
			<input id="last_name" type="text" class="form-control @error('last_name') is-invalid @enderror" name="last_name" value="{{ $user->information->last_name }}" autocomplete="last_name" placeholder="Last name">

			@error('last_name')
				<span class="invalid-feedback" role="alert">
					<i>{{ $message }}</i>
				</span>
			@enderror
		</div>
	</div>

	<div class="row justify-content-center mb-1 mb-3">
		<div class="col-md">
			<div class="text-label">Username</div>
			<input id="username" type="text" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ $user->username }}" autocomplete="username" placeholder="Username">

			@error('username')
				<span class="invalid-feedback" role="alert">
					<i>{{ $message }}</i>
				</span>
			@enderror
		</div>
	</div>

	<div class="row justify-content-center mb-1 mb-3">
		<div class="col-md">
			<div class="text-label">Email</div>
			<input id="email" type="text" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $user->email }}" autocomplete="email" placeholder="Email">

			@error('email')
				<span class="invalid-feedback" role="alert">
					<i>{{ $message }}</i>
				</span>
			@enderror
		</div>
	</div>

	<div class="row justify-content-center mb-1 mb-3">
		<div class="col-md">
			<div class="text-label">Bio</div>
			<input id="bio" type="text" class="form-control @error('bio') is-invalid @enderror" name="bio" value="{{ $user->information->bio }}" autocomplete="bio" placeholder="Bio">

			@error('bio')
				<span class="invalid-feedback" role="alert">
					<i>{{ $message }}</i>
				</span>
			@enderror
		</div>
	</div>

	<div class="row justify-content-center mb-1 mb-3">
		<div class="col-md">
			<div class="text-label">Gender</div>
			<select id="gender" class="form-select @error('gender') is-invalid @enderror" name="gender" autocomplete="gender">
				<option value="" disabled>Select gender</option>
				<option value="male" {{ old('gender', $user->information->gender) === 'male' ? 'selected' : '' }}>Male</option>
				<option value="female" {{ old('gender', $user->information->gender) === 'female' ? 'selected' : '' }}>Female</option>
				<option value="other" {{ old('gender', $user->information->gender) === 'other' ? 'selected' : '' }}>Other</option>
			</select>
			@error('gender')
				<span class="invalid-feedback" role="alert">
					<i>{{ $message }}</i>
				</span>
			@enderror
		</div>
	</div>

	<div class="row p-2 justify-content-end">
		<div class="col-auto">
			<a href="{{ route('profile.show', $user->id) }}" class="button button-secondary me-3"> {{ __('Cancel') }} </a>
			<button type="submit" class="button button-primary">
				{{ __('Update') }}
			</button>
		</div>
	</div>
</form>
