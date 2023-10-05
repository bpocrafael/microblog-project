@extends('layouts.app')

@section('content')

@include('partials._header')

<div id="page-content">
	<div class="container my-3">
		<div class="row justify-content-center text-center">
			<div class="col-md-6">
				<div class="mb-4">
					<h4>Microblog User Results for "{{ $query }}"</h4>
				</div>

				@if ($results->count() > 0)
					@foreach ($results as $result)
						<div class="card">
							<div class="card-body">
								<div class="row">
									<div class="col text-start">
										<a class="text-dark" href="{{ route('profile.show', $result->id) }}">
											<img src="{{ asset('assets/images/microblog-logo-iconx30.png') }}" alt="Image">
											{{ $result->username }} {{$result->id}}
										</a>
									</div>
									<!-- <div class="col-2">
										<a href="#" class="btn btn-dark">Follow</a>
									</div> -->
									<div class="col-3 align-self-center">
										@if(auth()->user()->isNot($result))
											@if(auth()->user()->following->contains($result))
												<form method="POST" action="{{ route('unfollow', $result) }}">
													@csrf
													<button class="btn btn-dark" type="submit">Unfollow</button>
												</form>
											@else
												<form method="POST" action="{{ route('follow', $result) }}">
													@csrf
													<button class="btn btn-dark" type="submit">Follow</button>
												</form>
											@endif
										@endif
									</div>
								</div>
							</div>
						</div>
					@endforeach
				@else
					<div class="row">
						<div class="col">
							<img 
								src="{{ asset('assets/images/empty.png') }}"
								alt="Image"
								class="w-50">
						</div>
					</div>
				@endif
			</div>
		</div>
	</div>
</div>

@include('partials._footer')

@endsection
