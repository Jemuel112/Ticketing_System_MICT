<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('/plugins/fontawesome-pro/css/all.min.css') }}">

</head>
<body  class="hold-transition sidebar-mini layout-fixed layout-footer-fixed">
<noscript><strong>We're sorry but this app doesn't work properly without JavaScript enabled. Please enable it to continue.</strong></noscript>
<div id="app">
</div>
<!-- built files will be auto injected here -->
</body>
</html>
