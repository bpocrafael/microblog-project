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
        <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNav" aria-labelledby="offcanvasNavLabel">
            <div class="offcanvas-header background-light">
                <h5 class="" id="navbarOffcanvasLabel">Menu</h5>
                <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body background-light">
                <form class="mx-auto my-auto" role="search" action="{{ route('search') }}" method="GET">
                    <div class="input-group">
                        <input class="form-control text-center" id="query" type="search" name="query" placeholder="Search" aria-label="Search user">
                        <label for="query" class="tan-label ms-1"><i class="fa-solid fa-magnifying-glass fa-xs pt-3"></i></label>
                    </div>
                </form>
                <ul class="navbar-nav">
                    <li class="nav-item m-3">
                        <div class="btn-group">
                            <button id="notif-bell"
                                type="button" 
                                class="button button-light position-relative" 
                                data-bs-toggle="dropdown" 
                                data-count="{{ $authUser->unreadNotifications()->count() }}"
                                aria-expanded="false">
                                <i class="fa-regular fa-bell fa-lg peru-label"></i>
                                <span id="notif-dot" class="position-absolute top-70 start-70 translate-middle p-1 bg-danger rounded-circle d-none">
                                    <span class="visually-hidden">New notifications</span>
                                </span>
                                <i class="fa-solid fa-caret-down fa-2xs ms-2 peru-label"></i>
                            </button>
                            <ul id="notification-tab" class="dropdown-menu dropdown-menu-lg-end">
                                @csrf
                                <li id="notif-title" class="p-1 px-3">
                                    <label class="fw-bold text-share">Notifications</label>
                                    <a id="mark-all" class="link-text ps-3 ms-5" data-url="{{ route('notifications.markAllAsRead') }}">
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
                    <li class="nav-item mx-3">
                        <x-profile-component :user="auth()->user()" />
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>
