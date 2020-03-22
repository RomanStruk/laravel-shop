@extends('admin.layouts.app')

@section('content')
    <h2>Додати користувача</h2>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('admin.user.index')}}">Домашня</a></li>
            <li class="breadcrumb-item active" aria-current="page">Додати</li>
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
    <form action="{{ route('admin.user.store') }}" method="post" class="needs-validation"  enctype="multipart/form-data" novalidate>
        @csrf
        <div class="form-group row">
            <label class="col-sm-2 col-form-label" for="title">Назва</label>
            <div class="col-sm-10">
                <input name="name" id="title" value="{{old('name')}}" class="form-control">
            </div>
        </div>

        <input type="submit" name="save" value="Save" class="btn btn-primary">
    </form>
@endsection
