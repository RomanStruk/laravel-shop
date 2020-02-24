<!doctype html>
<html class="no-js" lang="en-US">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <meta name="description" content="Default Description">
    <meta name="keywords" content="E-commerce" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- place favicon.ico in the root directory -->
    <link rel="shortcut icon" type="image/x-icon" href="/img/icon/favicon.png">
    <!-- Google Font css -->
    <link href="https://fonts.googleapis.com/css?family=Lily+Script+One" rel="stylesheet">




    <!-- mobile menu css -->
    <link rel="stylesheet" href="/css/meanmenu.min.css">
    <!-- animate css -->
    <link rel="stylesheet" href="/css/animate.css">
    <!-- nivo slider css -->
    <link rel="stylesheet" href="/css/nivo-slider.css">
    <!-- owl carousel css -->
    <link rel="stylesheet" href="/css/owl.carousel.min.css">
    <!-- slick css -->
    <link rel="stylesheet" href="/css/slick.css">
    <!-- price slider css -->
    <link rel="stylesheet" href="/css/jquery-ui.min.css">
    <!-- fontawesome css -->
    <link rel="stylesheet" href="/css/font-awesome.min.css">
    <!-- fancybox css -->
    <link rel="stylesheet" href="/css/jquery.fancybox.css">
    <!-- bootstrap css -->
    <!-- default css  -->
    <link rel="stylesheet" href="/css/default.css">
    <!-- style css -->
    <link rel="stylesheet" href="/style.css">
    <!-- responsive css -->
    <link rel="stylesheet" href="/css/responsive.css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">


    <!-- modernizr js -->
    <script src="/js/vendor/modernizr-2.8.3.min.js"></script>
</head>

<body>
<!--[if lt IE 8]>
<p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
<![endif]-->
<!-- Wrapper Start -->
<div class="wrapper homepage" id="app">

    <!-- Newsletter Popup Start -->
    <!--<div class="popup_wrapper">
        <div class="test">
            <span class="popup_off">Close</span>
            <div class="subscribe_area text-center mt-60">
                <h2>Newsletter</h2>
                <p>Subscribe to the Jantrik mailing list to receive updates on new arrivals, special offers and other discount information.</p>
                <div class="subscribe-form-group">
                    <form action="#">
                        <input autocomplete="off" type="text" name="message" id="message" placeholder="Enter your email address">
                        <button type="submit">subscribe</button>
                    </form>
                </div>
                <div class="subscribe-bottom mt-15">
                    <input type="checkbox" id="newsletter-permission">
                    <label for="newsletter-permission">Don't show this popup again</label>
                </div>
            </div>
        </div>
    </div>-->
    <!-- Newsletter Popup End -->

    <!-- Header Area Start -->
    @include('layouts.header')
    <div>
        @yield('content')
    </div>
    <!-- Header Area End -->

    <!-- Footer Start -->
    @include('layouts.footer')
    <!-- Footer End -->
</div>
<script src="{{ mix('js/manifest.js')}}"></script>
<script src="{{ mix('js/vendor.js')}}"></script>
<script src="{{ asset('js/app.js') }}"></script>
<!-- Wrapper End -->
<!-- jquery 3.12.4 -->
<!-- mobile menu js  -->
<script src="/js/jquery.meanmenu.min.js"></script>
<!-- scroll-up js -->
<script src="/js/jquery.scrollUp.js"></script>
<!-- owl-carousel js -->
<script src="/js/owl.carousel.min.js"></script>
<!-- slick js -->
<script src="/js/slick.min.js"></script>
<!-- wow js -->
<script src="/js/wow.min.js"></script>
<!-- price slider js -->
<script src="/js/jquery-ui.min.js"></script>
<script src="/js/jquery.countdown.min.js"></script>
<!-- nivo slider js -->
<script src="/js/jquery.nivo.slider.js"></script>
<!-- fancybox js -->
<!-- bootstrap -->
<!-- popper -->
<!-- plugins -->
<!-- main js -->
<script src="/js/main.js"></script>

</body>

</html>
