@extends('layouts.app')

@section('content')

<div class="splash-page">
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-md-6">
				<div class="text-center">
				<img class="mr-0" src="{{ asset('assets/images/coffee-vector-min.webp') }}" alt="Coffee vector">
					<div class="logo">
                        <span class="mi">Mi</span>
                        <span class="cro">cro</span>
                        <span class="blog">blog</span>
                    </div>
					<p class="splash-text my-4">
						Discover the Microverse: A Journey of Refined Imagination. <br>
						Join us in this sophisticated, subtle adventure, where every word whispers elegance <br>
						and every story resonates with depth.
					</p>
					<a href="{{ route('login') }}" class="button button-primary">
						{{ __('Get Started') }}
					</a>
				</div>
			</div>
		</div>
	</div>
</div>

@endsection
