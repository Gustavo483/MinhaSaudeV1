<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>@yield('title')</title>
        <link href="{{asset('css/style.css')}}" rel="stylesheet">
        <script src="{{asset('js/script.js')}}"></script>
    </head>
    <body>
        <div>
            @yield('content')
        </div>
    </body>
</html>
