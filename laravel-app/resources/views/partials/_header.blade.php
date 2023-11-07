@php
    $authUser = auth()->user();
@endphp

<nav id="header" class="navbar navbar-expand-lg background-light navbar-custom py-4" data-auth="{{ $authUser->id }}">
    <div class="container">
        <a class="navbar-brand" href="{{ route('home') }}">
            <div id="logo-mini">
                <span id="mi">Mi</span>
                <span id="cro">cro</span>
                <span id="blog">blog</span>
            </div>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNav" aria-controls="offcanvasNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="offcanvas offcanvas-end" tabindex="" id="offcanvasNav" aria-labelledby="offcanvasNavLabel">
            <div class="offcanvas-header background-light">
                <!-- <h5 class="" id="navbarOffcanvasLabel">Menu</h5> -->
                <button type="button" class="btn-close ms-auto" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body background-light">
                <form class="mx-auto my-auto" role="search" action="{{ route('search') }}" method="GET">
                    <div class="input-group">
                        <input class="form-control text-center" id="query" type="search" name="query" placeholder="Search" aria-label="Search user">
                        <label for="query" class="tan-label ms-1"><i class="fa-solid fa-magnifying-glass fa-xs pt-3"></i></label>
                    </div>
                </form>
                <ul class="navbar-nav d-flex justify-content-center">
                    <li class="nav-item">
                        <a type="button" class="button button-light m-3" href="{{ route('home') }}">
                            <span id="home-label" class="peru-label">Home</span>
                            <i class="fa-solid fa-house fa-sm peru-label"></i>
                        </a>
                    </li>
                    <li class="nav-item">
                        <div class="btn-group m-3">
                            <button id="notif-bell"
                                type="button" 
                                class="button button-light position-relative" 
                                data-bs-toggle="dropdown" 
                                data-count="{{ $authUser->unreadNotifications()->count() }}"
                                aria-expanded="false"
                            >
                                <span id="notif-label" class="peru-label">Notifications</span>
                                <i class="fa-regular fa-bell fa-lg peru-label"></i>
                                <span id="notif-dot" class="position-absolute top-70 start-70 translate-middle p-1 bg-danger rounded-circle d-none">
                                    <span class="visually-hidden">New notifications</span>
                                </span>
                                <i class="fa-solid fa-caret-down fa-2xs ms-2 peru-label"></i>
                            </button>
                            <ul id="notification-tab" class="dropdown-menu dropdown-menu-end">
                                @csrf
                                <li id="notif-title" class="p-1 px-3">
                                    <label class="fw-bold text-share">Notifications</label>
                                    <a id="mark-all" class="link-text ms-3" data-url="{{ route('notifications.markAllAsRead') }}">
                                        mark all as read
                                    </a>
                                </li>
                                <li><hr id="dropdown-divider" class="dropdown-divider"></li>
                                @foreach ($authUser->notifications as $notification)
                                <li class="notif-list-item {{ $notification->read() ? 'read' : 'unread' }}">
                                    <a class="dropdown-item p-3 px-4" href="{{ route('notifications.markAsRead', $notification->id) }}">
                                        <h6 class="text-identifier d-flex">{{$notification->data['message']}}</h6>
                                        <i class="date">{{ $notification->created_at->format('m/d/y  h:i a') }}</i>
                                    </a>
                                </li>
                                @endforeach
                                <li class="read">
                                    <a class="dropdown-item text-center p-1 px-4">
                                        <i class="date">~ end ~</i>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li class="nav-item">
                        <span class="mx-3">
                            <x-profile-component :user="auth()->user()" />
                        </span>
                    </li>
                    <li id="logout-nav-item" class="nav-item">
                        <a type="button" class="button button-light m-3 ms-0" data-bs-toggle="modal" data-bs-target="#logoutModal">
                            <span id="logout-label" class="peru-label">Logout</span>
                            <i class="fa-solid fa-arrow-right-from-bracket fa-sm peru-label"></i>
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
                    
                </ul>
            </div>
        </div>
    </div>
</nav>
