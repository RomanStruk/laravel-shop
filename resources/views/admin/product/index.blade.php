@extends('admin.layouts.app')

@section('content')
    @include('admin.component.title_breadcrumbs', [
    'title' => 'Список товарів',
    'breadcrumbs' => [
        'Товари',
    ],
    'actions' => [
        'create' => route('admin.product.create')
]])
    @include('admin.component.sort', [
    'route' => route('admin.product.index'),
    'status' => [1 => 'Активні', 0 => 'Скриті'],
    'category' => $categories,
    'dateAdded' => true,
    'search' => true,
    'trashed' => true,
    'limit' => true
    ])
    @include('admin.component.events')

    <table class="table table-bordered table-hover">
        <thead>
        <tr>
            <td class="text-right col-1"><a class="desc">ID</a></td>
            <td class="text-left col-5"><a href="">Назва</a></td>
            <td class="text-left col-3">Категорія</td>
            <td class="text-left col-2">Ціна</td>
            <td class="text-left col-2">К-сть</td>
            <td class="text-center col-1">Дія</td>
        </tr>
        </thead>
        <tbody>
        @forelse($products as $product)
            <tr>
                <td class="text-right">{{ $product->id }}</td>
                <td class="text-left">{{ $product->title }}</td>
                <td class="text-left">{{ $product->category->name }}</td>
                <td class="text-left">{{ $product->price }}</td>
                <td class="text-left">{{ $product->in_stock }}</td>
                <td class="text-right">
                    @include('admin.component.dropdown_menu', [
                        'show' => route( 'admin.product.show', ['product' => $product->id]),
                        'edit' => route( 'admin.product.edit', ['product' => $product->id]),
                        'delete' => route( 'admin.product.destroy', ['product' => $product->id]),

                    ])
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="5">Нема товарів по заданому фільтру</td>
            </tr>
        @endforelse
        </tbody>
    </table>
    {{ $products->links() }}
@endsection
