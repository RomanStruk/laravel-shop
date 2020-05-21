@extends('admin.layouts.app')

@section('content')
    @include('admin.component.title_breadcrumbs', [
    'title' => 'Редагувати постачальника',
    'breadcrumbs' => [
        'Постачальники' => route('admin.supplier.index'),
        'Перегляд' => route('admin.supplier.show',$supplier),
        'Редагувати',
    ],
    'actions' => [
        'delete' => route('admin.supplier.destroy',$supplier)
    ]])

    <!-- Main content -->
    <section class="content">
        @include('admin.component.events')

        <div class="card card-solid">
            <div class="card-body">
                <form action="{{route('admin.supplier.update', $supplier)}}" method="post">
                    @csrf
                    @method('PATCH')

                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label" for="name">Name</label>
                        <div class="col-sm-10">
                            <input name="name" type="text" id="name" value="{{$supplier->name}}" class="form-control">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label" for="description">Опис</label>
                        <div class="col-sm-10">
                            <textarea name="description" id="description" class="form-control" cols="30"
                                      rows="5">{{$supplier->description}}</textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-12">
                            <div class="text-right">
                                <button type="submit" class="btn btn-primary">Save</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection
