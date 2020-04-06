@extends('admin.layouts.app')

@section('content')
    @include('admin.component.title_breadcrumbs', [
    'title' => 'Додати категорію',
    'breadcrumbs' => [
        'Категорії' => route('admin.category.index'),
        'Додати',
    ]])
    <section class="content">
        @include('admin.component.events')

        <div class="card card-solid">
            <div class="card-body">
                <form action="{{ route('admin.category.store') }}" method="post">
                    @csrf

                    @include('admin.category._form')
                </form>
            </div>
        </div>
    </section>

@endsection
