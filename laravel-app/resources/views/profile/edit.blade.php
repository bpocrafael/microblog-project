@extends('layouts.app')

@section('content')

@include('partials._header')
<div class="bg-light p-5 shadow-sm">
	<div class="row justify-content-center">
		<div class="col-4 pt-1">
			@include('profile.profile-form')
		</div>
	</div>
</div>

@include('partials._footer');

@endsection
