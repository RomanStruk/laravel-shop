@extends('admin.layouts.app')

@section('content')
    @include('admin.component.title_breadcrumbs', [
    'title' => 'Редагувати групу фільтрів',
    'breadcrumbs' => [
        'Фільтри' => route('admin.filter.index'),
        'Перегляд' => route('admin.filter.show',['filter' => $filter->id]),
        'Редагувати',
    ],
    'actions' => [
        'delete' => route('admin.filter.destroy',['filter' => $filter->id])
    ]])
    @include('admin.component.events')

    <form action="{{route('admin.filter.update', ['filter' => $filter->id])}}" method="post">
        @csrf
        @method('PATCH')

        <div class="form-group row">
            <label class="col-sm-2 col-form-label" for="name">Name</label>
            <div class="col-sm-10">
                <input name="name" type="text" id="name" value="{{$filter->name}}" class="form-control">
            </div>
        </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label" >Варіанти</label>
                <div class="col-sm-10">
                    @foreach($filter->filterValues as $attribute)
                    <input name="value[]" type="text" id="" value="{{$attribute->value}}" class="form-control">
                    @endforeach
                    <input name="value[]" type="text" id="" class="form-control">
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
