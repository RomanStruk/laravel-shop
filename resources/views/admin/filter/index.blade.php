@extends('admin.layouts.app')

@section('content')
    @include('admin.component.title_breadcrumbs', [
    'title' => 'Список фільтрів',
    'breadcrumbs' => [
        'Фільтри',
    ],
    'actions' => [
        'create' => route('admin.filter.create')
]])
    <!-- Main content -->
    <section class="content">
        @include('admin.component.events')
        @include('admin.component.sort', [
        'route' => route('admin.filter.index'),
        'search' => true,
        'limit' => true
        ])

        <div class="card card-solid">
            <div class="card-body p-0">
                <table class="table table-striped projects">
                    <thead>
                    <tr>
                        <td class="text-right"><a class="desc">ID</a></td>
                        <td class="text-left"><a href="">Назва</a></td>
                        <td class="text-left ">Значення</td>
                        <td class="text-left ">Дія</td>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($filters as $group)
                        <tr>
                            <td class="text-right">{{ $group->id }}</td>
                            <td class="text-left">{{ $group->name }}</td>
                            <td class="text-left">
                                @foreach($group->allAttributes as $attribute) {{$attribute->value}},  @endforeach
                            </td>
                            <td class="text-right">
                                @include('admin.component.dropdown_menu', [
                                    'show' => route( 'admin.filter.show', ['filter' => $group->id]),
                                    'edit' => route( 'admin.filter.edit', ['filter' => $group->id]),
                                    'delete' => route( 'admin.filter.destroy', ['filter' => $group->id]),

                                ])
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
                        Showing {{$filters->firstItem()}} to {{$filters->lastItem()}} of {{$filters->total()}} entries
                    </div>
                    <div class="col-sm-12 col-md-7">
                        <div class="float-right">
                            {{ $filters->withQueryString()->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
