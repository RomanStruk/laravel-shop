@extends('admin.layouts.app')

@section('content')
    <h2>
        <i class="fa fa-list"></i> Список медіа файлів
        <a href="{{route('admin.media.create')}}" title="Додати">
            <i class="fa fa-plus-circle" aria-hidden="true"></i>
        </a>
    </h2>
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
                    <div class="btn-group">
                        <a
                            href="{{ route( 'admin.media.show', ['medium' => $media->id]) }}"
                            data-toggle="tooltip" title="" class="btn btn-primary"
                            data-original-title="View">
                            <i class="fa fa-eye"></i>
                        </a>
                        <button type="button" class="btn btn-primary dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span class="sr-only">Toggle Dropdown</span>
                        </button>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="{{route('admin.media.edit', ['medium' => $media->id])}}"><i class="fa fa-pencil"></i> Edit</a>
                            <form method="POST" action="{{route('admin.media.destroy', ['medium' => $media->id])}}" >
                                @csrf
                                @method('DELETE')
                                <button class="dropdown-item" value="submit" type="submit"><i class="fa fa-trash-o"></i> Delete</button>
                            </form>
                        </div>
                    </div>
                </td>
            </tr>
        @endforeach

        </tbody>
    </table>
    {{ $medias->links() }}
@endsection
