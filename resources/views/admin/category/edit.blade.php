@extends('admin.layouts.app')

@section('content')
    @include('admin.component.title_breadcrumbs', [
    'title' => 'Редагування категорії',
    'breadcrumbs' => [
        'Категорії' => route('admin.category.index'),
        'Редагувати',
    ],
    'actions' => [
        'delete' => route('admin.category.destroy',['category' => $category->id])
]])
    @include('admin.component.events')

        <form action="{{ route('admin.category.update', ['category' => $category->id]) }}" method="post">
            @csrf
            @method('PATCH')
            @include('admin.category._form')

        </form>
@endsection
