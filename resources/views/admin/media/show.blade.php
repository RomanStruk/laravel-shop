@extends('admin.layouts.app')

@section('content')

    @include('admin.component.title_breadcrumbs', [
        'title' => 'Перегляд медіа файлу #'.$media->id,
        'breadcrumbs' => [
            'Медіа' => route('admin.media.index'),
            'Перегляд',
        ],
        'actions' => [
            'edit' => route('admin.media.edit', ['medium' => $media->id])
        ]
    ])

    <!-- Main content -->
    <section class="content">
        @include('admin.component.events')
        <div class="card card-solid">
            <div class="card-body">
                <div class="row">
                    <div class="col-4" style="min-width: 300px;">
                        <picture>
                            <source srcset="{{ $media->url }}" type="image/svg+xml">
                            <img src="{{$media->url}}" class="img" alt="..." style="width: 300px; height: auto">
                        </picture>
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
            </div>
        </div>
    </section>
@endsection
