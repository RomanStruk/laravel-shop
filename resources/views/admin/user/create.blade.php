@extends('admin.layouts.app')

@section('content')
    @include('admin.component.title_breadcrumbs', [
    'title' => 'Додати користувача',
    'breadcrumbs' => [
        'Користувачі' => route('admin.user.index'),
        'Додати',
    ]])
    @include('admin.component.events')

    <form action="{{ route('admin.user.store') }}" method="post" class="needs-validation"  enctype="multipart/form-data" novalidate>
        @csrf
        <div class="form-group row">
            <label class="col-sm-2 col-form-label" for="email">Email</label>
            <div class="col-sm-10">
                <input name="email" type="email" id="email" value="{{old('email')}}" class="form-control">
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
                <input name="first_name" id="first_name" value="{{old('first_name')}}" class="form-control">
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-form-label" for="last_name">Прізвище</label>
            <div class="col-sm-10">
                <input name="last_name" id="last_name" value="{{old('last_name')}}" class="form-control">
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-form-label" for="phone">Телефон</label>
            <div class="col-sm-10">
                <input name="phone" type="text" id="phone" value="{{old('phone')}}" class="form-control">
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-form-label" for="avatar">Аватарка</label>
            <div class="col-sm-10">
                <input name="avatar" id="avatar" type="file" class="form-control">
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-form-label" for="country">Країна</label>
            <div class="col-sm-10">
                <input name="country" id="country" value="{{old('country')}}" class="form-control">
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-form-label" for="birthday">Дата народження</label>
            <div class="col-sm-10">
                <input name="birthday" type="date" id="birthday" value="{{old('birthday')}}" class="form-control">
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-form-label" for="location">Адреса</label>
            <div class="col-sm-10">
                <input name="location" type="text" id="location" value="{{old('location')}}" class="form-control">
            </div>
        </div>

        <input type="submit" name="save" value="Save" class="btn btn-primary">
    </form>
@endsection
