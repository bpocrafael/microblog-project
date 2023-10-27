@if ($searchResult instanceof App\Models\User)
<div class="row justify-content-center">
	<div class="col-md-7">
		<div class="card m-2">
			<div class="card-body">
				<div class="row justify-content-between align-items-center">
					<div class="col-auto">
						<div class="row align-items-center">
							<div class="col-auto">
								<x-profile-component :authUser="$searchResult" />
							</div>
							<div class="col-auto">
								<label class="name">
									<a class="text-dark" href="{{ route('profile.show', $searchResult->id) }}">
										{{ $searchResult->full_name }}
										@if ($searchResult->id === $authUser->id)
											<i class="text-identifier">(you)</i>
										@endif
									</a>
								</label>
							</div>
						</div>
					</div>
					<div class="col-auto">
						@php
							$authUser = auth()->user();
						@endphp

						@if($authUser->isNot($searchResult))
							<div class="col-auto">
								<x-follow-button :user="$searchResult" />
							</div>
						@endif
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@else
	<div class="container">
		<x-post-component :post=$searchResult :user="auth()->user()" />
	</div>
@endif
