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
    <!-- Main content -->
    <section class="content">
        @include('admin.component.events')
        @include('admin.component.sort', [
        'route' => route('admin.product.index'),
        'status' => \App\Product::listStatus(),
        'category' => $categories,
        'dateAdded' => true,
        'search' => true,
        'trashed' => true,
        'limit' => true
        ])
        <div class="card card-solid">
            <div class="card-body p-0">
                <table class="table table-striped projects">
                    <thead>
                    <tr>
                        <td class="text-right col-1"><a class="desc">#</a></td>
                        <td class="text-left col-4"><a href="">Назва</a></td>
                        <td class="text-left col-3">Категорія</td>
                        <td class="text-left col-1">Ціна</td>
                        <td class="text-left col-1">К-сть</td>
                        <td class="text-center col-2">Дія</td>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($products as $product)
                        <tr>
                            <td class="text-right">{{ $product->id }}</td>
                            <td class="text-left">{{ $product->title }}</td>
                            <td class="text-left">{{ $product->category->name }}</td>
                            <td class="text-left">{{ $product->price }} {{ config('shop.currency_short') }}</td>
                            <td class="text-left">{{ $product->in_stock }}</td>
                            <td class="project-actions text-right">
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
            </div>
        </div>
    </section>
@endsection
