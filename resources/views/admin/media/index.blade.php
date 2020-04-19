@extends('admin.layouts.app')

@section('content')
    @include('admin.component.title_breadcrumbs', [
        'title' => 'Список медіа файлів',
        'breadcrumbs' => [
            'Медіа',
        ],
        'actions' => [
            'create' => route('admin.media.create')
        ]
    ])

    <!-- Main content -->
    <section class="content">
        @include('admin.component.events')
        @include('admin.component.sort', [
            'route' => route('admin.media.index'),
            'search' => true,
            'limit' => true
        ])
        <div class="card card-solid">
            <div class="card-body p-0">
                <table class="table table-striped projects">
                    <thead>
                    <tr>
                        <th class="text-right col-1">#</th>
                        <th class="text-left col-2">Зображення</th>
                        <th class="text-left col-4">Ім'я</th>
                        <th class="text-left col-1">Розмір</th>
                        <th class="text-left col-1">Розширення</th>
                        <th class="text-left col-1">Диск</th>
                        <th class="text-center col-2">Дія</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($medias as $media)
                        <tr>
                            <td class="text-right">{{ $media->id }}</td>
                            <td class="text-left">
                                <picture>
                                    <source srcset="{{ $media->url }}" type="image/svg+xml">
                                    <img src="{{ $media->url }}" class="img-fluid img-thumbnail" alt="..." style="height: 64px; width: auto">
                                </picture>
                            </td>
                            <td class="text-left">{{ $media->name }}</td>
                            <td class="text-left">{{ $media->size }}</td>
                            <td class="text-left">{{ $media->extension }}</td>
                            <td class="text-left">{{ $media->disc }}</td>
                            <td class="text-right">
                                @include('admin.component.dropdown_menu', [
                                    'show' => route( 'admin.media.show', ['medium' => $media->id]),
                                    'edit' => route( 'admin.media.edit', ['medium' => $media->id]),
                                    'delete' => route( 'admin.media.destroy', ['medium' => $media->id]),

                                ])

                            </td>
                        </tr>
                    @endforeach

                    </tbody>
                </table>
                <div class="row p-3">
                    <div class="col-sm-12 col-md-5">
                        Showing {{$medias->firstItem()}} to {{$medias->lastItem()}} of {{$medias->total()}} entries
                    </div>
                    <div class="col-sm-12 col-md-7">
                        <div class="float-right">
                            {{ $medias->withQueryString()->links() }}
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection
