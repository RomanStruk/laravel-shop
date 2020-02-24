@extends('layouts.body')


@section('content')
    @component('components.breadcrumb-area')
        @slot('product') {{$product->title}} @endslot
        Slot
    @endcomponent
    <!-- Product Thumbnail Start -->
    <div class="main-product-thumbnail pb-60">
        <div class="container">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
                @if (\Session::has('success'))
                    <div class="alert alert-success">
                        <ul>
                            <li>{!! \Session::get('success') !!}</li>
                        </ul>
                    </div>
                @endif
            <div class="row">
                <!-- Main Thumbnail Image Start -->
                <div class="col-lg-5">
                    <!-- Thumbnail Large Image start -->
                    <div class="tab-content">
                        <div id="thumb1" class="tab-pane active">
                            <a data-fancybox="images" href="/img/products/1.jpg">
                                <img src="/img/products/1.jpg" id="product_img" alt="product-view"></a>
                        </div>
                        <div id="thumb2" class="tab-pane">
                            <a data-fancybox="images" href="/img/products/2.jpg"><img src="/img/products/2.jpg"
                                                                                      alt="product-view"></a>
                        </div>
                        <div id="thumb3" class="tab-pane">
                            <a data-fancybox="images" href="/img/products/3.jpg"><img src="/img/products/3.jpg"
                                                                                      alt="product-view"></a>
                        </div>
                        <div id="thumb4" class="tab-pane">
                            <a data-fancybox="images" href="/img/products/4.jpg"><img src="/img/products/4.jpg"
                                                                                      alt="product-view"></a>
                        </div>
                    </div>
                    <!-- Thumbnail Large Image End -->

                    <!-- Thumbnail Image End -->
                    <div class="product-thumbnail">
                        <div class="thumb-menu nav">
                            <a class="active" data-toggle="tab" href="#thumb1">
                                <img src="/img/products/1.jpg" alt="product-thumbnail"></a>
                            <a data-toggle="tab" href="#thumb2">
                                <img src="/img/products/2.jpg" alt="product-thumbnail"></a>
                            <a data-toggle="tab" href="#thumb3">
                                <img src="/img/products/3.jpg" alt="product-thumbnail"></a>
                            <a data-toggle="tab" href="#thumb4">
                                <img src="/img/products/4.jpg" alt="product-thumbnail"></a>
                        </div>
                    </div>
                    <!-- Thumbnail image end -->
                </div>
                <!-- Main Thumbnail Image End -->
                <!-- Thumbnail Description Start -->
                <div class="col-lg-7">
                    <div class="thubnail-desc fix">
                        <h3 class="product-header">{{$product->title}}</h3>
                        <div class="rating-summary fix mtb-10">
                            <div class="rating f-left">
                                @for($i = 1; $i <= 5; $i++)
                                    @if($i <= $product->rating)
                                        <i class="fa fa-star"></i>
                                    @else
                                        <i class="fa fa-star-o"></i>
                                    @endif
                                @endfor
                            </div>
                            <div class="rating-feedback f-left">
                                <a href="#comments">({{ $product->count_comments }} відгук-ів)</a>
                                <a href="#comments">додати ваш відгук</a>
                            </div>
                        </div>
                        <div class="pro-price mb-10">
                            <p>$<span class="price">{{$product->price}}</span>
                                <del class="prev-price">-{{$product->old_price}}</del>
                            </p>
                        </div>
                        <div class="pro-ref mb-15">
                            <p><span class="in-stock">в наявності</span><span class="sku">{{$product->in_stock}}</span>
                            </p>
                        </div>
                        <basket-button-component v-bind:data="{{json_encode($product)}}"></basket-button-component>
                        <div class="product-link">
                            <ul class="list-inline">
                                <li><a href="/wishlist">Додати до списку бажань</a></li>
                                <li><a href="/compare">Додати до порівняння</a></li>
                                <li><a href="#">Email</a></li>
                            </ul>
                        </div>
                        <p class="ptb-20">
                            {{$product->description}}
                        </p>
                    </div>
                </div>
                <!-- Thumbnail Description End -->
            </div>
            <!-- Row End -->
        </div>
        <!-- Container End -->
    </div>
    <!-- Product Thumbnail End -->
    <!-- Product Thumbnail Description Start -->
    <div class="thumnail-desc pb-60">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <ul id="comments" class="main-thumb-desc nav">
                        <li><a class="active" data-toggle="tab" href="#dtail">Деталі</a></li>
                        <li><a data-toggle="tab" href="#review">Відгуки {{ $product->count_comments }}</a></li>
                    </ul>
                    <!-- Product Thumbnail Tab Content Start -->
                    <div class="tab-content thumb-content border-default">
                        <div id="dtail" class="tab-pane in active">
                            {{$product->content}}
                        </div>
                        <div id="review" class="tab-pane">

                            <comments-component v-bind:productid='@json($product->id)'></comments-component>
                            <!-- Reviews Start -->
                            <div class="review border-default universal-padding mt-30">
                                <h2 class="review-title mb-30">Ви рецензуєте:</h2>
                                <!-- Reviews Field Start -->
                                <div class="riview-field mt-40">
                                    <form autocomplete="off" action="{{ route('comment.create', ['id'=> $product->id]) }}" method="post">
                                        @csrf
                                        <input type="hidden" id="alias" name="alias" value="{{$product->alias}}">
                                        <div class="form-group">
                                            <label class="req">Рейтинг</label>
                                            <label class="fa fa-star">
                                                <input type="radio" name="rating" value="1" required="required">
                                            </label>
                                            <label class="fa fa-star">
                                                <input type="radio" name="rating" value="2" required="required">
                                            </label>
                                            <label class="fa fa-star">
                                                <input type="radio" name="rating" value="3" required="required">
                                            </label>
                                            <label class="fa fa-star">
                                                <input type="radio" name="rating" value="4" required="required">
                                            </label>
                                            <label class="fa fa-star">
                                                <input type="radio" name="rating" value="5" required="required">
                                            </label>
                                        </div>
                                        <div class="form-group">
                                            <label class="req" for="comments">Review</label>
                                            <textarea name="text" class="form-control" rows="5" id="comments"
                                                      required="required"></textarea>
                                        </div>
                                        <button type="submit" class="btn-submit">Submit Review</button>
                                    </form>
                                </div>
                                <!-- Reviews Field Start -->
                            </div>
                            <!-- Reviews End -->
                        </div>
                    </div>
                    <!-- Product Thumbnail Tab Content End -->
                </div>
            </div>
            <!-- Row End -->
        </div>
        <!-- Container End -->
    </div>
    <!-- Product Thumbnail Description End -->

    <!-- Realted Product Start -->
    @inject('related_products', 'App\Http\Controllers\RelatedProductsController')
    {{ $related_products->show() }}
    <!-- Realted Product End -->

    <!-- Upsell Product Start -->
    @inject('up_sell', 'App\Http\Controllers\UpSellController')
    {{ $up_sell->showUpSellList() }}
    <!-- Upsell Product End -->

    <!-- Brand Logo Start -->
    @inject('brands', 'App\Http\Controllers\BrandsController')
    {{ $brands->showBrandList() }}
    <!-- Brand Logo End -->
@endsection
