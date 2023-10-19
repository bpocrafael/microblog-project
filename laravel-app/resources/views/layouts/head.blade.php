<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<!-- CSRF Token -->
<meta name="csrf-token" content="{{ csrf_token() }}">

<title>{{ config('app.name', 'Laravel') }}</title>

<!-- Link to favicon -->
<link rel="icon" href="{{ asset('assets/images/microblog-logo-iconx30.png') }}" type="image/x-icon">

<!-- Fonts -->
<link rel="dns-prefetch" href="//fonts.bunny.net">
<link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

<!-- Link to Compiled CSS -->
<link rel="stylesheet" href="{{ asset('assets/css/app.css') }}" />

<!-- Links to Fonts -->
<link rel="stylesheet"
      href="https://fonts.googleapis.com/css2?family=Ubuntu:wght@700&display=swap"
/>
<link rel="stylesheet"
      href="https://fonts.googleapis.com/css2?family=Open Sans:wght@400;600&display=swap"
/>

<!-- Link to fontawesome icons -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" />

<!-- Include Compiled JavaScript -->
<script type="module" src="{{ asset('assets/js/app.js') }}"></script>

<!-- Link to Bootstrap CSS via CDN -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
