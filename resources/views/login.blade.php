@extends('layouts.body')

@section('content')
    <div class="card">
        <div class="card-header">{{ __('Login') }}</div>

        <div class="card-body">
            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="form-group row">
                    <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                    <div class="col-md-6">
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                        @error('email')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                    <div class="col-md-6">
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                        @error('password')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-md-6 offset-md-4">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                            <label class="form-check-label" for="remember">
                                {{ __('Remember Me') }}
                            </label>
                        </div>
                    </div>
                </div>

                <div class="form-group row mb-0">
                    <div class="col-md-8 offset-md-4">
                        <button type="submit" class="btn btn-primary">
                            {{ __('Login') }}
                        </button>

                        @if (Route::has('password.request'))
                            <a class="btn btn-link" href="{{ route('password.request') }}">
                                {{ __('Forgot Your Password?') }}
                            </a>
                        @endif
                    </div>
                </div>
            </form>
        </div>
    </div>
<!-- Breadcrumb Start -->
<div class="breadcrumb-area ptb-60 ptb-sm-30">
    <div class="container">
        <div class="breadcrumb">
            <ul>
                <li><a href="index.html">Home</a></li>
                <li class="active"><a href="login.html">Login</a></li>
            </ul>
        </div>
    </div>
    <!-- Container End -->
</div>
<!-- Breadcrumb End -->
<!-- LogIn Page Start -->
<div class="log-in pb-60">
    <div class="container">
        <div class="row">
            <!-- New Customer Start -->
            <div class="col-sm-6">
                <div class="well">
                    <div class="new-customer">
                        <h3>NEW CUSTOMER</h3>
                        <p class="mtb-10"><strong>Register</strong></p>
                        <p>By creating an account you will be able to shop faster, be up to date on an order's status, and keep track of the orders you have previously made</p>
                        <a class="customer-btn" href="register.html">continue</a>
                    </div>
                </div>
            </div>
            <!-- New Customer End -->
            <!-- Returning Customer Start -->
            <div class="col-sm-6">
                <div class="well">
                    <div class="return-customer">
                        <h3 class="mb-10">RETURNING CUSTOMER</h3>
                        <p class="mb-10"><strong>I am a returning customer</strong></p>
                        <form action="#">
                            <div class="form-group">
                                <label class="control-label">Enter your email address here...</label>
                                <input type="text" name="email" placeholder="Enter your email address here..." id="input-email" class="form-control">
                            </div>
                            <div class="form-group">
                                <label class="control-label">Password</label>
                                <input type="text" name="pass" placeholder="Password" id="input-password" class="form-control">
                            </div>
                            <p class="lost-password"><a href="forgot-password.html">Forgot password?</a></p>
                            <input type="submit" value="Login" class="return-customer-btn">
                        </form>
                    </div>
                </div>
            </div>
            <!-- Returning Customer End -->
        </div>
        <!-- Row End -->
    </div>
    <!-- Container End -->
</div>
<!-- LogIn Page End -->
<!-- Brand Logo Start -->
<div class="brand-area pb-60">
    <div class="container">
        <!-- Brand Banner Start -->
        <div class="brand-banner owl-carousel">
            <div class="single-brand">
                <a href="#"><img class="img" src="img/brand/1.png" alt="brand-image"></a>
            </div>
            <div class="single-brand">
                <a href="#"><img src="img/brand/2.png" alt="brand-image"></a>
            </div>
            <div class="single-brand">
                <a href="#"><img src="img/brand/3.png" alt="brand-image"></a>
            </div>
            <div class="single-brand">
                <a href="#"><img src="img/brand/4.png" alt="brand-image"></a>
            </div>
            <div class="single-brand">
                <a href="#"><img src="img/brand/5.png" alt="brand-image"></a>
            </div>
            <div class="single-brand">
                <a href="#"><img class="img" src="img/brand/1.png" alt="brand-image"></a>
            </div>
            <div class="single-brand">
                <a href="#"><img src="img/brand/2.png" alt="brand-image"></a>
            </div>
            <div class="single-brand">
                <a href="#"><img src="img/brand/3.png" alt="brand-image"></a>
            </div>
            <div class="single-brand">
                <a href="#"><img src="img/brand/4.png" alt="brand-image"></a>
            </div>
            <div class="single-brand">
                <a href="#"><img src="img/brand/5.png" alt="brand-image"></a>
            </div>
        </div>
        <!-- Brand Banner End -->
    </div>
</div>
<!-- Brand Logo End -->
@endsection
