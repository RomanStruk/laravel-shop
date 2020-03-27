@extends('admin.layouts.app')

@section('content')
    @include('admin.component.title_breadcrumbs', [
    'title' => 'Додати групу атрибутів',
    'breadcrumbs' => [
        'Атрибути' => route('admin.group_attribute.index'),
        'Додати',
    ]])
    @include('admin.component.events')

    <form action="{{ route('admin.group_attribute.store') }}" method="post" class="needs-validation"  enctype="multipart/form-data" novalidate>
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
                <input name="value[]" type="text" id="value" value="{{old('value')}}" class="form-control">
                <input name="value[]" type="text" id="value" value="{{old('value')}}" class="form-control">
                <input name="value[]" type="text" id="value" value="{{old('value')}}" class="form-control">
                <input name="value[]" type="text" id="value" value="{{old('value')}}" class="form-control">
            </div>
        </div>

        <input type="submit" name="save" value="Save" class="btn btn-primary">
    </form>
@endsection
