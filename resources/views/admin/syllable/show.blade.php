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
                    <div class="row mb-3">
                        <div class="col-4"><b>Товар:</b> <a href="{{route('admin.product.show', $syllable->product)}}">{{$syllable->product->title}}</a></div>
                        <div class="col-1"><span class="badge badge-primary">{{$syllable->imported}}</span></div>
                        <div class="col-1"><span class="badge badge-success">{{$syllable->remains}}</span></div>
                        <div class="col-1"><span class="badge badge-info">{{$syllable->countProcessed}}</span></div>
                    </div>
                <p><b>Постачальник:</b> {{$syllable->supplier->name}}</p>
                <p><b>Опис:</b> {{$syllable->description}}</p>
                <b>Замовлення:</b>
                <ul>
                     <li>Нема даних</li>
                </ul>
                <span class="badge badge-primary">@lang('shop.imported')</span>
                <span class="badge badge-success">@lang('shop.remains')</span>
                <span class="badge badge-info">@lang('shop.processed')</span>
            </div>
        </div>
    </section>
@endsection
