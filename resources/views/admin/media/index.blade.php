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
    @include('admin.component.sort', [
        'route' => route('admin.media.index'),
        'search' => true,
        'limit' => true
    ])
    @include('admin.component.events')

    <table class="table table-bordered table-hover">
        <thead>
        <tr>
            <td class="text-right col-1">ID</td>
            <td class="text-left col-2">Зображення</td>
            <td class="text-left col-3">Ім'я</td>
            <td class="text-left col-1">Розмір</td>
            <td class="text-left col-1">Розширення</td>
            <td class="text-left col-1">Диск</td>
            <td class="text-center col-1">Дія</td>
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
    {{ $medias->links() }}
@endsection
