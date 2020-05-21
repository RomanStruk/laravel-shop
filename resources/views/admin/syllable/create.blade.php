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
                        <select id="supplier" name="supplier_id" class="form-control select2" data-dropdown-css-class="select2" style="width: 100%;" >

                        </select>
                    </div>
                    <div class="form-group">
                        <label class="col-form-label" for="product">Товар</label>
                        <select id="product" name="product_id" class="form-control select2" data-dropdown-css-class="select2" style="width: 100%;" >
                            @isset($product)
                                <option value="{{$product->id}}" selected>{{$product->title}}</option>
                            @endisset
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="col-form-label" for="imported">Кількість одиниць товару</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">шт.</div>
                            </div>
                            <input name="imported" type="number" class="form-control" id="imported" value="{{old('imported')}}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-form-label" for="price">Ціна товару</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">{{config('shop.currency_short')}}</div>
                            </div>
                            <input name="price" type="text" class="form-control" id="price" value="{{old('price')}}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-form-label" for="description">Опис (необов'язково)</label>
                        <textarea class="form-control" name="description" id="description" cols="30" rows="5">{{old('description')}}</textarea>
                    </div>

                    <input type="submit" name="save" value="Save" class="btn btn-primary">
                </form>
            </div>
        </div>
    </section>
@endsection
