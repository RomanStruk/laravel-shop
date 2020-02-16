@extends('layouts.body')

@section('content')
    <!-- Breadcrumb Start -->
    @component('components.breadcrumb-area')
        @slot('shop') Shop @endslot
    @endcomponent
    <!-- Breadcrumb End -->

    <!-- Shop Page Start -->
    <shop-component></shop-component>{{--TODO Shop Component VUE--}}
    <!-- Shop Page End -->

    <!-- Brand Logo Start -->
    @brands
    <!-- Brand Logo End -->

@endsection
