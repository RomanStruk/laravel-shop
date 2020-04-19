@extends('admin.layouts.app')
@section('script')
    <script src="{{ mix('adm/js/product.js')}}"></script>
@endsection
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
                    <div class="card card-primary">
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
                    <div class="card card-primary">
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
                    <div class="card card-secondary">
                        <div class="card-header">
                            <h3 class="card-title">Пов'язані товари</h3>
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
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Зображення</h3>
                        </div>
                        <div class="card-body">
                            <script type="application/javascript">
                                var old_media = {!! json_encode(old('media', [])) !!};
                            </script>
                            <upload-images></upload-images>
                        </div>
                    </div>
                    <div class="card card-info">
                        <div class="card-header">
                            <h3 class="card-title">Фільтри</h3>
                        </div>
                        <div class="card-body">
                            <div class="row">

                                @foreach($filters as $filter)
                                <div class="col-auto p-1">
                                    <div class="dropdown">
                                        <a class="btn dropdown-toggle
                                            @if(count($filter->filterValues->pluck('id')->intersect(old('attributes', []))))
                                                btn-primary
                                            @else
                                                btn-secondary
                                            @endif"
                                           href="#" role="button" id="dropdownMenu{{$filter->id}}" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            {{$filter->name}}
                                        </a>
                                        <div class="dropdown-menu">
                                            @foreach($filter->allAttributes as $attribute)
                                            <div class="dropdown-item" >
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="attributes[{{$filter->id}}]"
                                                           id="inlineCheckbox{{$attribute->id}}" value="{{$attribute->id}}"
                                                           @if(in_array($attribute->id, old('attributes', []))) checked @endif
                                                    >
                                                    <label class="form-check-label"
                                                           for="inlineCheckbox{{$attribute->id}}">{{$attribute->value}}</label>
                                                </div>
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
