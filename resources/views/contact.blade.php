@extends('layouts.body')

@section('content')
    <!-- Breadcrumb Start -->
    @component('components.breadcrumb-area')
        @slot('contact') Shop @endslot
    @endcomponent
<!-- Breadcrumb End -->
<!-- Google Map Start -->

<!-- Google Map End -->
<!-- Contact Email Area Start -->
<div class="contact-email-area ptb-60">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <h3>Contact Us</h3>
                <p class="text-capitalize mb-40">Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form id="contact-form" class="contact-form" action="{{ url('/contact') }}" method="post">
                    @csrf
                    <div class="address-wrapper">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="address-fname">
                                    <input type="text" name="name" placeholder="Name" value="{{ old('name') }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="address-email">
                                    <input type="email" name="email" placeholder="Email" value="{{ old('email') }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="address-web">
                                    <input type="text" name="website" placeholder="Website" value="{{ old('website') }}">
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="address-subject">
                                    <input type="text" name="subject" placeholder="Subject" value="{{ old('subject') }}">
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="address-textarea">
                                    <textarea name="message" placeholder="Write your message">{{ old('message') }}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <p class="form-message ml-15"></p>
                    <div class="col-xs-12 footer-content mail-content">
                        <div class="send-email">
                            <input type="submit" value="Submit" class="submit">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Contact Email Area End -->
    <!-- Brand Logo Start -->
    @brands
    <!-- Brand Logo End -->
@endsection
