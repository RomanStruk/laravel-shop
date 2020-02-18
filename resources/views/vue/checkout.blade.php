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
<!-- coupon-area start -->
<div class="coupon-area">
    <div class="container">
        <!-- Section Title Start -->
        <div class="section-title mb-20">
            <h2>Оформлення замовлення</h2>
        </div>
        <!-- Section Title Start End -->
        <div class="row">
            <div class="col-lg-12">
                <div class="coupon-accordion">
                    <!-- ACCORDION START -->
                    <h3>Returning customer? <span id="showlogin">Click here to login</span></h3>
                    <div id="checkout-login" class="coupon-content">
                        <div class="coupon-info">
                            <p class="coupon-text">Quisque gravida turpis sit amet nulla posuere lacinia. Cras sed est sit amet ipsum luctus.</p>
                            <form action="#">
                                <p class="form-row-first">
                                    <label>Username or email <span class="required">*</span></label>
                                    <input type="text" />
                                </p>
                                <p class="form-row-last">
                                    <label>Password  <span class="required">*</span></label>
                                    <input type="text" />
                                </p>
                                <p class="form-row">
                                    <input type="submit" value="Login" />
                                    <label>
                                        <input type="checkbox" />
                                        Remember me
                                    </label>
                                </p>
                                <p class="lost-password">
                                    <a href="#">Lost your password?</a>
                                </p>
                            </form>
                        </div>
                    </div>
                    <!-- ACCORDION END -->
                    <!-- ACCORDION START -->
                    <h3>Have a coupon? <span id="showcoupon">Click here to enter your code</span></h3>
                    <div id="checkout_coupon" class="coupon-checkout-content">
                        <div class="coupon-info">
                            <form action="#">
                                <p class="checkout-coupon">
                                    <input type="text" class="code" placeholder="Coupon code" />
                                    <input type="submit" value="Apply Coupon" />
                                </p>
                            </form>
                        </div>
                    </div>
                    <!-- ACCORDION END -->
                </div>
            </div>
        </div>
    </div>
</div>
<!-- coupon-area end -->

<!-- checkout-area start -->
<div class="checkout-area pt-30  pb-60">
    <div class="container">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form action="{{ route('checkout') }}" method="post">
            @csrf
            <div class="row">
                <div class="col-lg-6 col-md-6">
                    <div class="checkbox-form">
                        <h3>Контактні дані</h3>
                        <div class="row">

                            <div class="col-md-12">
                                <div class="checkout-form-list">
                                    <label>Ім'я та прізвище <span class="required">*</span>
                                    <input  name="name" type="text" placeholder=""  value="{{ old('name') }}"/>
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="checkout-form-list">
                                    <label>Місто <span class="required">*</span>
                                        <input  name="city_code" type="text" placeholder=""  value="{{ old('city_code') }}"/>
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="checkout-form-list">
                                    <label>Ел. пошта<span class="required">*</span>
                                    <input name="email" type="email" placeholder=""  value="{{ old('email') }}"/></label>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="checkout-form-list mb-30">
                                    <label>Мобільний телефон  <span class="required">*</span>
                                    <input name="phone" type="text" placeholder=""  value="{{ old('phone') }}"/></label>
                                </div>
                            </div>
                        </div>
                        <div class="different-address">
                            <div class="ship-different-title">
                                <h3>Вибір способів доставки й оплати
                                </h3>
                            </div>
                            <div>
                                <div class="row">
                                    <div class="col-md-46">
                                        Доставка в Бровари
                                    </div>
                                    <div class="col-md-4"></div>
                                    <div class="col-md-4">
                                        Змінити місто
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4"></div>
                                    <div class="col-md-4">
                                        <label><input type="radio" name="type_delivery" value="ours"> з наших магазинів</label>
                                    </div>
                                    <div class="col-md-4">безкоштовно</div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4"></div>
                                    <div class="col-md-4">
                                        <label><input type="radio" name="type_delivery" value="Courier"> Кур'єр на вашу адресу</label>
                                    </div>
                                    <div class="col-md-4">59 грн</div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4"></div>
                                    <div class="col-md-4">
                                        <label><input type="radio" name="type_delivery" value="Pickup"> Самовивіз з Нової Пошти</label>
                                        <div>
                                            Виберіть відповідне відділення: <input type="text" value="">
                                        </div>
                                    </div>
                                    <div class="col-md-4">60 грн</div>
                                </div>
                            </div>
                            <div>
                                <div class="row">
                                    <hr>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        Оплата
                                    </div>
                                    <div class="col-md-8"></div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4"></div>
                                    <div class="col-md-8">
                                        <label><input type="radio" name="pay_method" value="on_place"> Оплата при отриманні замовлення</label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4"></div>
                                    <div class="col-md-8">
                                        <label><input type="radio" name="pay_method" value="google_pay"> Google Pay </label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4"></div>
                                    <div class="col-md-8">
                                        <label><input type="radio" name="pay_method" value="credit_card"> Оплатити зараз карткою Visa/Mastercard </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <your-order-component></your-order-component>
                </div>
            </div>
        </form>
    </div>
</div>
<!-- checkout-area end -->
@endsection
