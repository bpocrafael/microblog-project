@extends('layouts.app')

@section('content')

@include('partials._header')

<div id="page-content">
	<div class="container mt-5">
		<div class="row text-center">
			<div class="col">
			@if ($authUser->recommended_users->count())
				<h5>People you may know</h5>
			@endif
			@foreach ($authUser->recommended_users as $recommend)
				<x-user-component :user="$recommend" />
			@endforeach

			{{ $authUser->recommended_users->appends(['query' => request('query')])->withPath(Request::url())->links() }}
			</div>
		</div>
	</div>
</div>

@include('partials._footer')

@endsection
