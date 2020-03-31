@extends('admin.layouts.app')

@section('content')
    <h1>Перегляд товару #{{$product->id}}
        <a href="{{route('admin.product.edit', ['product' => $product->id])}}" title="Редагувати">
            <i class="fa fa-edit" aria-hidden="true"></i>
        </a>
    </h1>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('admin.product.index')}}">Домашня</a></li>
            <li class="breadcrumb-item active" aria-current="page">Перегляд</li>

        </ol>
    </nav>
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
    <div class="row pb-2 mb-3 border-bottom">
        <div class="col-md-4 mb-2">
            <div class="card tilebox-one">
                <div class="card-body">
                    <i class="uil uil-users-alt float-right"></i>
                    <h6 class="text-uppercase mt-0">Загальний обсяг продажів</h6>
                    <h2 class="my-2" id="active-users-count">2.34K $</h2>
                    <p class="mb-0 text-muted">
                        <span class="text-success mr-2"><span class="mdi mdi-arrow-up-bold"></span> 50.33%</span>
                        <span class="text-nowrap">З минулого місяця</span>
                    </p>
                </div> <!-- end card-body-->
            </div>
        </div>
        <div class="col-md-4 mb-2">
            <div class="card tilebox-one">
                <div class="card-body">
                    <i class="uil uil-users-alt float-right"></i>
                    <h6 class="text-uppercase mt-0">Популярність</h6>
                    <h2 class="my-2" id="active-users-count">1.34K</h2>
                    <p class="mb-0 text-muted">
                        <span class="text-success mr-2"><span class="mdi mdi-arrow-up-bold"></span> 5.27%</span>
                        <span class="text-nowrap">З минулого місяця</span>
                    </p>
                </div> <!-- end card-body-->
            </div>
        </div>
        <div class="col-md-4 mb-2">
            <div class="card tilebox-one">
                <div class="card-body">
                    <i class="uil uil-users-alt float-right"></i>
                    <h6 class="text-uppercase mt-0">Прогноз к-сті продажів</h6>
                    <h2 class="my-2" id="active-users-count">1.2K</h2>
                    <p class="mb-0 text-muted">
                        <span class="text-success mr-2"><span class="mdi mdi-arrow-up-bold"></span> 92.5%</span>
                        <span class="text-nowrap">На наступний місяць</span>
                    </p>
                </div> <!-- end card-body-->
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-5">
            <div class="tab-content">
                @foreach($product->media as $media)
                <div id="thumb_{{$media->id}}" class="tab-pane @if ($loop->first) active @endif">
                    <a data-fancybox="images" href="{{route('admin.media.show', ['medium' => $media->id])}}">
                        <img class="img" src="{{$media->url}}" id="product_img" alt="product-view"></a>
                </div>
                @endforeach
            </div>
            <div class="product-thumbnail">
                <div class="thumb-menu nav">
                    @foreach($product->media as $media)
                    <a data-toggle="tab" href="#thumb_{{$media->id}}" class="@if ($loop->first) active @endif">
                        <img src="{{$media->url}}" alt="product-thumbnail">
                    </a>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="col-lg-7">
            <div class="thubnail-desc fix">
                <h3 class="product-header">{{$product->title}}</h3>
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
                <div class="pro-price mb-10">
                    <p>Ціна <b>{{$product->price}}</b> $ <br>
                    Стара ціна <b>{{$product->old_price}}</b> $</p>
                </div>
                <div class="pro-ref mb-15">
                    <p>
                        <span class="in-stock">в наявності </span>
                        <span class="badge badge-success">{{$product->in_stock}}</span>
                    </p>
                </div>

                <div class="row">
                    <div class="col-2">Ключові слова</div>
                    <div class="col-10">{{$product->keywords}}</div>
                </div>
                <div class="row">
                    <div class="col-2">Опис</div>
                    <div class="col-10">{{$product->description}}</div>
                </div>
                <div class="row">
                    <div class="col-2">Текст</div>
                    <div class="col-10">{{$product->content}}</div>
                </div>
            </div>
        </div>
    </div>

    <div class="card mt-3">
        <h3 class="card-header"><i class="fa fa-comment-o"></i> Детально</h3>
        <div class="card-body">
            <ul class="nav nav-tabs">
                <li class="nav-item ">
                    <a class="nav-link active" href="#tab-comments" data-toggle="tab">Відгуки</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#tab-additional" data-toggle="tab">Фільтри</a>
                </li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane border-right border-left p-3 active" id="tab-comments">
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
                <div class="tab-pane" id="tab-additional">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead class="thead-light">
                            <tr>
                                <th>Група атрибута</th>
                                <th>Значення</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($product->product_attributes as $product_attribute)
                            <tr>
                                <td>{{$product_attribute->filter->name}}</td>
                                <td>
                                    @if($attributes->firstWhere('id', '=', $product_attribute->filter->id))
                                        @foreach($attributes->firstWhere('id', '=', $product_attribute->filter->id)->allAttributes as $attr)
                                            @if($attr->id == $product_attribute->id)
                                                <span class="badge badge-primary">{{$product_attribute->value}}</span>
                                            @else
                                                <span class="badge badge-secondary">{{$attr->value}}</span>
                                            @endif
                                        @endforeach
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
