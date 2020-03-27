@extends('admin.layouts.app')

@section('content')
    @include('admin.component.title_breadcrumbs', [
    'title' => 'Перегляд атрибутів #'.$group->id,
    'breadcrumbs' => [
        'Атрибути' => route('admin.group_attribute.index'),
        'Перегляд',
    ],
    'actions' => [
        'edit' => route('admin.group_attribute.edit',['group_attribute' => $group->id]),
        'delete' => route('admin.group_attribute.destroy',['group_attribute' => $group->id])
]])
    @include('admin.component.events')
    <p>{{$group->name}}</p>
    <br>
    @foreach($group->allAttributes as $attribute) {{$attribute->value}},  @endforeach

@endsection
