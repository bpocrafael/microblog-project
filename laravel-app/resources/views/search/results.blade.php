@extends('layouts.app')

@section('content')

@include('partials._header')
<div id="page-content">
    <div class="container my-3">
        <div class="row">
            <div class="col">
                <div class="mb-5 text-center">
                    <h4>Microblog results for "{{ $query }}"</h4>
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
