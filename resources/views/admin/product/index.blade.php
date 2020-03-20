@extends('admin.layouts.app')

@section('content')
    <h2>
        <i class="fa fa-list"></i> Список товарів
        <a href="{{route('admin.product.create')}}" title="Додати">
            <i class="fa fa-plus-circle" aria-hidden="true"></i>
        </a>
    </h2>
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
    <div class="row">
        <div class="col-md-9 col-md-pull-3 col-sm-12">
            <div class="panel panel-default">
                <div class="panel-body">
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
                        @foreach($products as $product)
                            <tr>
                                <td class="text-right">{{ $product->id }}</td>
                                <td class="text-left">{{ $product->title }}</td>
                                <td class="text-left">{{ $product->category->name }}</td>
                                <td class="text-left">{{ $product->price }}</td>
                                <td class="text-left">{{ $product->in_stock }}</td>
                                <td class="text-right">
                                    <div class="btn-group">
                                        <a
                                            href="{{ route( 'admin.product.show', ['product' => $product->id]) }}"
                                            data-toggle="tooltip" title="" class="btn btn-primary"
                                            data-original-title="View">
                                            <i class="fa fa-eye"></i>
                                        </a>
                                        <button type="button" class="btn btn-primary dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <span class="sr-only">Toggle Dropdown</span>
                                        </button>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item" href="{{route('admin.product.edit', ['product' => $product->id])}}"><i class="fa fa-pencil"></i> Edit</a>
                                            <form method="POST" action="{{route('admin.product.destroy', ['product' => $product->id])}}" >
                                                @csrf
                                                @method('DELETE')
                                                <button class="dropdown-item" value="submit" type="submit"><i class="fa fa-trash-o"></i> Delete</button>
                                            </form>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach

                        </tbody>
                    </table>
                    {{ $products->links() }}
                </div>
            </div>
        </div>
        <div id="filter-order" class="col-md-3 col-md-push-9 col-sm-12 hidden-sm hidden-xs">
            @include('admin.product._filters')
        </div>
    </div>
@endsection
