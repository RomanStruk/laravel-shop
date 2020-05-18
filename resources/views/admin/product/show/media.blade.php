<div class="card">
    <div class="card-header">
        <h3 class="card-title">Зображення</h3>
    </div>
    <div class="card-body">
        <div class="col-12">
            <img src="{{$product->media->first()->url}}" class="product-image" alt="Product Image">
        </div>
        <div class="col-12 product-image-thumbs">
            @foreach($product->media as $media)
                <div class="product-image-thumb @if ($loop->first) active @endif"><img
                        src="{{$media->url}}" alt="Product Image"></div>
            @endforeach
        </div>
    </div>
</div>
