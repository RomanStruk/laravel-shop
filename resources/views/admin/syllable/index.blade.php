@extends('admin.layouts.app')

@section('content')
    @include('admin.component.title_breadcrumbs', [
    'title' => 'Список товарів на складі',
    'breadcrumbs' => [
        'Список товарів на складі',
    ],
    'actions' => [
        'create' => route('admin.syllable.create')
]])
    <!-- Main content -->
    <section class="content">
        @include('admin.component.events')
        @include('admin.component.sort', [
        'route' => route('admin.syllable.index'),
        'search' => true,
        'limit' => true
        ])

        <div class="card card-solid">
            <div class="card-body p-0">
                <table class="table table-striped projects">
                    <thead>
                    <tr>
                        <th class="text-left col-1"><a class="desc">ID</a></th>
                        <th class="text-left col-4">Товар</th>
                        <th class="text-left col-2">Постачатьник</th>
                        <th class="text-left col-1">Додано</th>
                        <th class="text-left col-1">Актив</th>
                        <th class="text-left col-1">Обробляється</th>
                        <th class="text-left col-2">Опис</th>
                        <th class="text-left col-1">Дія</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($syllables as $syllable)
                        <tr>
                            <td class="text-left">{{ $syllable->id }}</td>
                            <td class="text-left">
                                <a href="{{route('admin.product.show', $syllable->product)}}">
                                    {{ $syllable->product->title }}
                                </a>
                                <br>
                                <small>Створено  {{ $syllable->created_at->format('d.M.Y h:m') }}</small>
                            </td>
                            <td class="text-left">
                                <a href="{{route('admin.supplier.show', $syllable->supplier)}}">
                                    {{ $syllable->supplier->name }}
                                </a>
                            </td>
                            <td class="text-left">{{ $syllable->imported }}</td>
                            <td class="text-left">{{ $syllable->remains }}</td>
                            <td class="text-left">{{ $syllable->countProcessed }}</td>
                            <td class="text-left">{{ $syllable->description }}</td>
                            <td class="text-right" style="min-width: 140px;">
                                @include('admin.component.dropdown_menu', [
                                        'show'=> route('admin.syllable.show', $syllable),
                                        'edit'=> route('admin.syllable.edit', $syllable),
                                        'delete' => route( 'admin.syllable.destroy', $syllable),])
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5">Нема атрибутів по заданому фільтру</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
                <div class="row p-3">
                    <div class="col-sm-12 col-md-5">
                        Showing {{$syllables->firstItem()}} to {{$syllables->lastItem()}} of {{$syllables->total()}} entries
                    </div>
                    <div class="col-sm-12 col-md-7">
                        <div class="float-right">
                            {{ $syllables->withQueryString()->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
