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
    @include('admin.component.sort', [
    'route' => route('admin.user.index'),
    'search' => true,
    'limit' => true
    ])
    @include('admin.component.events')

    <div class="row">
        <div class="col-md-12 col-md-pull-3 col-sm-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    <table class="table table-bordered table-hover">
                        <thead>
                        <tr>
                            <td class="text-right col-1"><a class="desc">ID</a></td>
                            <td class="text-left col-6"><a href="">Заголовок</a></td>
                            <td class="text-left col-4">Батьківський елемент</td>
                            <td class="text-center col-1">Дія</td>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($categories as $category)
                            <tr>
                                <td class="text-right">{{ $category->id }}</td>
                                <td class="text-left">{{ $category->name }}</td>
                                <td class="text-left">{{ $category->parent->name ?? 'root' }}</td>
                                <td class="text-right">
                                    <div class="btn-group">
                                        <a  class="btn btn-primary"
                                           href="{{route('admin.category.edit', ['category' => $category->id])}}">
                                            <i class="fa fa-pencil"></i>
                                        </a>
                                        <form method="POST" action="{{route('admin.category.destroy', ['category' => $category->id])}}" >
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-primary" value="submit" type="submit">
                                                <i class="fa fa-trash-o"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach

                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
@endsection
