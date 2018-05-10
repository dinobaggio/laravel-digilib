<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>@yield('title')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="{{ URL::asset('css/homemade.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('static/css/fontawesome-all.css') }}">
    <!-- Bootstrap core CSS -->
    <link href="{{ URL::asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="{{ URL::asset('css/album.css') }}" rel="stylesheet">
</head>
<body class="bg-light">
            @yield('nav_bar')
        
        <main role="main" style="min-height: 650px;">
            <div class="album">
                <div class="container">
                    <div>
                        <h1>@yield('title')</h1>
                        <hr/>
                    </div>

                    @yield('content')
                    
                </div>
            </div>
        </main>


    <script src="{{ URL::asset('js/jquery-3.3.1.slim.min.js') }}"></script>
    <script src="{{ URL::asset('js/vendor/popper.min.js') }}"></script>
    <script src="{{ URL::asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ URL::asset('js/vendor/holder.min.js') }}"></script>
    <script>
        function halaman (url) {
            window.open(url, '_self');
        }
    </script>
</body>
</html>