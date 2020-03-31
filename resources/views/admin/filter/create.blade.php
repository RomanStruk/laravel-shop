@extends('admin.layouts.app')

@section('content')
    @include('admin.component.title_breadcrumbs', [
    'title' => 'Додати групу фільтрів',
    'breadcrumbs' => [
        'Фільтри' => route('admin.filter.index'),
        'Додати',
    ]])
    @include('admin.component.events')

    <form action="{{ route('admin.filter.store') }}" method="post" class="needs-validation"  enctype="multipart/form-data" novalidate>
        @csrf
        <div class="form-group row">
            <label class="col-sm-2 col-form-label" for="name">Name</label>
            <div class="col-sm-10">
                <input name="name" type="text" id="name" value="{{old('name')}}" class="form-control">
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-2 col-form-label" for="value">Варіанти</label>
            <div class="col-sm-10">
                <input name="value[]" type="text" id="value" value="{{old('value.0')}}" class="form-control">
                <input name="value[]" type="text" id="value" value="{{old('value.1')}}" class="form-control">
                <input name="value[]" type="text" id="value" value="{{old('value.2')}}" class="form-control">
                <input name="value[]" type="text" id="value" value="{{old('value.3')}}" class="form-control">
            </div>
        </div>

        <input type="submit" name="save" value="Save" class="btn btn-primary">
    </form>
@endsection
