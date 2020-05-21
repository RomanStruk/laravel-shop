@extends('admin.layouts.app')

@section('content')
    @include('admin.component.title_breadcrumbs', [
    'title' => 'Перегляд поставки #'.$syllable->id,
    'breadcrumbs' => [
        'Склад' => route('admin.syllable.index'),
        'Перегляд',
    ],
    'actions' => [
        'edit' => route('admin.syllable.edit', $syllable),
        'delete' => route('admin.syllable.destroy', $syllable)
]])
    <!-- Main content -->
    <section class="content">
        @include('admin.component.events')
        <div class="card card-solid">
            <div class="card-body">
                <p>
                    <b>Товар:</b> <a
                        href="{{route('admin.product.show', $syllable->product)}}">{{$syllable->product->title}}</a>
                    <span class="badge badge-primary">{{$syllable->imported}}</span>
                    <span class="badge badge-success">{{$syllable->remains}}</span>
                    <span class="badge badge-info">{{$syllable->countAvailableRemains}}</span>
                    <span class="badge badge-warning">{{$syllable->countProcessed}}</span>
                </p>
                <p><b>Постачальник:</b> {{$syllable->supplier->name}}</p>
                <p><b>Ціна:</b> {{$syllable->price}}</p>
                <p><b>Опис:</b> {{$syllable->description}}</p>
                <b>Замовлення:</b>
                <p>
                    @forelse($syllable->orders as $order)
                        <a href="{{route('admin.order.show', $order)}}">#{{$order->id}}</a>
                    @empty
                        <span>Нема даних</span>
                    @endforelse
                </p>
                <span class="badge badge-primary">@lang('shop.imported')</span>
                <span class="badge badge-success">@lang('shop.remains')</span>
                <span class="badge badge-info">@lang('shop.available')</span>
                <span class="badge badge-warning">@lang('shop.processed')</span>
            </div>
        </div>
    </section>
@endsection
