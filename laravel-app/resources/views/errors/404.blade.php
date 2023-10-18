@extends('layouts.app')

@section('content')

<div class="error-page">
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-auto text-center">
				<img class="" src="{{ asset('assets/images/coffee-vector-min.webp') }}" alt="Coffee vector">
				<p class="title fw-bold">Error 404</p>
				<p class="splash-text my-4">
					Not found. We can't find the page you're looking for.
				</p>
				<a href="{{ route('home') }}" class="button button-primary">
					{{ __('Return home') }}
				</a>
			</div>
		</div>
	</div>
</div>

@endsection
