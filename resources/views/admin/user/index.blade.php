@extends('admin.layouts.app')

@section('content')
    @include('admin.component.title_breadcrumbs', [
    'title' => 'Список користувачів',
    'breadcrumbs' => [
        'Користувачі',
    ],
    'actions' => [
        'create' => route('admin.user.create')
]])
    @include('admin.component.sort', [
    'route' => route('admin.user.index'),
    'status' => \App\User::listStatus(),
    'dateAdded' => true,
    'search' => true,
    'limit' => true
    ])
    @include('admin.component.events')

    <table class="table table-bordered table-hover">
        <thead>
        <tr>
            <td class="text-right col-1">ID</td>
            <td class="text-left col-4">Email</td>
            <td class="text-left col-4">Status</td>
            <td class="text-left col-4">Ім'я</td>
            <td class="text-left col-2">Телефон</td>
            <td class="text-center col-1">Дія</td>
        </tr>
        </thead>
        <tbody>
        @foreach($users as $user)
            <tr>
                <td class="text-right">{{ $user->id }}</td>
                <td class="text-left">{{ $user->email }}</td>
                <td class="text-left">{{ $user->getStatus($user->detail->status) }}</td>
                <td class="text-left">{{ $user->detail->first_name}} {{$user->detail->last_name }}</td>
                <td class="text-left">{{ $user->detail->phone }}</td>
                <td class="text-right">
                    @include('admin.component.dropdown_menu', [
                        'show' => route( 'admin.user.show', ['user' => $user->id]),
                        'edit' => route( 'admin.user.edit', ['user' => $user->id]),
                        'delete' => route( 'admin.user.destroy', ['user' => $user->id]),
                    ])
                </td>
            </tr>
        @endforeach

        </tbody>
    </table>
    {{ $users->links() }}
@endsection
