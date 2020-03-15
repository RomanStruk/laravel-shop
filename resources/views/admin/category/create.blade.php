@extends('admin.layouts.app')

@section('content')
    <h1>Додати категорію</h1>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('admin.category.index')}}">Домашня</a></li>
            <li class="breadcrumb-item active" aria-current="page">Додати</li>
        </ol>
    </nav>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    @if (\Session::has('success'))
        <div class="alert alert-success">
            <ul>
                <li>{!! \Session::get('success') !!}</li>
            </ul>
        </div>
    @endif

        <form action="{{ route('admin.category.store') }}" method="post">
            @csrf

            @include('admin.category._form')

        </form>


@endsection
