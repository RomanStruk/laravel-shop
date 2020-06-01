@extends('layouts.body')

@section('content')
    <!-- Breadcrumb Start -->
    <div class="breadcrumb-area  pt-sm-30 pb-sm-20">
        <div class="container">
            <div class="breadcrumb">
                <ul>
                    <li><a href="index.html">Home</a></li>
                    <li class="active"><a href="/checkout">Оформлення замовлення</a></li>
                </ul>
            </div>
        </div>
        <!-- Container End -->
    </div>
    <!-- Breadcrumb End -->

    <!-- checkout-area start -->
    <div class="checkout-area pt-30  pb-60">
        <div class="container">
            <!-- Section Title Start -->
            <div class="section-title mb-20">
                <h2>Оформлення замовлення</h2>
            </div>


            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form action="{{ route('checkout') }}" method="post" class="form-row">
                @csrf
                <div class="col-lg-6 col-md-6">
                    @auth
                        <check-out-form-main :if_user_auth="true"></check-out-form-main>
                    @endauth

                    @guest
                        <check-out-form-main :if_user_auth="false"></check-out-form-main>
                    @endguest
                </div>
                <div class="col-lg-6 col-md-6">
                    <your-order-component></your-order-component>
                </div>
            </form>
        </div>
    </div>
    <!-- checkout-area end -->
@endsection
