@extends('admin.layouts.app')

@section('content')
    @include('admin.component.title_breadcrumbs', [
    'title' => 'Список категорії',
    'breadcrumbs' => [
        'Категорії',
    ],
    'actions' => [
        'create' => route('admin.category.create')
]])
    <!-- Main content -->
    <section class="content">
        @include('admin.component.events')
        @include('admin.component.sort', [
        'route' => route('admin.user.index'),
        'search' => true,
        'limit' => true
        ])

        <div class="card card-solid">
            <div class="card-body p-0">
                    <table class="table table-striped projects">
                        <thead>
                        <tr>
                            <td class="text-right col-1"><a class="desc">#</a></td>
                            <td class="text-left col-3"><a href="">Заголовок</a></td>
                            <td class="text-left col-4">Опис</td>
                            <td class="text-left col-2">Батьківський елемент</td>
                            <td class="text-center col-2">Дія</td>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($categories as $category)
                            <tr>
                                <td class="text-right">{{ $category->id }}</td>
                                <td class="text-left">{{ $category->name }}</td>
                                <td class="text-left">{{ $category->description }}</td>
                                <td class="text-left">{{ $category->parent->name ?? 'root' }}</td>
                                <td class="project-actions text-right">
                                    @include('admin.component.dropdown_menu', [
                                            'edit' => route( 'admin.category.edit', ['category' => $category->id]),
                                            'delete' => route( 'admin.category.destroy', ['category' => $category->id]),

                                        ])
                                </td>
                            </tr>
                        @endforeach

                        </tbody>
                    </table>
                <div class="row p-3">
                    <div class="col-sm-12 col-md-5">
                        Showing {{$categories->firstItem()}} to {{$categories->lastItem()}} of {{$categories->total()}} entries
                    </div>
                    <div class="col-sm-12 col-md-7">
                        <div class="float-right">
                            {{ $categories->withQueryString()->links() }}
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection
