<nav id="header" class="navbar navbar-expand-lg p-3 background-light navbar-custom" data-auth="{{ auth()->user()->id }}">
    <div class="container light-bg">
        <a class="navbar-brand d-flex align-items-center" href="{{ route('home') }}">
            <div id="logo-mini">
                <span id="mi">Mi</span>
                <span id="cro">cro</span>
                <span id="blog">blog</span>
            </div>
        </a>
        
        <!-- Display items on the right end on small screens -->
        <div class="ml-auto">
            <ul class="navbar-nav">
                <div class="row">
                    <div class="col-auto">
                        <li class="nav-item m-3">
                            <a type="button" class="button button-light" href="{{ route('home') }}">
                                Home
                                <i class="fa-solid fa-house fa-sm"></i>
                            </a>
                        </li>
                    </div>
                    <div class="col-auto">
                        <li class="nav-item m-3">
                            <a type="button" class="button button-secondary" data-bs-toggle="modal" data-bs-target="#logoutModal">
                                Logout
                                <i class="fa-solid fa-arrow-right-from-bracket fa-sm"></i>
                            </a>
                            <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="logoutModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content light-card">
                                        <div class="modal-header">
                                            <h6 class="" id="logoutModalLabel">Confirm Logout</h6>
                                            <button type="button" class="button button-secondary" data-bs-dismiss="modal" aria-label="Close">
                                                <i class="fa-solid fa-xmark"></i>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            Are you sure you want to logout?
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="button button-secondary" data-bs-dismiss="modal">Cancel</button>
                                            <form id="logout-form" action="{{ route('logout') }}" method="POST">
                                                @csrf
                                                <button type="submit" class="button button-danger">
                                                    <span class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span>
                                                    Logout
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                    </div>
                </div>
            </ul>
        </div>
    </div>
</nav>
