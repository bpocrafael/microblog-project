<nav class="navbar navbar-expand-lg p-3 background-light shadow-sm navbar-custom">
    <div class="container light-bg">
        <a class="navbar-brand d-flex align-items-center" href="{{ route('home') }}">
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
            <ul class="navbar-nav">
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
            <button class="btn" type="submit">Search</button>
        </form>
    </div>
</nav>
