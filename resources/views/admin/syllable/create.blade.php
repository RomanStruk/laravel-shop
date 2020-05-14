@extends('admin.layouts.app')
@section('script')
    <script src="{{ mix('adm/js/syllable.js')}}"></script>
@endsection
@section('content')
    @include('admin.component.title_breadcrumbs', [
    'title' => 'Додати товар на склад',
    'breadcrumbs' => [
        'Склад' => route('admin.syllable.index'),
        'Додати',
    ]])
    <!-- Main content -->
    <section class="content">
        @include('admin.component.events')

        <div class="card card-solid">
            <div class="card-body">
                <form action="{{ route('admin.syllable.store') }}" method="post" class="needs-validation" novalidate>
                    @csrf
                    <div class="form-group">
                        <label class="col-form-label" for="supplier">Постачальник</label>
                        <select id="supplier" name="supplier_id" class="form-control select2" data-dropdown-css-class="select2" style="width: 100%;" ></select>
                    </div>
                    <div class="form-group">
                        <label class="col-form-label" for="product">Товар</label>
                        <select id="product" name="product_id" class="form-control select2" data-dropdown-css-class="select2" style="width: 100%;" ></select>
                    </div>
                    <div class="form-group">
                        <label class="col-form-label" for="imported">Кількість одиниць товару</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">шт.</div>
                            </div>
                            <input name="imported" type="number" class="form-control" id="imported"
                                   value="{{old('imported')}}">
                        </div>
                    </div>

                    <input type="submit" name="save" value="Save" class="btn btn-primary">
                </form>
            </div>
        </div>
    </section>
@endsection
