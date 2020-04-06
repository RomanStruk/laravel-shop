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
        <div class="card">
            <div class="card-header">
                <h3 class="card-title"></h3>

                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip"
                            title="Collapse">
                        <i class="fas fa-minus"></i></button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip"
                            title="Remove">
                        <i class="fas fa-times"></i></button>
                </div>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.product.store') }}" method="post" class="needs-validation"  enctype="multipart/form-data" novalidate>
                    @csrf


                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label" for="product-name">Назва товару</label>
                        <div class="col-sm-10">
                            <input name="title" id="product-name" value="{{old('title')}}" class="form-control">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label" for="product-alias">Alias</label>
                        <div class="col-sm-10">
                            <input name="alias" id="product-alias" value="{{old('alias')}}" class="form-control">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label" for="product-category">Категорія</label>
                        <div class="col-sm-10">
                            <select name="category_id" id="product-category"  class="form-control">
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}"
                                    @if($category->id == old('category_id')) selected @endif
                                >{{ $category->name }}</option>
                            @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label" for="product-keywords">Ключові Слова</label>
                        <div class="col-sm-10">
                            <input name="keywords" id="product-keywords" value="{{old('keywords')}}" class="form-control">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label" for="product-description">Короткий опис</label>
                        <div class="col-sm-10">
                            <input name="description" id="product-description" value="{{old('description')}}" class="form-control" type="text" max="255">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label" for="product-content">Детальний опис</label>
                        <div class="col-sm-10">
                            <textarea name="content" id="product-content" class="form-control" type="text">{{old('content')}}</textarea>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label" ></label>
                        <div class="col-sm-10">
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
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Опублікувати</label>
                        <div class="col-sm-10">
                            <div class="custom-control custom-switch">
                                <input name="status" type="checkbox" class="custom-control-input" id="customSwitch1" value="1" checked>
                                <label class="custom-control-label" for="customSwitch1">Натісніть для зміни</label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        @foreach($filters as $filter)
                            <label class="col-sm-2 col-form-label" for="input-category">
                                {{$filter->name}}:
                            </label>
                            <div class="col-sm-10">
                                @foreach($filter->allAttributes as $attribute)
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="attributes[{{$filter->id}}]"
                                               id="inlineCheckbox{{$attribute->id}}" value="{{$attribute->id}}">
                                        <label class="form-check-label"
                                               for="inlineCheckbox{{$attribute->id}}">{{$attribute->value}}</label>
                                    </div>
                                @endforeach
                            </div>
                        @endforeach
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Зображення(4)</label>
                        <div class="col-sm-10">
                            <div class="custom-file">
                                <input type="file" name="media[]" class="custom-file-input" id="inputGroupFile01" multiple>
                                <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                            </div>
                        </div>
                    </div>

                <input type="submit" name="save" value="Save" class="btn btn-primary">
                </form>
            </div>
        </div>
    </section>
@endsection
