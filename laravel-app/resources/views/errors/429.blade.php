@extends('layouts.app')

@section('content')

<div class="error-page">
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-auto text-center">
				<img class="" src="{{ asset('assets/images/coffee-vector-min.webp') }}" alt="Coffee vector">
				<p class="title fw-bold">Error 429</p>
				<p class="splash-text my-4">
					Too many requests. Please try again later.
				</p>
			</div>
		</div>
	</div>
</div>

@endsection
