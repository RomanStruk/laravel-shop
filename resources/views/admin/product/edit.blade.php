@extends('admin.layouts.app')

@section('content')
    <h1>Редагування товару #{{$product->id}}</h1>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/admin">Домашня</a></li>
            <li class="breadcrumb-item active" aria-current="page">Перегляд</li>

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
    </ul>
    <form action="{{route('admin.product.edit', ['product' => $product->id])}}" method="post">
        @csrf
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
                        <select id="input-category" class="form-control" name="category">
                            @foreach($categories as $category)
                                <option value="{{$category->id}}" selected="selected">{{$category->name}}</option>
                            @endforeach
                        </select>
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
                    <label class="col-sm-2 col-form-label" for="input-price">
                        Ціна
                    </label>
                    <div class="col-sm-10">
                        <input id="input-price" name="price" type="number" value="{{$product->old_price}}"
                               class="form-control">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label" for="input-new-price">
                        Нова ціна
                    </label>
                    <div class="col-sm-10">
                        <input id="input-new-price" name="new_price" type="number" value="{{$product->price}}"
                               class="form-control">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label" for="input-in-stock">
                        Кількість товарів
                    </label>
                    <div class="col-sm-10">
                        <input id="input-in-stock" name="new_price" type="number" value="{{$product->in_stock}}"
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
                                    <input class="form-check-input" type="checkbox"
                                           id="inlineCheckbox{{$attribute->id}}" value="option1"
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
