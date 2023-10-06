<nav class="navbar navbar-expand-lg navbar-light bg-light p-3 shadow-sm">
    <div class="container">
        <a class="navbar-brand d-flex align-items-center" href="{{ route('home') }}">
            <img class="mr-0" src="{{ asset('assets/images/microblog-logo-iconx50.png') }}" alt="Microblog Logo">
            <h4 class="m-0">icroblog</h4>
        </a>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('home') }}">Home</a>
                </li>
                @auth
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('profile.show', auth()->id()) }}">
                        Profile
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('logout') }}"
                    onclick="event.preventDefault();
                                     document.getElementById('logout-form').submit();">
                        Logout
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </li>
                @endauth
            </ul>
        </div>
        <form class="d-flex" role="search" action="{{ route('search') }}" method="GET">
            <input class="form-control me-2" type="search" name="query" placeholder="Search user" aria-label="Search user">
            <button class="btn btn-outline-dark" type="submit">Search</button>
        </form>
    </div>
</nav>
