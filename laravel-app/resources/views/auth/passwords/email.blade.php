@extends('layouts.app')

@section('content')
<div class="forgot-page">
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-md-3">
				<div class="text-center">
					<a href="{{ route('login') }}">
						<div class="logo-mini">
							<span class="mi">Mi</span>
							<span class="cro">cro</span>
							<span class="blog">blog</span>
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
						<form method="POST" action="{{ route('password.email') }}">
							@csrf

							<div class="row justify-content-center mb-3">
								<div class="col-md">
									<input id="email" type="text" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" placeholder="Email*">

									@if ($errors->has('email'))
										<span class="invalid-feedback">
											<strong>{{ $errors->first('email') }}</strong>
										</span>
									@endif
								</div>
							</div>

							<div class="row justify-content-center mb-4">
								<p class="text-center">Please enter your registered email.</p>
							</div>

							<div class="row p-2 mb-0 mt-3">
								<div class="col-md text-center">
									<button type="submit" class="button button-primary">
										{{ __('Send reset link') }}
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
