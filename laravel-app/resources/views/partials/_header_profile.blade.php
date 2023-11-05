<nav id="header" class="navbar navbar-expand-lg p-3 background-light navbar-custom" data-auth="{{ auth()->user()->id }}">
    <div class="container light-bg">
        <a class="navbar-brand d-flex align-items-center" href="{{ route('home') }}">
            <div id="logo-mini">
                <span id="mi">Mi</span>
                <span id="cro">cro</span>
                <span id="blog">blog</span>
            </div>
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="#navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                @auth
                <li class="nav-item">
                    <a class="text-share text-share-link" href="{{ route('logout') }}"
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
    </div>
</nav>
