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
                            <div class="row">

                                @foreach($groups as $filter)
                                    <div class="col-auto p-1">
                                        <div class="dropdown">
                                            <a class="btn dropdown-toggle
                                            @if(count($filter->filterValues->pluck('id')->intersect($product->product_attributes->pluck('id'))))
                                                    btn-primary @else
                                                    btn-secondary @endif"
                                               href="#" role="button" id="dropdownMenu{{$filter->id}}" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                {{$filter->name}}
                                            </a>
                                            <div class="dropdown-menu">
                                                @foreach($filter->allAttributes as $attribute)
                                                    <div class="dropdown-item" >
                                                        <div class="form-check row">
                                                            <input class="form-check-input" type="radio" name="attributes[{{$filter->id}}]"
                                                                   id="inlineCheckbox{{$attribute->id}}" value="{{$attribute->id}}"
                                                                   @if(in_array($attribute->id, $product->product_attributes->pluck('id')->toArray())) checked @endif
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
                                    <button class="btn btn-danger" title="Reset Filters" type="reset" id="reset_filters"><i class="fa fa-recycle"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Файли</h3>
                        </div>
                        <div class="card-body">
                            <script type="application/javascript">
                                var old_media = {!! json_encode($product->media->pluck('id')) !!};
                            </script>
                            <upload-images></upload-images>
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
