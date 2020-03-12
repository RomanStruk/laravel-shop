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

                </div>
            </div>
        </div>
        <div id="filter-order" class="col-md-3 col-md-push-9 col-sm-12 hidden-sm hidden-xs">
            <form method="GET" action="{{route('admin.product.index')}}">
                <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title"><i class="fa fa-filter"></i> Filter</h3>
                </div>
                <div class="panel-body">
                    <div class="form-group">
                        <label class="control-label" for="input-product-id">Product ID</label>
                        <input type="text" name="filter_product_id" value="" placeholder="Order ID" id="input-product-id"
                               class="form-control">
                    </div>
                    <div class="form-group">
                        <label class="control-label" for="input-product-category">Order Category</label>
                        <select id="input-product-category" name="category" class="form-control">
                            <option value="">-- Категорія не вибрана --</option>
                            @php $delimiter = ''; @endphp
                            @include('admin.category._categories')
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="control-label" for="input-product-status">Order Status</label>
                        <select name="status" id="input-product-status" class="form-control">
                            <option value="">Всі</option>
                            <option value="0">Скриті</option>
                            <option value="1">Активні</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="control-label" for="input-date-added">Date Added</label>
                        <div class="input-group date">
                            <input type="date" name="filter_date_added" value="" placeholder="Date Added"
                                   data-date-format="YYYY-MM-DD" id="input-date-added" class="form-control">
                            </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label" for="input-date-modified">Date Modified</label>
                        <div class="input-group date">
                            <input type="date" name="filter_date_modified" value="" placeholder="Date Modified"
                                   data-date-format="YYYY-MM-DD" id="input-date-modified" class="form-control">
                            </div>
                    </div>
                    <div class="form-group text-right">
                        <button type="submit" id="button-filter" class="btn btn-default"><i class="fa fa-filter"></i>
                            Filter
                        </button>
                    </div>
                </div>
            </div>
            </form>
        </div>
    </div>
@endsection
