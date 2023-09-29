@extends('layouts.app')

@section('content')

@include('partials._header')
<div id="page-content">
	<div class="p-3">
		<div class="row justify-content-center">
			<div class="col-4 p-5 bg-light">
				@include('profile.form')
			</div>
		</div>
	</div>
</div>

@include('partials._footer')

@endsection
