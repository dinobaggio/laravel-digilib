<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>@yield('title')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="{{ URL::asset('css/paginator.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('css/homemade.css') }}">
</head>
<body>
    <div>
        <button onclick="halaman('{{ route('admin.homepage') }}')">Home</button>
        <button onclick="halaman('{{ route('admin.list_file') }}')">List File</button>
        <button onclick="halaman('{{ route('admin.form_upload') }}')" >Upload</button>
        <button onclick="event.preventDefault();document.getElementById('logout-form').submit()" >Logout</button>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
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