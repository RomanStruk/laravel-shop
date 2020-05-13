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
        <form action="{{ route('admin.product.store') }}" method="post" class="needs-validation"
              enctype="multipart/form-data" novalidate>

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
                                <select name="category_id" id="product-category" class="form-control">
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}"
                                                @if($category->id == old('category_id')) selected @endif
                                        >{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>


                            <div class="form-group ">
                                <label for="input-new-price">Ціна</label>
                                <div class="input-group">
                                    <input id="input-new-price" name="price" type="text"
                                           class="form-control"
                                           aria-label="Dollar amount (with dot and two decimal places)">
                                    <div class="input-group-append">
                                        <span class="input-group-text">{{config('shop.currency_short')}}</span>
                                        <span class="input-group-text">0.00</span>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="custom-control custom-switch">
                                    <input name="status" type="checkbox" class="custom-control-input" id="customSwitch1"
                                           value="1" checked>
                                    <label class="custom-control-label" for="customSwitch1">Опублікувати</label>
                                </div>
                            </div>


                        </div>
                    </div>

                    {{-- card Склад--}}
                    @include('admin.product.cards.syllables')

                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Детальніше</h3>
                        </div>
                        <div class="card-body">

                            <div class="form-group">
                                <label for="product-keywords">Ключові Слова</label>
                                <input name="keywords" id="product-keywords" value="{{old('keywords')}}"
                                       class="form-control">
                            </div>

                            <div class="form-group">
                                <label for="product-description">Короткий опис</label>
                                <input name="description" id="product-description" value="{{old('description')}}"
                                       class="form-control" type="text" max="255">
                            </div>

                            <div class="form-group">
                                <label for="input-content">Детальний опис</label>
                                <textarea name="content" id="input-content" class="form-control"
                                          type="text">{{old('content')}}</textarea>
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
                                               href="#" role="button" id="dropdownMenu{{$filter->id}}"
                                               data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                {{$filter->name}}
                                            </a>
                                            <div class="dropdown-menu">
                                                @foreach($filter->allAttributes as $attribute)
                                                    <div class="dropdown-item">
                                                        <div class="form-check row">
                                                            <input class="form-check-input" type="radio"
                                                                   name="attributes[{{$filter->id}}]"
                                                                   id="inlineCheckbox{{$attribute->id}}"
                                                                   value="{{$attribute->id}}"
                                                                   @if(in_array($attribute->id, old('attributes', []))) checked @endif
                                                            >
                                                            <label class="form-check-label col-12"
                                                                   for="inlineCheckbox{{$attribute->id}}">{{$attribute->value}}</label>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                                <div class="col-auto p-1">
                                    <button class="btn btn-danger" title="Reset Filters" type="reset"
                                            id="reset_filters"><i class="fa fa-recycle"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-sm-12">
                    <div class="text-right">
                        <button type="submit" name="save" class="btn btn-primary">Save</button>
                    </div>
                </div>
            </div>
        </form>
    </section>
@endsection
