@extends('layouts.body')


@section('content')
    @component('components.breadcrumb-area')
        @slot('product') {{$product->title}} @endslot
        Slot
    @endcomponent
    <!-- Product Thumbnail Start -->
    <div class="main-product-thumbnail pb-60">
        <div class="container">
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
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star-o"></i>
                                <i class="fa fa-star-o"></i>
                                <i class="fa fa-star-o"></i>
                            </div>
                            <div class="rating-feedback f-left">
                                <a href="#">(1* відгук)</a>
                                <a href="#">додати ваш відгук</a>
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
                        <basket-button-component></basket-button-component>
                        <div class="product-link">
                            <ul class="list-inline">
                                <li><a href="wishlist.html">Add to Wish List</a></li>
                                <li><a href="compare.html">Add to compare</a></li>
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
                    <ul class="main-thumb-desc nav">
                        <li><a class="active" data-toggle="tab" href="#dtail">Деталі</a></li>
                        <li><a data-toggle="tab" href="#review">Відгуки 1</a></li>
                    </ul>
                    <!-- Product Thumbnail Tab Content Start -->
                    <div class="tab-content thumb-content border-default">
                        <div id="dtail" class="tab-pane in active">
                            {{$product->content}}
                        </div>
                        <div id="review" class="tab-pane">

                            <comments-component></comments-component>
                            <!-- Reviews Start -->
                            <div class="review border-default universal-padding mt-30">
                                <h2 class="review-title mb-30">You're reviewing: <br><span>Go-Get'r Pushup Grips</span>
                                </h2>
                                <p class="review-mini-title">your rating</p>
                                <ul class="review-list">
                                    <!-- Single Review List Start -->
                                    <li>
                                        <span>Quality</span>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star-o"></i>
                                        <i class="fa fa-star-o"></i>
                                    </li>
                                    <!-- Single Review List End -->
                                    <!-- Single Review List Start -->
                                    <li>
                                        <span>price</span>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star-o"></i>
                                        <i class="fa fa-star-o"></i>
                                        <i class="fa fa-star-o"></i>
                                    </li>
                                    <!-- Single Review List End -->
                                    <!-- Single Review List Start -->
                                    <li>
                                        <span>value</span>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star-o"></i>
                                    </li>
                                    <!-- Single Review List End -->
                                </ul>
                                <!-- Reviews Field Start -->
                                <div class="riview-field mt-40">
                                    <form autocomplete="off" action="#" method="post">
                                        @csrf
                                        <input type="hidden" id="id_product" name="id_product" value="{{$product->id}}">
                                        <input type="hidden" id="alias" name="id_product" value="{{$product->alias}}">
                                        <div class="form-group">
                                            <label class="req" for="sure-name">Nickname</label>
                                            <input type="text" class="form-control" id="sure-name" required="required">
                                        </div>
                                        <div class="form-group">
                                            <label class="req" for="subject">Summary</label>
                                            <input type="text" class="form-control" id="subject" required="required">
                                        </div>
                                        <div class="form-group">
                                            <label class="req" for="comments">Review</label>
                                            <textarea class="form-control" rows="5" id="comments"
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
