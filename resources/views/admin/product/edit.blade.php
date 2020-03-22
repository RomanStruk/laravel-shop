@extends('admin.layouts.app')

@section('content')
    <h1>Редагування товару #{{$product->id}}</h1>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('admin.product.index')}}">Домашня</a></li>
            <li class="breadcrumb-item active" aria-current="page">Редагування товару</li>

        </ol>
    </nav>
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
    <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" id="profile-tab" data-toggle="tab" href="#main" role="tab"
               aria-controls="home" aria-selected="true">
                Основне
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="price-tab" data-toggle="tab" href="#price" role="tab" aria-controls="profile"
               aria-selected="false">
                Ціни
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="products-tab" data-toggle="tab" href="#attributes" role="tab"
               aria-controls="profile"
               aria-selected="false">
                Фільтри
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="products-tab" data-toggle="tab" href="#media" role="tab"
               aria-controls="profile"
               aria-selected="false">
                Медіа файли
            </a>
        </li>
    </ul>
    <form action="{{route('admin.product.update', ['product' => $product->id])}}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PATCH')
        <input type="hidden" name="q" value="1">
        <div class="tab-content p-3 border-left border-right border-bottom mb-2" id="myTabContent">
            <div class="tab-pane fade show active" id="main" role="tabpanel" aria-labelledby="home-tab">
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label" for="title">Заголовок</label>
                    <div class="col-sm-10">
                        <input name="title" id="title" value="{{$product->title}}"
                               class="form-control">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label" for="alias">Аліас</label>
                    <div class="col-sm-10">
                        <input name="alias" id="alias" value="{{$product->alias}}"
                               class="form-control">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label" for="last-name">Категорія</label>
                    <div class="col-sm-10">
                        <select id="input-category" class="form-control" name="category_id">
                            @foreach($categories as $category)
                                <option value="{{$category->id}}" selected="selected">{{$category->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-2 ">
                        Статус
                    </div>
                    <div class="col-sm-10">
                        <label class="col-form-label">Видимий
                            <input type="radio" name="status" class="radio-inline" value="1"
                            @if($product->status == '1') checked @endif
                            >
                        </label>
                        <label class="col-form-label">Скритий
                            <input type="radio" name="status" class="radio-inline" value="0"
                                   @if($product->status == '0') checked @endif
                            >
                        </label>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label" for="input-keywords">Ключові слова</label>
                    <div class="col-sm-10">
                        <input name="keywords" id="input-keywords" class="form-control" value="{{$product->keywords}}">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label" for="input-description">Короткий опис</label>
                    <div class="col-sm-10">
                        <textarea name="description" id="input-description"
                                  class="form-control">{{$product->description}}</textarea>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label" for="input-content">Опис</label>
                    <div class="col-sm-10">
                        <textarea name="content" id="input-content"
                                  class="form-control">{{$product->content}}</textarea>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="price" role="tabpanel" aria-labelledby="profile-tab">
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label" for="input-new-price">
                        Ціна
                    </label>
                    <div class="col-sm-10">
                        <div class="input-group">
                            <input id="input-new-price" name="price" type="text" value="{{$product->price}}"
                                   class="form-control" aria-label="Dollar amount (with dot and two decimal places)">
                            <div class="input-group-append">
                                <span class="input-group-text">$</span>
                                <span class="input-group-text">0.00</span>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label" for="input-in-stock">
                        Кількість товарів
                    </label>
                    <div class="col-sm-10">
                        <input id="input-in-stock" name="in_stock" type="number" value="{{$product->in_stock}}"
                               class="form-control">
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="attributes" role="tabpanel" aria-labelledby="profile-tab">
                <div class="form-group row">
                    @foreach($groups as $attributes)
                        <label class="col-sm-2 col-form-label" for="input-category">
                            {{$attributes->name}}:
                        </label>
                        <div class="col-sm-10">
                            @foreach($attributes->allAttributes as $attribute)
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" name="attributes[]"
                                           id="inlineCheckbox{{$attribute->id}}" value="{{$attribute->id}}"
                                        @if($product->product_attributes->firstWhere('id', '=', $attribute->id))
                                            checked
                                            @endif
                                    >
                                    <label class="form-check-label"
                                           for="inlineCheckbox{{$attribute->id}}">{{$attribute->value}}</label>
                                </div>
                            @endforeach
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="tab-pane fade" id="media" role="tabpanel" aria-labelledby="profile-tab">
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label" for="input-in-stock">
                        Завантажити
                    </label>
                    <div class="col-sm-10">
                        <div class="custom-file">
                            <input type="file" name="media[]" class="custom-file-input" id="inputGroupFile01" multiple>
                            <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                        </div>
                    </div>
                </div>
                <table class="table table-bordered table-hover">
                    <thead>
                    <tr>
                        <td class="text-right col-1">
                            <input type="checkbox" onclick="$('input[name*=\'files\']').prop('checked', this.checked);">
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
                                <img src="{{$file->url}}" alt="{{$file->name}}" class="card-img-top">
                            </td>
                            <td class="text-left">{{ $file->name }}</td>
                        </tr>
                    @endforeach

                    </tbody>
                </table>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label" for="input-in-stock">
                        З вибраними
                    </label>
                    <div class="col-sm-10">
                        <select name="action" class="form-control">
                            <option value="0">Нічого не робити</option>
                            <option value="1">Видалити</option>
                        </select>
                    </div>
                </div>

{{--                <div class="form-group row">--}}
{{--                    @foreach($product->media as $file)--}}
{{--                        <div class="card" style="width: 18rem;">--}}
{{--                            <img src="{{$file->url}}" alt="{{$file->name}}" class="card-img-top">--}}
{{--                            <div class="card-body">--}}
{{--                                <p class="card-text">{{$file->name}}</p>--}}
{{--                            </div>--}}
{{--                        </div>--}}


{{--                    @endforeach--}}
{{--                </div>--}}
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

@endsection
