

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
            @foreach(old('products') as $rpod)
                @php $product = \App\Product::findOrFail($rpod['id'])@endphp
                @php $i = 0 @endphp
                <div class="form-group row">
                    <div class="col-10">
                        <select name="products[0][id]" class="form-control product-select2">
                            <option value="{{$product->id}}">{{$product->title}}</option>
                        </select>
                    </div>
                    <div class="col-2">
                        <input type="number" name="products[0][count]" class="form-control" value="{{$rpod['count']}}">
                    </div>
                </div>
                    @php $i++ @endphp
            @endforeach
        @endif
        <div class="form-group row">
            <div class="col-10">
                <select name="products[0][id]" class="form-control product-select2"></select>
                <input type="hidden" name="products[0][syllable]">
            </div>
            <div class="col-2">
                <input type="number" name="products[0][count]" class="form-control" value="1">
            </div>
        </div>
    </div>
    <div class="card-footer">
        <button class="btn btn-info btn-sm float-right" title="Add a new field" id="add-new-field"><i class="fa fa-plus"></i></button>
    </div>
</div>
