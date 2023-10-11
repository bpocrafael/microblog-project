<form method="POST" action="{{ route('profile.update', $user->id) }}">
	@csrf
	@method('PUT')

	@if (session('success'))
		<div class="alert alert-success">
			{{ session('success') }}
		</div>
	@endif
	
	<div class="row justify-content-center my-3">
		<div class="col-md">
			<label for="first_name">First name</label>
			<input id="first_name" type="text" class="form-control @error('first_name') is-invalid @enderror" name="first_name" value="{{ $user->information->first_name }}" autocomplete="first_name" placeholder="First name" autofocus>

			@error('first_name')
				<span class="invalid-feedback" role="alert">
					<strong>{{ $message }}</strong>
				</span>
			@enderror
		</div>
		<div class="col-md">
			<label for="middle_name">Middle name</label>
			<input id="middle_name" type="text" class="form-control @error('middle_name') is-invalid @enderror" name="middle_name" value="{{ $user->information->middle_name }}" autocomplete="middle_name" placeholder="Middle name" autofocus>

			@error('middle_name')
				<span class="invalid-feedback" role="alert">
					<strong>{{ $message }}</strong>
				</span>
			@enderror
		</div>
		<div class="col-md">
			<label for="last_name">Last name</label>
			<input id="last_name" type="text" class="form-control @error('last_name') is-invalid @enderror" name="last_name" value="{{ $user->information->last_name }}" autocomplete="last_name" placeholder="Last name" autofocus>

			@error('last_name')
				<span class="invalid-feedback" role="alert">
					<strong>{{ $message }}</strong>
				</span>
			@enderror
		</div>
	</div>

	<div class="row justify-content-center mb-1 mb-3">
		<div class="col-md">
			<label for="username">Username</label>
			<input id="username" type="text" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ $user->username }}" autocomplete="username" placeholder="Username" autofocus>

			@error('username')
				<span class="invalid-feedback" role="alert">
					<strong>{{ $message }}</strong>
				</span>
			@enderror
		</div>
	</div>

	<div class="row justify-content-center mb-1 mb-3">
		<div class="col-md">
			<label for="email">Email</label>
			<input id="email" type="text" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $user->email }}" autocomplete="email" placeholder="Email" autofocus>

			@error('email')
				<span class="invalid-feedback" role="alert">
					<strong>{{ $message }}</strong>
				</span>
			@enderror
		</div>
	</div>

	<div class="row justify-content-center mb-1 mb-3">
		<div class="col-md">
			<label for="bio">Bio</label>
			<input id="bio" type="text" class="form-control @error('bio') is-invalid @enderror" name="bio" value="{{ $user->information->bio }}" autocomplete="bio" placeholder="Bio" autofocus>

			@error('bio')
				<span class="invalid-feedback" role="alert">
					<strong>{{ $message }}</strong>
				</span>
			@enderror
		</div>
	</div>

	<div class="row justify-content-center mb-1 mb-3">
		<div class="col-md">
			<label for="gender">Gender</label>
			<select id="gender" class="form-select @error('gender') is-invalid @enderror" name="gender" autocomplete="gender" autofocus>
				<option value="" disabled>Select gender</option>
				<option value="male" {{ old('gender', $user->information->gender) === 'male' ? 'selected' : '' }}>Male</option>
				<option value="female" {{ old('gender', $user->information->gender) === 'female' ? 'selected' : '' }}>Female</option>
				<option value="other" {{ old('gender', $user->information->gender) === 'other' ? 'selected' : '' }}>Other</option>
			</select>
			@error('gender')
				<span class="invalid-feedback" role="alert">
					<strong>{{ $message }}</strong>
				</span>
			@enderror
		</div>
	</div>

	<div class="row p-2 mb-0 mt-3">
		<div class="col-md text-center">
			<a href="{{ route('profile.show', $user->id) }}" class="btn btn-secondary"> {{ __('Cancel') }} </a>
		</div>
		<div class="col-md text-center">
			<button type="submit" class="btn btn-success">
				{{ __('Update') }}
			</button>
		</div>
	</div>

	<div class="row p-2 mb-0 mt-3">
	</div>

</form>
