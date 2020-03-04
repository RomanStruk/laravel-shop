@extends('admin.layouts.app')

@section('content')
    <h1>Редагування категорії</h1>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/">Домашня</a></li>
            <li class="breadcrumb-item"><a href="{{route('category.show', ['category' => $category->id])}}">Категорія</a></li>
            <li class="breadcrumb-item active" aria-current="page">Редагувати</li>
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

        <form action="{{ route('category.update', ['category' => $category->id]) }}" method="post">
            @csrf
            @method('PATCH')
            @include('admin.category._form')

        </form>
@endsection
