@extends('admin.layouts.app')

@section('content')
    <!-- Content Header (Page header) -->
    @include('admin.component.title_breadcrumbs', [
        'title' => 'Додавання товару',
        'breadcrumbs' => [
            'Товари' => route('admin.product.index'),
            'Додати',
        ]
        ])
    <!-- /.content-header -->
    <!-- Main content -->
    <section class="content">
        @include('admin.component.events')
        <form action="{{ route('admin.product.store') }}" method="post" class="needs-validation"  enctype="multipart/form-data" novalidate>

            @csrf
            <div class="row">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Загальне</h3>
                        </div>
                        <div class="card-body">
                                <div class="form-group">
                                    <label for="product-name">Назва товару</label>
                                        <input name="title" id="product-name" value="{{old('title')}}" class="form-control">
                                </div>

                                <div class="form-group ">
                                    <label for="product-alias">Alias</label>
                                    <input name="alias" id="product-alias" value="{{old('alias')}}" class="form-control">
                                </div>

                                <div class="form-group">
                                    <label for="product-category">Категорія</label>
                                        <select name="category_id" id="product-category"  class="form-control">
                                        @foreach($categories as $category)
                                            <option value="{{ $category->id }}"
                                                @if($category->id == old('category_id')) selected @endif
                                            >{{ $category->name }}</option>
                                        @endforeach
                                        </select>
                                </div>

                                <div class="form-group">
                                    <label for="product-keywords">Ключові Слова</label>
                                    <input name="keywords" id="product-keywords" value="{{old('keywords')}}" class="form-control">
                                </div>

                                <div class="form-group">
                                    <label for="product-description">Короткий опис</label>
                                    <input name="description" id="product-description" value="{{old('description')}}" class="form-control" type="text" max="255">
                                </div>

                                <div class="form-group">
                                    <label for="product-content">Детальний опис</label>
                                        <textarea name="content" id="product-content" class="form-control" type="text">{{old('content')}}</textarea>
                                </div>


                                <div class="form-group">
                                        <div class="custom-control custom-switch">
                                            <input name="status" type="checkbox" class="custom-control-input" id="customSwitch1" value="1" checked>
                                            <label class="custom-control-label" for="customSwitch1">Опублікувати</label>
                                        </div>
                                </div>


                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Ціни</h3>
                        </div>
                        <div class="card-body">
                            <div class="form-row">
                                <div class="col-md-4 mb-3">
                                    <label for="product-price">Ціна товару</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="inputGroupPrepend">$</span>
                                        </div>
                                        <input name="price" type="text" class="form-control" id="product-price" value="{{old('price')}}" aria-describedby="inputGroupPrepend" required>
                                        <div class="invalid-feedback">
                                            Please choose price.
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="product-in-stock">Кількість</label>
                                    <input name="in_stock" type="number" class="form-control" id="product-in-stock" value="{{old('in_stock')}}" required>
                                    <div class="valid-feedback">
                                        Looks good!
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Related products</h3>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="input-related">Товари</label>
                                <select name="related[]" class="form-control select2" data-dropdown-css-class="select2"
                                        style="width: 100%;" id="input-related" multiple>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Зображення(4)</h3>
                        </div>
                        <div class="card-body">
                            <div class="form-group">

                                <div class="custom-file">
                                    <input type="file" name="media[]" class="custom-file-input" id="inputGroupFile01" multiple>
                                    <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Filters</h3>
                        </div>
                        <div class="card-body">
                            <div id="accordion">
                                <!-- we are adding the .class so bootstrap.js collapse plugin detects it -->

                                @foreach($filters as $filter)
                                    <div class="card card-primary">
                                        <div class="card-header">
                                            <h4 class="card-title">
                                                <a data-toggle="collapse" data-parent="#accordion" href="#collapse{{$filter->id}}" class="collapsed" aria-expanded="false">
                                                    {{$filter->name}}
                                                </a>
                                            </h4>
                                        </div>
                                        <div id="collapse{{$filter->id}}" class="panel-collapse in collapse" style="">
                                            <div class="card-body">
                                                @foreach($filter->allAttributes as $attribute)
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="attributes[{{$filter->id}}]"
                                                               id="inlineCheckbox{{$attribute->id}}" value="{{$attribute->id}}">
                                                        <label class="form-check-label"
                                                               for="inlineCheckbox{{$attribute->id}}">{{$attribute->value}}</label>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        <input type="submit" name="save" value="Save" class="btn btn-primary">
        </form>
    </section>
@endsection
