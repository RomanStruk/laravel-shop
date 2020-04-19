@extends('admin.layouts.app')

@section('script')
    <script src="{{ mix('adm/js/product.js')}}"></script>
@endsection

@section('content')

    @include('admin.component.title_breadcrumbs', [
    'title' => 'Редагування товару #' .$product->id,
    'breadcrumbs' => [
        'Товари' => route('admin.product.index'),
        'Перегляд' => route('admin.product.show',['product' => $product->id]),
        'Редагувати',
    ],
    'actions' => [
        'delete' => route('admin.product.destroy',['product' => $product->id])
    ]])

    <!-- Main content -->
    <section class="content">
        @include('admin.component.events')
        <form action="{{route('admin.product.update', ['product' => $product->id])}}" method="post"
              enctype="multipart/form-data">
            @csrf
            @method('PATCH')
            <input type="hidden" name="q" value="1">
            <div class="row">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Основне</h3>
                        </div>
                        <div class="card-body">
                            <div class="form-group ">
                                <label for="title">Заголовок</label>
                                <input name="title" id="title" value="{{$product->title}}" class="form-control">
                            </div>
                            <div class="form-group ">
                                <label for="alias">Аліас</label>
                                <input name="alias" id="alias" value="{{$product->alias}}" class="form-control">
                            </div>
                            <div class="form-group ">
                                <label for="input-category">Категорія</label>
                                <select id="input-category" class="form-control" name="category_id">
                                    @foreach($categories as $category)
                                        <option value="{{$category->id}}"
                                                selected="selected">{{$category->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group ">
                                <label>Видимий
                                    <input type="radio" name="status" class="radio-inline" value="1"
                                           @if($product->status == '1') checked @endif
                                    >
                                </label>
                                <label>Скритий
                                    <input type="radio" name="status" class="radio-inline" value="0"
                                           @if($product->status == '0') checked @endif
                                    >
                                </label>
                            </div>
                            <div class="form-group ">
                                <label for="input-keywords">Ключові слова</label>
                                <input name="keywords" id="input-keywords" class="form-control"
                                       value="{{$product->keywords}}">
                            </div>
                            <div class="form-group ">
                                <label for="input-description">Короткий опис</label>
                                <textarea name="description" id="input-description"
                                          class="form-control">{{$product->description}}</textarea>
                            </div>
                            <div class="form-group ">
                                <label for="input-content">Опис</label>
                                <textarea name="content" id="input-content"
                                          class="form-control">{{$product->content}}</textarea>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Ціни</h3>
                        </div>
                        <div class="card-body">
                            <div class="form-group ">
                                <label for="input-new-price">Ціна</label>
                                    <div class="input-group">
                                        <input id="input-new-price" name="price" type="text" value="{{$product->price}}"
                                               class="form-control"
                                               aria-label="Dollar amount (with dot and two decimal places)">
                                        <div class="input-group-append">
                                            <span class="input-group-text">{{config('shop.currency_short')}}</span>
                                            <span class="input-group-text">0.00</span>
                                        </div>
                                    </div>
                            </div>
                            <div class="form-group ">
                                <label for="input-in-stock">Кількість товарів</label>
                                    <input id="input-in-stock" name="in_stock" type="number" value="{{$product->in_stock}}" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Related products</h3>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="input-related">Товари</label>
                                <select name="related[]" class="form-control select2" data-dropdown-css-class="select2"
                                        style="width: 100%;" id="input-related" multiple>
                                    @foreach($product->related as $related)
                                        <option value="{{$related->id}}" selected>{{$related->title}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    {{--end col-md-6--}}
                </div>

                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Filters</h3>
                        </div>
                        <div class="card-body">
                            <div id="accordion">
                                <!-- we are adding the .class so bootstrap.js collapse plugin detects it -->

                                @foreach($groups as $attributes)
                                    <div class="card card-primary">
                                        <div class="card-header">
                                            <h4 class="card-title">
                                                <a data-toggle="collapse" data-parent="#accordion"
                                                   href="#collapse{{$attributes->id}}" class="collapsed"
                                                   aria-expanded="false">
                                                    {{$attributes->name}}
                                                </a>
                                            </h4>
                                        </div>
                                        <div id="collapse{{$attributes->id}}" class="panel-collapse in collapse
                                        @if($product->product_attributes->firstWhere('filter_id', '=', $attributes->id))
                                            show
@endif" style="">
                                            <div class="card-body">
                                                @foreach($attributes->allAttributes as $attribute)
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio"
                                                               name="attributes[{{$attributes->id}}]"
                                                               id="inlineCheckbox{{$attribute->id}}"
                                                               value="{{$attribute->id}}"
                                                               @if($product->product_attributes->firstWhere('id', '=', $attribute->id))
                                                               checked
                                                            @endif
                                                        >
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
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Файли</h3>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="input-in-stock">Завантажити</label>
                                    <div class="custom-file">
                                        <input type="file" name="media[]" class="custom-file-input"
                                               id="inputGroupFile01" multiple>
                                        <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                                    </div>
                            </div>
                            <table class="table table-bordered table-hover">
                                <thead>
                                <tr>
                                    <td class="text-right col-1">
                                        <input type="checkbox"
                                               onclick="$('input[name*=\'files\']').prop('checked', this.checked);">
                                    </td>
                                    <td class="text-left col-3">Зображення</td>
                                    <td class="text-left col-5">Назва</td>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($product->media as $file)
                                    <tr>
                                        <td class="text-right">
                                            <input type="checkbox" name="files[]" value="{{ $file->id }}">
                                        </td>
                                        <td class="text-left">
                                            <img src="{{$file->url}}" alt="{{$file->name}}" class="card-img-top" style="height: 60px; width: auto">
                                        </td>
                                        <td class="text-left">{{ $file->name }}</td>
                                    </tr>
                                @endforeach

                                </tbody>
                            </table>
                            <div class="form-group">
                                <label for="action-media">З вибраними</label>
                                    <select name="action" class="form-control" id="action-media">
                                        <option value="0">Нічого не робити</option>
                                        <option value="1">Видалити</option>
                                    </select>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="form-group row">
                <div class="col-sm-12">
                    <div class="text-right">
                        <button type="submit" class="btn btn-primary">
                            Save
                        </button>
                    </div>

                </div>
            </div>
        </form>
    </section>
@endsection
