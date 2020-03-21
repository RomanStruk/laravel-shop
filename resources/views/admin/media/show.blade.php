@extends('admin.layouts.app')

@section('content')
    <h2>
        Перегляд медіа файлу #{{$media->id}}
        <a href="{{route('admin.media.edit', ['medium' => $media->id])}}" title="Редагувати">
            <i class="fa fa-edit" aria-hidden="true"></i>
        </a>
    </h2>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('admin.media.index')}}">Домашня</a></li>
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
    <div class="row">
        <div class="col-4">
        <img src="{{$media->url}}" class="img" alt="...">
        </div>
        <div class="col-8">
            <div class="row">
                <h5 class="col-12">{{$media->name}}</h5>

                <div class="col-3">Файл:</div>
                <div class="col-9">
                    <code>{{$media->path}}</code><br>
                    [<code>{{$media->extension}}</code>]
                    [<code>{{$media->size}}</code>]
                </div>
                <div class="col-3">
                    Диск:
                </div>
                <div class="col-9">
                    <code>{{$media->disc}}</code>
                </div>
                <div class="col-3">
                    Видимість:
                </div>
                <div class="col-9">
                    <code>{{$media->visibility}}</code></div>
                <div class="col-3">
                    Публічна адреса:
                </div>
                <div class="col-9">
                    <code>{{$media->url}}</code></div>
                <div class="col-3">
                    Ключові слова:
                </div>
                <div class="col-9">
                    @foreach(explode(',', $media->keywords) as $keyword)
                        <span class="badge badge-primary">#{{ trim($keyword) }}</span>
                    @endforeach
                </div>
                <div class="col-3">
                    Опис:
                </div>
                <div class="col-9">
                    <span>{{$media->description}}</span>
                </div>
                <div class="col-3">
                    Дата завантаження:
                </div>
                <div class="col-9">
                    <code>{{$media->created_at}}</code>
                </div>
                <div class="col-3">
                    Дата редагування:
                </div>
                <div class="col-9">
                    <code>{{$media->updated_at}}</code>
                </div>
            </div>
        </div>
        <div class="col-2">Прикріплений до:</div>
        <div class="col-10">
            @each('admin.media.each.link', $media->products, 'product', 'admin.media.each.empty_products')
        </div>
    </div>
@endsection
