<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    @include('layouts.head')
</head>
<body>
    <div id="app" class="">
        <main>
            @yield('content')
        </main>
    </div>
    @include('layouts.scripts')
</body>
</html>
