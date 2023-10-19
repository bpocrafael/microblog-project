@php
    $authUser = auth()->user();
@endphp

<nav class="navbar navbar-expand-lg background-light navbar-custom">
    <div class="container">
        <a class="navbar-brand" href="{{ route('home') }}">
            <div class="logo-mini">
                <span class="mi">Mi</span>
                <span class="cro">cro</span>
                <span class="blog">blog</span>
            </div>
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <form class="mx-auto" role="search" action="{{ route('search') }}" method="GET">
                <div class="input-group">
                    <input class="form-control text-center" type="search" name="query" placeholder="Search" aria-label="Search user">
                </div>
            </form>
            @auth
            <ul class="navbar-nav">
                <li class="nav-item">
                    <x-profile-component :authUser="auth()->user()" />
                </li>
            </ul>
            @endauth
        </div>
    </div>
</nav>
