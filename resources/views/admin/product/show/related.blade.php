<div class="card">
    <div class="card-header">
        <h3 class="card-title">Пов'язані товари</h3>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-12">
                @forelse($product->related as $product_related)
                    <a class="btn btn-secondary btn-sm" href="{{route('admin.product.show', $product_related->id)}}">{{$product_related->title}}</a>
                @empty
                    <p>Нема даних</p>
                @endforelse
            </div>
        </div>
    </div>
</div>
