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
    <!-- Main content -->
    <section class="content">
        @include('admin.component.events')
        <div class="card card-solid">
            <div class="card-body">
                <p>{{$filter->name}}</p>
                <ol>
                    @foreach($filter->filterValues as $attribute)  <li>{{$attribute->value}}</li>  @endforeach
                </ol>
            </div>
        </div>
    </section>
@endsection
