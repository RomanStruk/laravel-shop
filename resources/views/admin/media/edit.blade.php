@extends('admin.layouts.app')

@section('content')

    @include('admin.component.title_breadcrumbs', [
        'title' => 'Редагувати медіа файл #'.$media->id,
        'breadcrumbs' => [
            'Медіа' => route('admin.media.index'),
            'Перегляд' => route('admin.media.show',['medium' => $media->id]),
            'Редагувати'
        ],
        'actions' => [
            'delete' => route('admin.media.destroy', ['medium' => $media->id])
        ]
    ])

    <!-- Main content -->
    <section class="content">
        @include('admin.component.events')
        <div class="card card-solid">
            <div class="card-body">
                <form action="{{route('admin.media.update', ['medium' => $media->id])}}" method="post"
          enctype="multipart/form-data">
        @csrf
        @method('PATCH')
        <div class="row">
            <div class="col-5">
                <picture>
                    <source srcset="{{ $media->url }}" type="image/svg+xml">
                    <img src="{{ $media->url }}" class="img-fluid img-thumbnail" alt="...">
                </picture>
            </div>
            <div class="col-7">
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label" for="name">Назва</label>
                    <div class="col-sm-10">
                        <input id="name" name="name" class="form-control" value="{{$media->name}}">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label" for="keywords">Ключові слова</label>
                    <div class="col-sm-10">
                        <input id="keywords" name="keywords" class="form-control" value="{{$media->keywords}}">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label" for="description">Опис</label>
                    <div class="col-sm-10">
                        <input id="description" name="description" class="form-control" value="{{$media->description}}">
                    </div>
                </div>

                <input type="hidden" name="disc" value="public">
                {{--<div class="form-group row">
                    <label class="col-sm-2 col-form-label" for="disc">Диск</label>
                    <div class="col-sm-10">
                        <select name="disc" id="disc" class="form-control">
                            <option value="public" @if($media->disc == 'public') selected @endif>Для всіх</option>
                            <option value="local" @if($media->disc == 'local') selected @endif>Локально</option>
                        </select>
                    </div>
                </div>--}}
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label" for="visibility">Видимість</label>
                    <div class="col-sm-10">
                        <select name="visibility" id="visibility" class="form-control">
                            <option value="public" @if($media->visibility == 'public') selected @endif>Публічно</option>
                            <option value="private" @if($media->visibility == 'private') selected @endif>Приватно</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="row form-group">
                    <label class="col-sm-2 col-form-label" for="product">Прикріпити до товару</label>
                    <div class="col-sm-10">
                        @foreach($products as $product)
                            <div class="form-check">
                                <input name="products[]" class="form-check-input" type="checkbox" value="{{$product->id}}" id="defaultCheck{{$product->id}}"
                                @if($media->products->find($product->id)) checked @endif
                                >
                                <label class="form-check-label" for="defaultCheck{{$product->id}}">
                                    {{$product->title}}
                                </label>
                                <a href="{{route('admin.product.show', ['product'=>$product->id])}}">link</a>
                            </div>
                        @endforeach
                    </div>
                </div>

            </div>
            <div class="col-12 form-group">
                <div class="col-sm-12">
                    <div class="text-right">
                        <button type="submit" class="btn btn-primary">
                            Save
                        </button>
                    </div>

                </div>
            </div>
        </div>
    </form>
            </div>
        </div>
    </section>
@endsection
