@extends('admin.layouts.app')

@section('content')
    <h2>Додати медіа файл</h2>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('admin.media.index')}}">Домашня</a></li>
            <li class="breadcrumb-item active" aria-current="page">Додати</li>
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
    <form action="{{ route('admin.media.store') }}" method="post" class="needs-validation"  enctype="multipart/form-data" novalidate>
        @csrf
        <div class="form-group row">
            <label class="col-sm-2 col-form-label" for="title">Назва</label>
            <div class="col-sm-10">
                <input name="name" id="title" value="{{old('name')}}" class="form-control">
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-form-label" for="keywords">Ключові слова</label>
            <div class="col-sm-10">
                <input name="keywords" id="keywords" value="{{old('keywords')}}" class="form-control">
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-form-label" for="description">Опис</label>
            <div class="col-sm-10">
                <input name="description" id="description" value="{{old('description')}}" class="form-control">
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-form-label">Зображення</label>
            <div class="col-sm-10">
                <div class="custom-file">
                    <input type="file" name="media[]" class="custom-file-input" id="media" multiple>
                    <label class="custom-file-label" for="media">Choose file</label>
                </div>
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-form-label" for="product">Прикріпити до товару</label>
            <div class="col-sm-10">
                <select name="products" id="product" class="form-control">
                    <option value="">-- Не вибрано товару --</option>
                    @foreach($products as $product)
                        <option value="{{$product->id}}">{{$product->title}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-form-label" for="disc">Диск</label>
            <div class="col-sm-10">
                <select name="disc" id="disc" class="form-control">
                    <option value="public" selected>Для всіх</option>
{{--                    <option value="local">Локально</option>--}}
                </select>
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-form-label" for="visibility">Видимість</label>
            <div class="col-sm-10">
                <select name="visibility" id="visibility" class="form-control">
                    <option value="public" selected>Публічно</option>
                    <option value="private">Приватно</option>
                </select>
            </div>
        </div>
        <input type="submit" name="save" value="Save" class="btn btn-primary">
</form>
@endsection
