@extends('admin.layouts.app')

@section('content')
    @include('admin.component.title_breadcrumbs', [
    'title' => 'Редагувати користувача',
    'breadcrumbs' => [
        'Користувачі' => route('admin.user.index'),
        'Перегляд' => route('admin.user.show',['user' => $user->id]),
        'Редагувати',
    ],
    'actions' => [
        'delete' => route('admin.user.destroy',['user' => $user->id])
    ]])
    @include('admin.component.events')

    <form action="{{route('admin.user.update', ['user' => $user->id])}}" method="post"
          enctype="multipart/form-data">
        @csrf
        @method('PATCH')

        <div class="form-group row">
            <label class="col-sm-2 col-form-label" for="email">Email</label>
            <div class="col-sm-10">
                <input name="email" type="email" id="email" value="{{$user->email}}" class="form-control">
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-form-label" for="password">Новий пароль</label>
            <div class="col-sm-10">
                <input name="password" type="password" id="password" class="form-control">
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-form-label" for="password_confirmation">Повторити пароль</label>
            <div class="col-sm-10">
                <input name="password_confirmation" type="password" id="password_confirmation" class="form-control">
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-form-label" for="first_name">Ім'я</label>
            <div class="col-sm-10">
                <input name="first_name" id="first_name" value="{{$user->detail->first_name}}" class="form-control">
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-form-label" for="last_name">Прізвище</label>
            <div class="col-sm-10">
                <input name="last_name" id="last_name" value="{{$user->detail->last_name}}" class="form-control">
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-form-label" for="phone">Телефон</label>
            <div class="col-sm-10">
                <input name="phone" type="text" id="phone" value="{{$user->detail->phone}}" class="form-control">
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-form-label" for="avatar">Аватарка</label>
            <div class="col-sm-10">
                <img src="{{$user->detail->avatar}}" alt="">
                <input name="avatar" id="avatar" type="file" class="form-control">
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-form-label" for="country">Країна</label>
            <div class="col-sm-10">
                <input name="country" id="country" value="{{$user->detail->country}}" class="form-control">
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-form-label" for="birthday">Дата народження</label>
            <div class="col-sm-10">
                <input name="birthday" type="date" id="birthday" value="{{$user->detail->birthday}}"
                       class="form-control">
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-form-label" for="location">Адреса</label>
            <div class="col-sm-10">
                <input name="location" type="text" id="location" value="{{$user->detail->location}}"
                       class="form-control">
            </div>
        </div>
        <div class="form-group row">
            <div class="col-sm-12">
                <div class="text-right">
                    <button type="submit" class="btn btn-primary">
                        Save
                    </button>
                </div>
            </div>
        </div>
    </form>
@endsection
