@extends('admin.layouts.app')

@section('content')
    @include('admin.component.title_breadcrumbs', [
    'title' => 'Список постачальників',
    'breadcrumbs' => [
        'Постачальники',
    ],
    'actions' => [
        'create' => route('admin.supplier.create')
]])
    <!-- Main content -->
    <section class="content">
        @include('admin.component.events')
        @include('admin.component.sort', [
        'route' => route('admin.supplier.index'),
        'search' => true,
        'limit' => true
        ])

        <div class="card card-solid">
            <div class="card-body p-0">
                <table class="table table-striped projects">
                    <thead>
                    <tr>
                        <td class="text-right col-1"><a class="desc">ID</a></td>
                        <td class="text-left col-3">Назва</td>
                        <td class="text-left col-6">Опис</td>
                        <td class="text-left col-2">Дія</td>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($suppliers as $supplier)
                        <tr>
                            <td class="text-right">{{ $supplier->id }}</td>
                            <td class="text-left">{{ $supplier->name }}</td>
                            <td class="text-left">{{ $supplier->description }}</td>
                            <td class="text-right">
                                @include('admin.component.dropdown_menu', [
                                    'show' => route( 'admin.supplier.show', $supplier),
                                    'edit' => route( 'admin.supplier.edit', $supplier),
                                    'delete' => route( 'admin.supplier.destroy', $supplier),

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
                        Showing {{$suppliers->firstItem()}} to {{$suppliers->lastItem()}} of {{$suppliers->total()}} entries
                    </div>
                    <div class="col-sm-12 col-md-7">
                        <div class="float-right">
                            {{ $suppliers->withQueryString()->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
