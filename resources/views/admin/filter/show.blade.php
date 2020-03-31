@extends('admin.layouts.app')

@section('content')
    @include('admin.component.title_breadcrumbs', [
    'title' => 'Перегляд фільтрів #'.$filter->id,
    'breadcrumbs' => [
        'Фільтри' => route('admin.filter.index'),
        'Перегляд',
    ],
    'actions' => [
        'edit' => route('admin.filter.edit',['filter' => $filter->id]),
        'delete' => route('admin.filter.destroy',['filter' => $filter->id])
]])
    @include('admin.component.events')
    <p>{{$filter->name}}</p>
    <br>
    @foreach($filter->filterValues as $attribute) {{$attribute->value}},  @endforeach

@endsection
