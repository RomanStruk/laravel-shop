<div class="card">
    <div class="card-header">
        <h3 class="card-title">{{$product->title}}</h3>
    </div>
    <div class="card-body">
        <dl class="row">
            <dt class="col-sm-4">Категорія</dt>
            <dd class="col-sm-8">
                <a href="{{route('admin.product.index', ['category' => $product->category->id])}}">
                    {{$product->category->name}}
                </a>
            </dd>

            <dt class="col-sm-4">Рейтинг</dt>
            <dd class="col-sm-8">
                <div class="rating-summary fix mtb-10">
                    <div class="rating f-left">
                        @for($i = 1; $i <= 5; $i++)
                            @if($i <= $product->average_rating)
                                <i class="fa fa-star" style="color: #f9ba48;"></i>
                            @else
                                <i class="fa fa-star"></i>
                            @endif
                        @endfor
                    </div>
                </div>
            </dd>
            <dt class="col-sm-4">Ключові слова</dt>
            <dd class="col-sm-8">{{$product->keywords}}</dd>
            <dt class="col-sm-4">Короткий опис</dt>
            <dd class="col-sm-8">{{$product->description}}</dd>
        </dl>
    </div>
</div>
