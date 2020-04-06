@extends('admin.layouts.app')

@section('content')
    @include('admin.component.title_breadcrumbs', [
        'title' => 'Перегляд товару #'.$product->id,
        'breadcrumbs' => [
            'Товари' => route('admin.product.index'),
            'Перегляд',
        ],
    'actions' => [
        'edit' => route('admin.product.edit',['product' => $product->id]),
        'delete' => route('admin.product.destroy',['product' => $product->id])]
     ])
    <!-- Main content -->
    <section class="content">
        @include('admin.component.events')

        <div class="row pb-2 mb-3 border-bottom justify-content-md-center">
            <div class="col-md-auto col-sm-6 col-12">
                <div class="info-box bg-gradient-info">
                    <span class="info-box-icon"><i class="fas fa-shopping-cart"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Загальний обсяг продажів</span>
                        <span class="info-box-number">41,410</span>

                        <div class="progress">
                            <div class="progress-bar" style="width: 70%"></div>
                        </div>
                        <span class="progress-description">
                      70% Increase in 30 Days
                    </span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <div class="col-md-auto col-sm-6 col-12">
                <div class="info-box bg-gradient-success">
                    <span class="info-box-icon"><i class="far fa-thumbs-up"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Популярність</span>
                        <span class="info-box-number">41,410</span>

                        <div class="progress">
                            <div class="progress-bar" style="width: 70%"></div>
                        </div>
                        <span class="progress-description">
                      70% Increase in 30 Days
                    </span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <div class="col-md-auto col-sm-6 col-12">
                <div class="info-box bg-gradient-warning">
                    <span class="info-box-icon"><i class="far fa-address-card"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Прогноз к-сті продажів</span>
                        <span class="info-box-number">41,410</span>

                        <div class="progress">
                            <div class="progress-bar" style="width: 70%"></div>
                        </div>
                        <span class="progress-description">
                      70% Increase in 30 Days
                    </span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
        </div>
        <div class="card card-solid">
            <div class="card-body">
                <div class="row">
                    <div class="col-12 col-sm-6">
                        <h3 class="d-inline-block d-sm-none">{{$product->title}}</h3>
                        <div class="col-12">
                            <img src="{{$product->media->first()->url}}" class="product-image" alt="Product Image">
                        </div>
                        <div class="col-12 product-image-thumbs">
                            @foreach($product->media as $media)
                                <div class="product-image-thumb @if ($loop->first) active @endif"><img src="{{$media->url}}" alt="Product Image"></div>
                            @endforeach
                        </div>
                    </div>
                    <div class="col-12 col-sm-6">
                        <h3 class="my-3">{{$product->title}}</h3>
                        <h6>Категорія:
                            <a href="{{route('admin.product.index', ['category' => $product->category->id])}}">
                                {{$product->category->name}}
                            </a>
                        </h6>
                        <div class="rating-summary fix mtb-10">
                            <div class="rating f-left">
                                @for($i = 1; $i <= 5; $i++)
                                    @if($i <= $product->average_rating)
                                        <i class="fa fa-star"></i>
                                    @else
                                        <i class="fa fa-star-o"></i>
                                    @endif
                                @endfor
                            </div>
                        </div>
                        <div class=" mb-15">
                            <p>
                                <span class="in-stock">в наявності </span>
                                <span class="badge badge-success">{{$product->in_stock}}</span>
                            </p>
                        </div>
                        <div class="row">
                            <div class="col-2">Ключові слова</div>
                            <div class="col-10">{{$product->keywords}}</div>
                        </div>
                        <p>{{$product->description}}</p>
                        <hr>
                        <div class="bg-gray py-2 px-3 mt-4">
                            <h2 class="mb-0">
                                ${{$product->price}}
                            </h2>
                            <h4 class="mt-0">
                                <small>Ex Tax: ${{$product->old_price}} </small>
                            </h4>
                        </div>
                    </div>
                </div>
                <div class="row mt-4">
                    <nav class="w-100">
                        <div class="nav nav-tabs" id="product-tab" role="tablist">
                            <a class="nav-item nav-link active" id="product-desc-tab" data-toggle="tab" href="#product-desc" role="tab" aria-controls="product-desc" aria-selected="true">Опис</a>
                            <a class="nav-item nav-link" id="product-comments-tab" data-toggle="tab" href="#product-comments" role="tab" aria-controls="product-comments" aria-selected="false">Відгуки</a>
                            <a class="nav-item nav-link" id="product-rating-tab" data-toggle="tab" href="#product-rating" role="tab" aria-controls="product-rating" aria-selected="false">Фільтри</a>
                        </div>
                    </nav>
                    <div class="tab-content p-3" id="nav-tabContent">
                        <div class="tab-pane fade show active" id="product-desc" role="tabpanel" aria-labelledby="product-desc-tab">{{$product->content}}</div>
                        <div class="tab-pane fade" id="product-comments" role="tabpanel" aria-labelledby="product-comments-tab">
                            @foreach($product->comments as $comment)
                                <div class="col-sm-12">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="row">
                                                <h5 class="card-title col-11">
                                                    {{$comment->user->name }}
                                                </h5>

                                                <div class="dropdown col-1">
                                                    <button class="btn btn-light dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        <b>...</b>
                                                    </button>
                                                    <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
                                                        <button class="dropdown-item" type="button">Action</button>
                                                        <button class="dropdown-item" type="button">Another action</button>
                                                        <button class="dropdown-item" type="button">Something else here</button>
                                                    </div>
                                                </div>
                                            </div>
                                            <div  class="">Оцінка:
                                                @for($i = 1; $i <= 5; $i++)
                                                    @if($i <= $comment->rating)
                                                        <i class="fa fa-star"></i>
                                                    @else
                                                        <i class="fa fa-star-o"></i>
                                                    @endif
                                                @endfor
                                            </div>
                                            <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach


                        </div>
                        <div class="tab-pane fade" id="product-rating" role="tabpanel" aria-labelledby="product-rating-tab">

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
                </div>
            </div>
            <!-- /.card-body -->
        </div>
    </section>
@endsection
