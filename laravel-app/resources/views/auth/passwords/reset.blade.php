@extends('layouts.app')

@section('content')
<div class="forgot-page">
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-md-3">
				<div class="text-center">
					<a href="{{ route('login') }}">
						<div id="logo-mini">
							<span id="mi">Mi</span>
							<span id="cro">cro</span>
							<span id="blog">blog</span>
						</div>
					</a>
					<b class="title">Reset</b>
				</div>

				@if (session('status'))
					<div class="alert alert-success">
						{{ session('status') }}
					</div>
				@endif
				<div class="my-5">
					<div class="card-body">
						<form method="POST" action="{{ route('password.update') }}">
							@csrf

							<input type="hidden" name="token" value="{{ $token }}">

							<div class="row justify-content-center mb-3">
								<div class="col-md">
									<input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ request('email') ?? old('email') }}">

									@if ($errors->has('email'))
										<span class="invalid-feedback">
											<i>{{ $errors->first('email') }}</i>
										</span>
									@endif
								</div>
							</div>

							<div class="row justify-content-center mb-3">
								<div class="col-md">
									<input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" placeholder="New Pasword" autofocus>

									@if ($errors->has('password'))
										<span class="invalid-feedback">
											<i>{{ $errors->first('password') }}</i>
										</span>
									@endif
								</div>
							</div>

							<div class="row justify-content-center mb-3">
								<div class="col-md">
									<input id="password-confirm" type="password" class="form-control{{ $errors->has('password_confirmation') ? ' is-invalid' : '' }}" name="password_confirmation" placeholder="Confirm Pasword">

									@if ($errors->has('password_confirmation'))
										<span class="invalid-feedback">
											<i>{{ $errors->first('password_confirmation') }}</i>
										</span>
									@endif
								</div>
							</div>

							<div class="row p-2 mb-0 mt-3">
								<div class="col-md text-center">
									<button type="submit" class="button button-primary">
										<span class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span>
										{{ __('Reset Password') }}
									</button>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
