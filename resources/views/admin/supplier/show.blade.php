@extends('admin.layouts.app')

@section('content')
    @include('admin.component.title_breadcrumbs', [
    'title' => 'Перегляд постачальника #'.$supplier->id,
    'breadcrumbs' => [
        'Постачальники' => route('admin.supplier.index'),
        'Перегляд',
    ],
    'actions' => [
        'edit' => route('admin.supplier.edit', $supplier),
        'delete' => route('admin.supplier.destroy', $supplier)
]])
    <!-- Main content -->
    <section class="content">
        @include('admin.component.events')
        <div class="card card-solid">
            <div class="card-body">
                <p><b>Назва:</b> {{$supplier->name}}</p>
                <p><b>Опис:</b> {{$supplier->description}}</p>
                <b>Товари на складі:</b>
                <ul>
                    @forelse($supplier->syllable as $syllable)
                        <li>
                            <div class="row">
                                <div class="col-5"><a href="{{route('admin.product.show', $syllable->product)}}">{{$syllable->product->title}}</a></div>
                                <div class="col-1"><span class="badge badge-primary">{{$syllable->imported}}</span></div>
                                <div class="col-1"><span class="badge badge-success">{{$syllable->remains}}</span></div>
                                <div class="col-1"><span class="badge badge-info">{{$syllable->countProcessed()}}</span></div>
                            </div>
                        </li>
                    @empty
                    @endforelse
                </ul>
                <span class="badge badge-primary">@lang('shop.imported')</span>
                <span class="badge badge-success">@lang('shop.remains')</span>
                <span class="badge badge-info">@lang('shop.processed')</span>
            </div>
        </div>
    </section>
@endsection
