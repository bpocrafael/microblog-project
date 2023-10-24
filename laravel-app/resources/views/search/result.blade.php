@if ($searchResult instanceof App\Models\User)
<div class="row justify-content-center">
	<div class="col-md-7">
		<div class="card post-card m-2">
			<a class="text-dark" href="{{ route('profile.show', $searchResult->id) }}">
				<div class="card-body">
					<div class="row justify-content-between">
						<div class="col-auto text-start">
							<img src="{{ asset('assets/images/microblog-logo-iconx30.png') }}" alt="Image">
							<label class="name">
								{{ $searchResult->full_name }}
								@if ($searchResult->id === $authUser->id)
									<i class="text-identifier">(you)</i>
								@endif
							</label>
						</div>
						<div class="col-auto">
							@php
								$authUser = auth()->user();
							@endphp

							@if($authUser->isNot($searchResult))
								<div class="col-auto">
									@if($authUser->isFollowing($searchResult))
										<form method="POST" action="{{ route('follow.destroy', $searchResult->id) }}">
											@csrf
											@method('DELETE')
											<button class="button button-light" type="submit">
												<i class="fa-solid fa-circle-check"></i>
												Following
											</button>
										</form>
										@else
										<form method="POST" action="{{ route('follow.update', $searchResult->id) }}">
											@csrf
											@method('PUT')
											<button class="button button-light" type="submit">
												<i class="fa-regular fa-circle-check"></i>
												Follow
											</button>
										</form>
									@endif
								</div>
							@endif
						</div>
					</div>
				</div>
			</a>
		</div>
	</div>
</div>
@else
	<div class="container">
		<x-post-component :post=$searchResult :user="auth()->user()" />
	</div>
@endif
