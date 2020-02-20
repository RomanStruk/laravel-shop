@extends('layouts.body')

@section('content')
<!-- Breadcrumb Start -->
@component('components.breadcrumb-area')
    @slot('shop') Shop @endslot
@endcomponent
<!-- Breadcrumb End -->

<!-- Shop Page Start -->
<div class="main-shop-page pb-60">
    <div class="container">
        <!-- Row End -->
        <div class="row">
            <!-- Sidebar Shopping Option Start -->
            <div class="col-lg-3  order-2">
                <div class="sidebar white-bg">
                    <!-- Categories Start -->
                    @include('sidebar.categories')
                    <!-- Categories End -->

                    @if(Route::current()->getName() != 'shop2')
                        @include('sidebar.filtr-sidebar')
                    @endif

                    @component('components.sidebar')
                        @slot('title') Forbidden @endslot
                        You are not allowed to access this resource!
                    @endcomponent
                </div>
            </div>
            <!-- Sidebar Shopping Option End -->
            <!-- Product Categorie List Start -->
            <div class="col-lg-9 order-lg-2">
                <!-- Grid & List View Start -->
                <div class="grid-list-top border-default universal-padding fix mb-30">
                    <div class="grid-list-view f-left">
                        <ul class="list-inline nav">
                            <li><a data-toggle="tab" href="#grid-view"><i class="fa fa-th"></i></a></li>
                            <li><a  class="active" data-toggle="tab" href="#list-view"><i class="fa fa-list-ul"></i></a></li>
                            <li><span class="grid-item-list"> Items {{$products->firstItem()}}-{{$products->lastItem()}} of {{$products->total()}}</span></li>
                        </ul>
                    </div>
                    <!-- Toolbar Short Area Start -->
                    <div class="main-toolbar-sorter f-right">
                        <div class="toolbar-sorter">
                            <form method="post" action="{{ url()->current() }}">
                                @csrf
                            <label>Сортировка</label>
                            <select class="sorter" name="sorter">
                                <option value="price_asc">от дешевых к дорогим</option>
                                <option value="price_desc">от дорогих к дешевым</option>
                                <option value="rating" selected="selected">по рейтингу</option>
                                <option value="new">новинки</option>
                                <option value="popular">популярные</option>
                            </select>
                                <input type="submit" value="Send">
{{--                            <span><a href="#"><i class="fa fa-arrow-up"></i></a></span>--}}
                            </form>
                        </div>
                    </div>
                    <!-- Toolbar Short Area End -->
                </div>
                <!-- Grid & List View End -->
                <div class="main-categorie">
                    <!-- Grid & List Main Area End -->
                    <div class="tab-content fix">
                        <div id="grid-view" class="tab-pane ">
                            <div class="row">
                                @foreach($products as $product)<!-- TODO foreach $products-->
                                    <!-- Single Product Start -->
                                    <div class="col-lg-4 col-sm-6">
                                            <div class="single-product">
                                                <!-- Product Image Start -->
                                                <div class="pro-img">
                                                    <a href="{{url('/product/' . $product->alias)}}">
                                                        <img class="primary-img" src="{{$product->img}}" alt="single-product">
                                                        <img class="secondary-img" src="/img/products/2.jpg" alt="single-product">
                                                    </a>
                                                </div>
                                                <!-- Product Image End -->
                                                <!-- Product Content Start -->
                                                <div class="pro-content">
                                                    <div class="product-rating">
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                    </div>
                                                    <h4><a href="{{url('/product/' . $product->alias)}}">{{$product->title}}</a></h4>
                                                    <p><span class="price">${{$product->price}}</span><del class="prev-price">${{$product->old_price}}</del></p>
                                                    <div class="pro-actions">
                                                        <div class="actions-secondary">
                                                            <a href="wishlist.html" data-toggle="tooltip" title="Add to Wishlist"><i class="fa fa-heart"></i></a>
                                                            <a class="add-cart" href="cart.html" data-toggle="tooltip" title="Add to Cart">Add To Cart</a>
                                                            <a href="compare.html" data-toggle="tooltip" title="Add to Compare"><i class="fa fa-signal"></i></a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- Product Content End -->
                                            </div>
                                        </div>
                                    <!-- Single Product End -->
                                @endforeach
                            </div>
                        </div>
                        <!-- #grid view End -->
                        <div id="list-view" class="tab-pane active">
                            @foreach($products as $product)
                            <!-- Single Product Start -->
                            <div class="single-product">
                                <!-- Product Image Start -->
                                <div class="pro-img">
                                    <a href="{{url('/product/' . $product->alias)}}">
                                        <img class="primary-img" src="{{$product->img}}" alt="single-product">
                                        <img class="secondary-img" src="img/products/2.jpg" alt="single-product">
                                    </a>
                                </div>
                                <!-- Product Image End -->
                                <!-- Product Content Start -->
                                <div class="pro-content">
                                    <div class="product-rating">
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                    </div>
                                    <h4><a href="{{url('/product/' . $product->alias)}}">{{$product->id}} - {{$product->title}}</a></h4>
                                    <p><span class="price">${{$product->price}}</span><del class="prev-price">${{$product->old_price}}</del></p>
                                    <p>{{$product->description}}</p>
                                    <div class="pro-actions">
                                        <div class="actions-secondary">
                                            <a href="wishlist.html" data-toggle="tooltip" title="Add to Wishlist"><i class="fa fa-heart"></i></a>
                                            <a class="add-cart" href="cart.html" data-toggle="tooltip" title="Add to Cart">Add To Cart</a>
                                            <a href="compare.html" data-toggle="tooltip" title="Add to Compare"><i class="fa fa-signal"></i></a>
                                        </div>
                                    </div>
                                </div>
                                <!-- Product Content End -->
                            </div>
                            <!-- Single Product End -->
                            @endforeach
                        </div>
                        <!-- #list view End -->
                    </div>
                    <!-- Grid & List Main Area End -->
                </div>
                {{ $products->links('vendor.pagination.custome') }}

            </div>
            <!-- product Categorie List End -->
        </div>
        <!-- Row End -->
    </div>
    <!-- Container End -->
</div>
<!-- Shop Page End -->

<!-- Brand Logo Start -->
    @brands
<!-- Brand Logo End -->

@endsection
