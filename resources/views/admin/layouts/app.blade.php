<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="{{ asset('adm/css/app.css') }}" rel="stylesheet">
</head>
<body>
<div id="app">
    @include('admin.sidebar.navbartop')
    <div class="container-fluid">
        <div class="row">
            @include('admin.sidebar.navbarleft')
            <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
                <br>
                @yield('content')
            </main>
        </div>
    </div>
</div>
<script src="https://kit.fontawesome.com/1455e3d372.js" crossorigin="anonymous"></script>
</body>
<!-- Scripts -->
<script src="{{ mix('js/manifest.js')}}"></script>
<script src="{{ mix('js/vendor.js')}}"></script>
<script src="{{ mix('adm/js/app.js')}}"></script>

</html>
