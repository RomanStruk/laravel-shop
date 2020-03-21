@extends('admin.layouts.app')

@section('content')
    <h2>Редагувати користувача</h2>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('admin.user.index')}}">Домашня</a></li>
            <li class="breadcrumb-item"><a href="{{route('admin.user.show',['user' => $user->id])}}">Перегляд</a></li>
            <li class="breadcrumb-item active" aria-current="page">Редагувати</li>
        </ol>
    </nav>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    @if (\Session::has('success'))
        <div class="alert alert-success">
            <ul>
                <li>{!! \Session::get('success') !!}</li>
            </ul>
        </div>
    @endif
    <form action="{{route('admin.user.update', ['user' => $user->id])}}" method="post"
          enctype="multipart/form-data">
        @csrf
        @method('PATCH')
        <div class="row">

        </div>
    </form>
@endsection
