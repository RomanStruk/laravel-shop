@extends('layouts.body')

@section('content')
    <!-- Slider Area Start -->
    <div class="slider-area slider-style-three">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <div class="slider-wrapper theme-default">
                        <!-- Slider Background  Image Start-->
                        <div id="slider" class="nivoSlider">
                            <a href="shop.html"> <img src="img/slider/5.jpg" data-thumb="img/slider/5.jpg" alt=""
                                                      title="#slider-1-caption1"/></a>
                            <a href="shop.html"><img src="img/slider/6.jpg" data-thumb="img/slider/6.jpg" alt=""
                                                     title="#slider-1-caption2"/></a>
                        </div>
                        <!-- Slider Background  Image Start-->
                        <div id="slider-1-caption1" class="nivo-html-caption nivo-caption">
                            <div class="text-content-wrapper">
                                <div class="text-content">
                                    <h4 class="title2 wow bounceInLeft text-white mb-16" data-wow-duration="2s"
                                        data-wow-delay="0s">Big Sale</h4>
                                    <h1 class="title1 wow bounceInRight text-white mb-16" data-wow-duration="2s"
                                        data-wow-delay="1s">Hand Tools <br>Power Saw Machine</h1>
                                    <div class="banner-readmore wow bounceInUp mt-35" data-wow-duration="2s"
                                         data-wow-delay="2s">
                                        <a class="button slider-btn" href="shop.html">Shop Now</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="slider-1-caption2" class="nivo-html-caption nivo-caption">
                            <div class="text-content-wrapper">
                                <div class="text-content slide-2">
                                    <h4 class="title2 wow bounceInLeft text-white mb-16" data-wow-duration="1s"
                                        data-wow-delay="1s">Big Sale</h4>
                                    <h1 class="title1 wow flipInX text-white mb-16" data-wow-duration="1s"
                                        data-wow-delay="2s">Hand Tools <br>Power Saw Machine</h1>
                                    <div class="banner-readmore wow bounceInUp mt-35" data-wow-duration="1s"
                                         data-wow-delay="3s">
                                        <a class="button slider-btn" href="shop.html">Shop Now</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <!-- Single Banner Start -->
                    <div class="single-banner zoom mb-20">
                        <a href="#"><img src="img/banner/9.jpg" alt="slider-banner"></a>
                    </div>
                    <!-- Single Banner End -->
                    <!-- Single Banner Start -->
                    <div class="single-banner zoom">
                        <a href="#"><img src="img/banner/10.jpg" alt="slider-banner"></a>
                    </div>
                    <!-- Single Banner End -->
                </div>
            </div>
        </div>
    </div>
    <!-- Slider Area End -->
    <!-- Product Area Start -->
    <div class="product-area pt-30">
        <div class="container">
            <div class="row">
            @forelse($favorite as $product)
                <!-- Single Product Start -->
                    <div class="col-lg-3 col-sm-6">
                        <div class="single-product">
                            <!-- Product Image Start -->
                            <div class="pro-img">
                                <a href="{{route('product.show', $product->alias)}}">
                                    <img class="first-img" src="{{$product->media->first()->url}}" alt="product-image">
                                    <img class="secondary-img" src="{{$product->media->first()->url}}"
                                         alt="single-product">
                                </a>
                            </div>
                            <!-- Product Image End -->
                            <!-- Product Content Start -->
                            <div class="pro-content">
                                <div class="product-rating">
                                    @for($i = 1; $i <= 5; $i++)
                                        @if($i <= $product->average_rating)
                                            <i class="fa fa-star"></i>
                                        @else
                                            <i class="fa fa-star-o"></i>
                                        @endif
                                    @endfor
                                </div>
                                <h4><a href="{{route('product.show', $product->alias)}}">{{$product->title}}</a></h4>
                                <p>{{config('shop.currency_short')}}
                                    <span class="price">{{$product->price}}</span>
                                    @if($product->old_price > $product->price)
                                        <del class="prev-price">-{{$product->old_price}}</del>
                                    @endif
                                </p>
                                <div class="pro-actions">
                                    <div class="actions-secondary">
                                        <a href="wishlist.html" data-toggle="tooltip" title="Add to Wishlist"><i
                                                class="fa fa-heart"></i></a>
                                        <basket-button-component
                                            v-bind:data='@json($product)'></basket-button-component>
                                        <a href="compare.html" data-toggle="tooltip" title="Add to Compare"><i
                                                class="fa fa-signal"></i></a>
                                    </div>
                                </div>
                            </div>
                            <!-- Product Content End -->
                        </div>
                    </div>
                @empty
                    <p>Empty</p>
                @endforelse
            </div>
        </div>
    </div>
    <!-- Product Area End -->
    <!-- Banner Start -->
    <div class="upper-banner banner pb-60">
        <div class="container">
            <div class="row">
                <!-- Single Banner Start -->
                <div class="col-sm-6">
                    <div class="single-banner zoom">
                        <a href="#"><img src="img/banner/1.png" alt="slider-banner"></a>
                    </div>
                </div>
                <!-- Single Banner End -->
                <!-- Single Banner Start -->
                <div class="col-sm-6">
                    <div class="single-banner zoom">
                        <a href="#"><img src="img/banner/2.png" alt="slider-banner"></a>
                    </div>
                </div>
                <!-- Single Banner End -->
            </div>
            <!-- Row End -->
        </div>
        <!-- Container End -->
    </div>
    <!-- Banner End -->
    <!-- New Products Start -->
    <div class="new-products pb-60">
        <div class="container">
            <div class="row">
                <div class="col-xl-3 col-lg-4 order-2">
                    <div class="side-product-list">
                        <div class="group-title">
                            <h2>Top Products</h2>
                        </div>
                        <!-- Deal Pro Activation Start -->
                        <div class="slider-right-content side-product-list-active owl-carousel">
                            <!-- Double Product Start -->
                            <div class="double-pro">
                            @forelse($popular->take(4) as $product)
                                <!-- Single Product Start -->
                                    <div class="single-product">
                                        <div class="pro-img">
                                            <a href="{{route('product.show', $product->alias)}}">
                                                <img class="img" src="{{$product->media->first()->url}}"
                                                     alt="product-image">
                                            </a>
                                        </div>
                                        <div class="pro-content">
                                            <div class="product-rating">
                                                @for($i = 1; $i <= 5; $i++)
                                                    @if($i <= $product->average_rating)
                                                        <i class="fa fa-star"></i>
                                                    @else
                                                        <i class="fa fa-star-o"></i>
                                                    @endif
                                                @endfor
                                            </div>
                                            <h4>
                                                <a href="{{route('product.show', $product->alias)}}">{{$product->title}}</a>
                                            </h4>
                                            <p>{{config('shop.currency_short')}}
                                                <span class="price">{{$product->price}}</span>
                                                @if($product->old_price > $product->price)
                                                    <del class="prev-price">-{{$product->old_price}}</del>
                                                @endif
                                            </p>
                                        </div>
                                    </div>
                                    <!-- Single Product End -->
                                @empty
                                    <p>empty</p>
                                @endforelse
                            </div>
                            <!-- Double Product End -->
                            <!-- Double Product Start -->
                            <div class="double-pro">
                            @forelse($popular->skip(4)->take(4) as $product)
                                <!-- Single Product Start -->
                                    <div class="single-product">
                                        <div class="pro-img">
                                            <a href="{{route('product.show', $product->alias)}}"><img class="img"
                                                                                                      src="{{$product->media->first()->url}}"
                                                                                                      alt="product-image"></a>
                                        </div>
                                        <div class="pro-content">
                                            <div class="product-rating">
                                                @for($i = 1; $i <= 5; $i++)
                                                    @if($i <= $product->average_rating)
                                                        <i class="fa fa-star"></i>
                                                    @else
                                                        <i class="fa fa-star-o"></i>
                                                    @endif
                                                @endfor
                                            </div>
                                            <h4>
                                                <a href="{{route('product.show', $product->alias)}}">{{$product->title}}</a>
                                            </h4>
                                            <p>{{config('shop.currency_short')}}
                                                <span class="price">{{$product->price}}</span>
                                                @if($product->old_price > $product->price)
                                                    <del class="prev-price">-{{$product->old_price}}</del>
                                                @endif
                                            </p>
                                        </div>
                                    </div>
                                    <!-- Single Product End -->
                                @empty
                                    <p>empty</p>
                                @endforelse
                            </div>
                            <!-- Double Product End -->
                        </div>
                        <!-- Deal Pro Activation End -->
                    </div>
                </div>
                <div class="col-xl-9 col-lg-8  order-lg-2">
                    <!-- New Pro Content End -->
                    <div class="new-pro-content">
                        <div class="pro-tab-title border-line">
                            <!-- Featured Product List Item Start -->
                            <ul class="nav product-list product-tab-list">
                                <li><a class="active" data-toggle="tab" href="#new-arrival">Нові надходження</a></li>
                                <li><a data-toggle="tab" href="#featured">Рекомендовані</a></li>
                                <li><a data-toggle="tab" href="#toprated">Високо оцінений</a></li>
                            </ul>
                            <!-- Featured Product List Item End -->
                        </div>
                        <div class="tab-content product-tab-content jump">
                            <div id="new-arrival" class="tab-pane active">
                                <!-- New Products Activation Start -->
                                <div class="new-pro-active owl-carousel">
                                @forelse($newArrival as $product)
                                    <!-- Single Product Start -->
                                        <div class="single-product">
                                            <!-- Product Image Start -->
                                            <div class="pro-img">
                                                <a href="{{route('product.show', $product->alias)}}">
                                                    <img class="primary-img" src="{{$product->media->first()->url}}"
                                                         alt="single-product">
                                                    <img class="secondary-img" src="{{$product->media->first()->url}}"
                                                         alt="single-product">
                                                </a>
                                            </div>
                                            <!-- Product Image End -->
                                            <!-- Product Content Start -->
                                            <div class="pro-content">
                                                <div class="product-rating">
                                                    @for($i = 1; $i <= 5; $i++)
                                                        @if($i <= $product->average_rating)
                                                            <i class="fa fa-star"></i>
                                                        @else
                                                            <i class="fa fa-star-o"></i>
                                                        @endif
                                                    @endfor
                                                </div>
                                                <h4>
                                                    <a href="{{route('product.show', $product->alias)}}">{{$product->title}}</a>
                                                </h4>
                                                <p>{{config('shop.currency_short')}}
                                                    <span class="price">{{$product->price}}</span>
                                                    @if($product->old_price > $product->price)
                                                        <del class="prev-price">-{{$product->old_price}}</del>
                                                    @endif
                                                </p>
                                                <div class="pro-actions">
                                                    <div class="actions-secondary">
                                                        <basket-button-component
                                                            v-bind:data='@json($product)'></basket-button-component>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Product Content End -->
                                        </div>
                                        <!-- Single Product End -->
                                    @empty
                                        <p>Empty</p>
                                    @endforelse
                                </div>
                                <!-- New Products Activation End -->
                            </div>
                            <!-- New Featured End -->
                            <div id="featured" class="tab-pane">
                                <!-- New Products Activation Start -->
                                <div class="new-pro-active owl-carousel">
                                @forelse($featured as $product)
                                    <!-- Single Product Start -->
                                        <div class="single-product">
                                            <!-- Product Image Start -->
                                            <div class="pro-img">
                                                <a href="{{route('product.show', $product->alias)}}">
                                                    <img class="primary-img" src="{{$product->media->first()->url}}"
                                                         alt="single-product">
                                                    <img class="secondary-img" src="{{$product->media->first()->url}}"
                                                         alt="single-product">
                                                </a>
                                            </div>
                                            <!-- Product Image End -->
                                            <!-- Product Content Start -->
                                            <div class="pro-content">
                                                <div class="product-rating">
                                                    @for($i = 1; $i <= 5; $i++)
                                                        @if($i <= $product->average_rating)
                                                            <i class="fa fa-star"></i>
                                                        @else
                                                            <i class="fa fa-star-o"></i>
                                                        @endif
                                                    @endfor
                                                </div>
                                                <h4>
                                                    <a href="{{route('product.show', $product->alias)}}">{{$product->title}}</a>
                                                </h4>
                                                <p>{{config('shop.currency_short')}}
                                                    <span class="price">{{$product->price}}</span>
                                                    @if($product->old_price > $product->price)
                                                        <del class="prev-price">-{{$product->old_price}}</del>
                                                    @endif
                                                </p>
                                                <div class="pro-actions">
                                                    <div class="actions-secondary">
                                                        <basket-button-component
                                                            v-bind:data='@json($product)'></basket-button-component>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Product Content End -->
                                        </div>
                                        <!-- Single Product End -->
                                    @empty
                                        <p>Empty</p>
                                    @endforelse
                                </div>
                                <!-- New Products Activation End -->
                            </div>
                            <!-- New Products End -->
                            <div id="toprated" class="tab-pane">
                                <!-- New Products Activation Start -->
                                <div class="new-pro-active owl-carousel">
                                @forelse($topRated as $product)
                                    <!-- Single Product Start -->
                                        <div class="single-product">
                                            <!-- Product Image Start -->
                                            <div class="pro-img">
                                                <a href="{{route('product.show', $product->alias)}}">
                                                    <img class="primary-img" src="{{$product->media->first()->url}}"
                                                         alt="single-product">
                                                    <img class="secondary-img" src="{{$product->media->first()->url}}"
                                                         alt="single-product">
                                                </a>
                                            </div>
                                            <!-- Product Image End -->
                                            <!-- Product Content Start -->
                                            <div class="pro-content">
                                                <div class="product-rating">
                                                    @for($i = 1; $i <= 5; $i++)
                                                        @if($i <= $product->average_rating)
                                                            <i class="fa fa-star"></i>
                                                        @else
                                                            <i class="fa fa-star-o"></i>
                                                        @endif
                                                    @endfor
                                                </div>
                                                <h4>
                                                    <a href="{{route('product.show', $product->alias)}}">{{$product->title}}</a>
                                                </h4>
                                                <p>{{config('shop.currency_short')}}
                                                    <span class="price">{{$product->price}}</span>
                                                    @if($product->old_price > $product->price)
                                                        <del class="prev-price">-{{$product->old_price}}</del>
                                                    @endif
                                                </p>
                                                <div class="pro-actions">
                                                    <div class="actions-secondary">
                                                        <basket-button-component
                                                            v-bind:data='@json($product)'></basket-button-component>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Product Content End -->
                                        </div>
                                        <!-- Single Product End -->
                                    @empty
                                        <p>Empty</p>
                                    @endforelse
                                </div>
                                <!-- New Products Activation End -->
                            </div>
                        </div>
                        <!-- Tab-Content End -->
                        <div class="single-banner zoom mt-30 mt-sm-10">
                            <a href="{{$banner->link}}"><img src="{{$banner->image}}" alt="slider-banner"></a>
                        </div>
                    </div>
                    <!-- New Pro Content End -->
                </div>
            </div>

        </div>
        <!-- Container End -->
    </div>
    <!-- New Products End -->
    <!-- Company Policy Start -->
    <div class="company-policy pb-60">
        <div class="container">
            <div class="row">
                <!-- Single Policy Start -->
                <div class="col-lg-3 col-sm-6">
                    <div class="single-policy">
                        <div class="icone-img">
                            <img src="img/icon/1.png" alt="">
                        </div>
                        <div class="policy-desc">
                            <h3>Free Delivery</h3>
                            <p>Free shipping on all order</p>
                        </div>
                    </div>
                </div>
                <!-- Single Policy End -->
                <!-- Single Policy Start -->
                <div class="col-lg-3 col-sm-6">
                    <div class="single-policy">
                        <div class="icone-img">
                            <img src="img/icon/2.png" alt="">
                        </div>
                        <div class="policy-desc">
                            <h3>Online Support 24/7</h3>
                            <p>Support online 24 hours</p>
                        </div>
                    </div>
                </div>
                <!-- Single Policy End -->
                <!-- Single Policy Start -->
                <div class="col-lg-3 col-sm-6">
                    <div class="single-policy">
                        <div class="icone-img">
                            <img src="img/icon/3.png" alt="">
                        </div>
                        <div class="policy-desc">
                            <h3>Money Return</h3>
                            <p>Back guarantee under 7 days</p>
                        </div>
                    </div>
                </div>
                <!-- Single Policy End -->
                <!-- Single Policy Start -->
                <div class="col-lg-3 col-sm-6">
                    <div class="single-policy">
                        <div class="icone-img">
                            <img src="img/icon/4.png" alt="">
                        </div>
                        <div class="policy-desc">
                            <h3>Member Discount</h3>
                            <p>Onevery order over $30.00</p>
                        </div>
                    </div>
                </div>
                <!-- Single Policy End -->
            </div>
        </div>
    </div>
    <!-- Company Policy End -->
@endsection
