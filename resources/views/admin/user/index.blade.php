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

    <!-- Main content -->
    <section class="content">
        @include('admin.component.events')

        @include('admin.component.sort', [
        'route' => route('admin.user.index'),
        'status' => \App\User::listStatus(),
        'dateAdded' => true,
        'search' => true,
        'limit' => true
        ])

        <div class="card card-solid">
            <div class="card-body p-0">
                <table class="table table-striped projects">
                    <thead>
                    <tr>
                        <td class="text-right col-1">#</td>
                        <td class="text-left col-3">Email</td>
                        <td class="col-1">Status</td>
                        <td class="text-left col-2">Ім'я</td>
                        <td class="text-left col-2">Телефон</td>
                        <td class="text-left col-1">Роль</td>
                        <td class="text-center col-2">Дія</td>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($users as $user)
                        <tr>
                            <td class="text-right">{{ $user->id }}</td>
                            <td class="text-left">{{ $user->email }}</td>
                            <td class="project-state">
                                <span class="badge badge-success">{{ $user->getStatus($user->detail->status) }}</span>
                            </td>
                            <td class="text-left">{{ $user->detail->first_name}} {{$user->detail->last_name }}</td>
                            <td class="text-left">{{ $user->detail->phone }}</td>
                            <td class="text-left">
                                @foreach($user->roles as $role)
                                    {{$role->name}}
                                @endforeach
                            </td>
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
                <div class="row p-3">
                    <div class="col-sm-12 col-md-5">
                        Showing {{$users->firstItem()}} to {{$users->lastItem()}} of {{$users->total()}} entries
                    </div>
                    <div class="col-sm-12 col-md-7">
                        <div class="float-right">
                            {{ $users->withQueryString()->links() }}
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection
