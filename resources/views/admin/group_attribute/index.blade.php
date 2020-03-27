@extends('admin.layouts.app')

@section('content')
    @include('admin.component.title_breadcrumbs', [
    'title' => 'Список атрибутів',
    'breadcrumbs' => [
        'Атрибути',
    ],
    'actions' => [
        'create' => route('admin.group_attribute.create')
]])
    @include('admin.component.sort', [
    'route' => route('admin.group_attribute.index'),
    'search' => true,
    'limit' => true
    ])
    @include('admin.component.events')

    <table class="table table-bordered table-hover">
        <thead>
        <tr>
            <td class="text-right col-1"><a class="desc">ID</a></td>
            <td class="text-left col-3"><a href="">Назва</a></td>
            <td class="text-left col-7">Значення</td>
            <td class="text-left col-1">Дія</td>
        </tr>
        </thead>
        <tbody>
        @forelse($groups as $group)
            <tr>
                <td class="text-right">{{ $group->id }}</td>
                <td class="text-left">{{ $group->name }}</td>
                <td class="text-left">
                    @foreach($group->allAttributes as $attribute) {{$attribute->value}},  @endforeach
                </td>
                <td class="text-right">
                    @include('admin.component.dropdown_menu', [
                        'show' => route( 'admin.group_attribute.show', ['group_attribute' => $group->id]),
                        'edit' => route( 'admin.group_attribute.edit', ['group_attribute' => $group->id]),
                        'delete' => route( 'admin.group_attribute.destroy', ['group_attribute' => $group->id]),

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
    {{ $groups->links() }}
@endsection
