@extends('admin.layouts.app')

@section('content')
    @include('admin.component.title_breadcrumbs', [
    'title' => 'Додати постачальників',
    'breadcrumbs' => [
        'Постачальники' => route('admin.supplier.index'),
        'Додати',
    ]])
    <!-- Main content -->
    <section class="content">
        @include('admin.component.events')

        <div class="card card-solid">
            <div class="card-body">
                <form action="{{ route('admin.supplier.store') }}" method="post" class="needs-validation" novalidate>
                    @csrf
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label" for="name">Name</label>
                        <div class="col-sm-10">
                            <input name="name" type="text" id="name" value="{{old('name')}}" class="form-control">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label" for="description">Опис</label>
                        <div class="col-sm-10">
                            <textarea name="description" id="description" class="form-control" cols="30"
                                      rows="5">{{old('description')}}</textarea>
                        </div>
                    </div>

                    <input type="submit" name="save" value="Save" class="btn btn-primary">
                </form>
            </div>
        </div>
    </section>
@endsection
