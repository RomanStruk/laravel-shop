<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">


    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="{{ asset('adm/css/app.css') }}" rel="stylesheet">

</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

    <!-- Navbar -->
    @include('admin.layouts.nav-bar')
    <!-- /.navbar -->
    <!-- Main Sidebar Container -->
    @include('admin.layouts.main-sidebar')

    <!-- Content Wrapper. Contains page content -->
    <div id="app" class="content-wrapper">
        @yield('content')

    </div>
    <!-- /.content-wrapper -->

    @include('admin.layouts.footer')

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->
<!-- Ionicons -->
<link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
<!-- Scripts -->
<script src="{{ mix('adm/js/app.js')}}"></script>

<script>
    $.widget.bridge('uibutton', $.ui.button)
</script>
</body>
</html>
