<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>@yield('title')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="{{ URL::asset('css/paginator.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('css/homemade.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('static/css/fontawesome-all.css') }}">
</head>
<body>
    <div>
        @yield('nav_bar')
    </div>

    <div>
        <h1>@yield('title')</h1>
        <hr/>
    </div>

    @yield('content')


    <script>
        function halaman (url) {
            window.open(url, '_self');
        }
    </script>
</body>
</html>