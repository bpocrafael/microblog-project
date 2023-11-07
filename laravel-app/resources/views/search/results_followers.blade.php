@extends('layouts.app')

@section('content')

@include('partials._header')
<div id="page-content">
    <div class="container my-3">
		<div class="row justify-content-center m-3 mb-5">
            <div class="col-md-6">
                <div class="card light-card px-5">
                    <div class="card-body">
                        <form class="mx-auto my-auto" role="search" action="{{ route('search.followers', $user) }}" method="GET">
                            <div class="input-group">
                                <input class="form-control text-center" id="query" type="search" name="query" placeholder="Search Followers and Followings" aria-label="Search user" autocomplete="off">
                                <label for="query" class="tan-label ms-1"><i class="fa-solid fa-magnifying-glass fa-xs pt-3"></i></label>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="mb-5 text-center">
                    <h4>Results of "{{ $query }}" from {{ $user->username }}</h4>
					<span class="text-share">{{ $searchResults->total() ? $searchResults->total(). ' total matched results' : '' }}</span>
                </div>
                @if ($searchResults->count())
                    @foreach ($searchResults as $searchResult)
                        @include('search.result')
                    @endforeach
                    
                    {{ $searchResults->appends(['query' => request('query')])->withPath(Request::url())->links() }}
                @else
                    <div class="row my-5 text-center">
                        <div class="col">
                            <img src="{{ asset('assets/images/coffee-vector-min.webp') }}" alt="Coffee">
                            <div class="my-3">
                                <h5 class="">No results found</h5>
                                <i class="text-share">We could not find users or posts from them with that text :(</i>
                            </div>
                        </div>
                    </div>
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
                @endif
            </div>
        </div>
    </div>
</div>

@include('partials._footer')

@endsection
