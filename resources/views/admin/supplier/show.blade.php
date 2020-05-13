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
                    @forelse($supplier->products as $product)
                        <li>
                            <div class="row">
                                <div class="col-5"><a href="{{route('admin.product.show', $product)}}">{{$product->title}}</a></div>
                                <div class="col-1"><span class="badge badge-primary">{{$product->pivot->imported}}</span></div>
                                <div class="col-1"><span class="badge badge-success">{{$product->pivot->remains}}</span></div>
                                <div class="col-1"><span class="badge badge-info">{{$product->pivot->processed}}</span></div>
                            </div>
                        </li>
                    @empty
                    @endforelse
                </ul>
                <span class="badge badge-primary">Доставлено</span>
                <span class="badge badge-success">Залишається</span>
                <span class="badge badge-info">Обробляється</span>
            </div>
        </div>
    </section>
@endsection
