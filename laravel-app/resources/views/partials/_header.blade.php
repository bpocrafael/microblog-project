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
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="text-dark" href="{{ route('profile.show', auth()->id()) }}">
                        @if ($authUser->image_path === "assets/images/user-solid.svg")
                            <div class="profile-button" id="profileButtonContainer1">
                                <div class="bg">
                                    <div class="letter">
                                        {{ substr($post->user->full_name, 0, 1) }}
                                    </div>
                                </div>
                            </div>
                        @else
                            <button class="custom-profile-button" id="profileButtonContainer1">
                                <div class="image-bg">
                                    <img src="{{ asset($authUser->image_path) }}" alt="Profile Image">
                                </div>
                            </button>
                        @endif
                    </a>
                </li>
            </ul>
            @endauth
        </div>
    </div>
</nav>
