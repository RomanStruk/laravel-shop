@extends('admin.layouts.app')

@section('content')
    @include('admin.component.title_breadcrumbs', [
    'title' => 'Додати категорію',
    'breadcrumbs' => [
        'Категорії' => route('admin.category.index'),
        'Додати',
    ]])
    @include('admin.component.events')

        <form action="{{ route('admin.category.store') }}" method="post">
            @csrf

            @include('admin.category._form')
        </form>

@endsection
