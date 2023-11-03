@extends('layouts.app')

@section('content')

@include('partials._header')

@php
    $authUser = auth()->user();
@endphp

<div id="page-content">
    <div class="container my-3">
        <div class="row">
            <div class="col">
                <div class="mb-5 text-center">
                    <h4>Microblog results for "{{ $query }}"</h4>
                </div>
                
                @foreach ($searchResults as $searchResult)
                    @include('search.result')
                @endforeach
                
                {{ $searchResults->appends(['query' => request('query')])->withPath(Request::url())->links() }}
                
                @if ($searchResults->count() == 0)
                    <div class="row my-5 text-center">
                        <div class="col">
                            <img src="{{ asset('assets/images/coffee-vector-min.webp') }}" alt="Coffee">
                            <div class="my-3">
                                <h5 class="">No results found</h5>
                                <i class="text-share">We could not find users or posts from them with that text :(</i>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

@include('partials._footer')

@endsection
