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
    @include('admin.component.events')

    <table class="table table-bordered table-hover">
        <thead>
        <tr>
            <td class="text-right col-1">ID</td>
            <td class="text-left col-4">Email</td>
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
                <td class="text-left">{{ $user->detail->first_name}} {{$user->detail->last_name }}</td>
                <td class="text-left">{{ $user->detail->phone }}</td>
                <td class="text-right">
                    <div class="btn-group">
                        <a
                            href="{{ route( 'admin.user.show', ['user' => $user->id]) }}"
                            data-toggle="tooltip" title="" class="btn btn-primary"
                            data-original-title="View">
                            <i class="fa fa-eye"></i>
                        </a>
                        <button type="button" class="btn btn-primary dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span class="sr-only">Toggle Dropdown</span>
                        </button>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="{{route('admin.user.edit', ['user' => $user->id])}}"><i class="fa fa-pencil"></i> Edit</a>
                            <form method="POST" action="{{route('admin.user.destroy', ['user' => $user->id])}}" >
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
    {{ $users->links() }}
@endsection
