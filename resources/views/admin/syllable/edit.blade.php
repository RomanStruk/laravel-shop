@extends('admin.layouts.app')

@section('content')
    @include('admin.component.title_breadcrumbs', [
    'title' => 'Редагувати к-сть товарів на складі',
    'breadcrumbs' => [
        'Склад' => route('admin.syllable.index'),
        'Редагувати',
    ],
    'actions' => [
        'delete' => route('admin.syllable.destroy',$syllable)
    ]])

    <!-- Main content -->
    <section class="content">
        @include('admin.component.events')

        <div class="card card-solid">
            <div class="card-body">
                <form action="{{route('admin.syllable.update', $syllable)}}" method="post">
                    @csrf
                    @method('PATCH')
                    <div class="form-group">
                        <label class="col-form-label" for="supplier">Постачальник</label>
                        <select id="supplier" name="supplier_id" class="form-control select2"
                                data-dropdown-css-class="select2" style="width: 100%;">
                            <option value="{{$syllable->supplier_id}}">{{$syllable->supplier->name}}</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="col-form-label" for="product">Товар</label>
                        <select id="product" name="product_id" class="form-control select2"
                                data-dropdown-css-class="select2" style="width: 100%;">
                            <option value="{{$syllable->product_id}}">{{$syllable->product->title}}</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="col-form-label" for="imported">Кількість одиниць товару</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">шт.</div>
                            </div>
                            <input name="imported" type="number" class="form-control" id="imported"
                                   value="{{$syllable->imported}}">
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
