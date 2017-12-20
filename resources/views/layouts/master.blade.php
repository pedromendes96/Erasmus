<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link href="/css/main.css" rel="stylesheet">
    <script src="/js/main.js"></script>
</head>

    <body>
        @include('layouts.nav')
        @yield('content')
        @include('layouts.footer')
    </body>

</html>
