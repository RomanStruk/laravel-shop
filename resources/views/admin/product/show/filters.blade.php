<div class="card">
    <div class="card-header">
        <h3 class="card-title">Фільтри</h3>
    </div>
    <div class="card-body">
        @foreach($product->product_filters as $product_filter)
            <div class="row">
                <div class="col-3">{{$product_filter->filter_group->name}}</div>
                <div class="col-9">
                    @if($attributes->firstWhere('id', '=', $product_filter->filter_group->id))
                        @foreach($attributes->firstWhere('id', '=', $product_filter->filter_group->id)->allAttributes as $attr)
                            @if($attr->id == $product_filter->id)
                                <span class="badge badge-primary">{{$product_filter->value}}</span>
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
