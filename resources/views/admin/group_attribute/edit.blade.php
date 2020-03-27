@extends('admin.layouts.app')

@section('content')
    @include('admin.component.title_breadcrumbs', [
    'title' => 'Редагувати групу атрибутів',
    'breadcrumbs' => [
        'Атрибути' => route('admin.group_attribute.index'),
        'Перегляд' => route('admin.group_attribute.show',['group_attribute' => $group->id]),
        'Редагувати',
    ],
    'actions' => [
        'delete' => route('admin.group_attribute.destroy',['group_attribute' => $group->id])
    ]])
    @include('admin.component.events')

    <form action="{{route('admin.group_attribute.update', ['group_attribute' => $group->id])}}" method="post">
        @csrf
        @method('PATCH')

        <div class="form-group row">
            <label class="col-sm-2 col-form-label" for="name">Name</label>
            <div class="col-sm-10">
                <input name="name" type="text" id="name" value="{{$group->name}}" class="form-control">
            </div>
        </div>
            <div class="form-group row">
                <label class="col-sm-2 col-form-label" >Варіанти</label>
                <div class="col-sm-10">
                    @foreach($group->allAttributes as $attribute)
                    <input name="value[{{$attribute->id}}]" type="text" id="" value="{{$attribute->value}}" class="form-control">
                    @endforeach
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
