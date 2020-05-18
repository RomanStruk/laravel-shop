<div class="card">
    <div class="card-header">
        <h3 class="card-title">Фільтри</h3>
    </div>
    <div class="card-body">
        @foreach($product->product_attributes as $product_attribute)
            <div class="row">
                <div class="col-3">{{$product_attribute->filter->name}}</div>
                <div class="col-9">
                    @if($attributes->firstWhere('id', '=', $product_attribute->filter->id))
                        @foreach($attributes->firstWhere('id', '=', $product_attribute->filter->id)->allAttributes as $attr)
                            @if($attr->id == $product_attribute->id)
                                <span class="badge badge-primary">{{$product_attribute->value}}</span>
                            @else
                                <span class="badge badge-secondary">{{$attr->value}}</span>
                            @endif
                        @endforeach
                    @endif
                </div>
            </div>
        @endforeach
    </div>
</div>
