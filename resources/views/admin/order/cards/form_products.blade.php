

<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title">Товари</h3>

        <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse"
                    data-toggle="tooltip" title="Collapse">
                <i class="fas fa-minus"></i></button>
        </div>
    </div>
    <div class="card-body" id="card-for-append">

        @if(old('products'))
            @php $products = \App\Product::whereIn('id', old('products'))->get()@endphp
            @php $i = 0 @endphp
            @foreach($products as $product)
                <div class="form-group row">
                    <div class="col-10">
                        <select name="products[]" class="form-control product-select2">
                            <option value="{{$product->id}}">{{$product->title}}</option>
                        </select>
                    </div>
                    <div class="col-2">
                        <input type="number" name="count[]" class="form-control" value="{{old('count')[$i]}}">
                    </div>
                </div>
                    @php $i++ @endphp
            @endforeach
        @endif
        <div class="form-group row">
            <div class="col-10">
                <select name="products[]" class="form-control product-select2"></select>
            </div>
            <div class="col-2">
                <input type="number" name="count[]" class="form-control" value="1">
            </div>
        </div>
    </div>
    <div class="card-footer">
        <button class="btn btn-info btn-sm float-right" title="Add a new field" id="add-new-field"><i class="fa fa-plus"></i></button>
    </div>
</div>
