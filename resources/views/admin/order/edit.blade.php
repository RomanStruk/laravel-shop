@extends('admin.layouts.app')

@section('content')
    <h1>Редагування замовлення</h1>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/">Домашня</a></li>
            <li class="breadcrumb-item"><a href="{{route('admin.order.revision', ['id' => $order->id])}}">Замовлення</a></li>
            <li class="breadcrumb-item active" aria-current="page">Редагувати</li>
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

    <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" id="profile-tab" data-toggle="tab" href="#profile" role="tab"
               aria-controls="home" aria-selected="true">
                Профіль замовника
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="products-tab" data-toggle="tab" href="#products" role="tab" aria-controls="profile"
               aria-selected="false">
                Товари
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="shipping-tab" data-toggle="tab" href="#shipping" role="tab" aria-controls="contact"
               aria-selected="false">
                Доставка
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" id="pay-tab" data-toggle="tab" href="#pay" role="tab" aria-controls="contact"
               aria-selected="false">
                Оплата
            </a>
        </li>
    </ul>
    <form action="{{route('admin.order.update', ['order' => $order->id])}}" method="post">
        @csrf
        <div class="tab-content p-3 border-left border-right border-bottom mb-2" id="myTabContent">
            <div class="tab-pane fade show active" id="profile" role="tabpanel" aria-labelledby="home-tab">
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label" for="first-name">Ім'я</label>
                    <div class="col-sm-10">
                        <input name="first_name" id="first-name" value="{{$order->user->detail->first_name}}"
                               class="form-control">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label" for="last-name">Прізвище</label>
                    <div class="col-sm-10">
                        <input name="last_name" id="last-name" value="{{$order->user->detail->last_name}}"
                               class="form-control">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label" for="input-telephone">Телефон</label>
                    <div class="col-sm-10">
                        <input name="phone" id="input-telephone" value="{{$order->user->detail->phone}}"
                               class="form-control">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label" for="input-email">Email</label>
                    <div class="col-sm-10">
                        <input name="email" id="input-email" value="{{$order->user->email}}" class="form-control" disabled>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="products" role="tabpanel" aria-labelledby="profile-tab">
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label" for="input-product">
                        Товари
                    </label>
                    <div class="col-sm-10">
{{--                        <input type="text" placeholder="Продукти" id="input-product" class="form-control" autocomplete="off">--}}
{{--                        <ul class="dropdown-menu"></ul>--}}

                            <select id="input-product" class="custom-select well well-sm" size="6" name="products[]" multiple>
                                @foreach($order->products as $product)
                                    <option value="{{$product->id}}" selected="selected">{{$product->title}}</option>
                                @endforeach
                            </select>
                        <small>
                            Виберіть товари зі списку які зберегти через Ctrl
                        </small>
                        {{--<div id="product-list" class="well well-sm" style="height: 150px; overflow: auto;">
                                <div id="product20">
                                    <i class="fa fa-minus-circle"></i>texy
                                    <input type="hidden" name="products[]" value="">
                                </div>
                        </div>--}}
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="shipping" role="tabpanel" aria-labelledby="contact-tab">
                <div class="form-group row">
                    <div class="col-sm-3">
                        Спосіб доставки
                    </div>
                    <div class="col-sm-6">
                        <div class="btn-group" data-toggle="buttons">
                            <label class="">
                                <a href="#address_currier" data-toggle="tab"
                                    @if ($order->shipping->method == 'courier') class="btn active focus" @else class="btn" @endif
                                >
                                    <input type="radio" name="shipping_method" autocomplete="off" value="courier"
                                           @if ($order->shipping->method == 'courier')checked  @endif
                                    >Курєр
                                </a>
                            </label>
                            <label class="">
                                <a href="#address_novaposhta" data-toggle="tab"
                                   @if ($order->shipping->method == 'novaposhta') class="btn active focus" @else class="btn"  @endif
                                >
                                    <input type="radio" name="shipping_method" autocomplete="off" value="novaposhta"
                                           @if ($order->shipping->method == 'novaposhta')checked  @endif
                                    >Нова Пошта
                                </a>
                            </label>
                        </div>
                        {{--<div class="form-check">
                            <input id="method-shipping-c" type="radio" name="method" value="courier"
                                   class="form-check-input">
                            <label for="method-shipping-c" class="form-check-label">Курєр</label>
                        </div>
                        <div class="form-check">
                            <input id="method-shipping-n" type="radio" name="method" value="novaposhta"
                                   class="form-check-input">
                            <label for="method-shipping-n" class="form-check-label">Нова Пошта</label>
                        </div>--}}
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-3">
                        <label class="col-form-label" for="city">Місто/Село</label>
                    </div>
                    <div class="col-sm-9">
                        <input name="city_ref" id="city" value="{{$order->shipping->city_ref}}" class="form-control" list="cities" autocomplete="no">
                        <small id="passwordHelpInline" class="text-muted">
                            {{$order->shipping->city}}, {{$order->shipping->area}}, {{$order->shipping->region}}
                        </small>
                    </div>
                </div>
                <div class="tab-content">
                    <div id="address_currier"
                         @if ($order->shipping->method == 'courier') class="tab-pane active" @else class="tab-pane" @endif
                    >
                        <div class="form-group row" >
                            <div class="col-sm-3">
                                <label class="col-form-label" for="address_street">Вулиця/</label>
                                <label class="col-form-label" for="address_house">Будинок/</label>
                                <label class="col-form-label" for="address_flat">Квартира</label>
                            </div>
                            <div class="col-sm-5">
                                <div class="input-group mb-2 mr-sm-2">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">вул.</div>
                                </div>
                                <input name="street" type="text" class="form-control" id="address_street" value="{{$order->shipping->street}}">
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <div class="input-group mb-2 mr-sm-2">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">буд.</div>
                                    </div>
                                    <input name="house" id="address_house" value="{{$order->shipping->house}}"
                                       type="text" class="form-control">
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <div class="input-group mb-2 mr-sm-2">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">кв.</div>
                                    </div>
                                <input name="flat" id="address_flat" value="{{$order->shipping->flat}}"
                                       type="text" class="form-control">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="address_novaposhta"
                         @if ($order->shipping->method == 'novaposhta') class="tab-pane active" @else class="tab-pane" @endif
                    >
                        <div class="form-group row ">
                            <div class="col-sm-3">
                                <label class="col-form-label" for="warehouse">Відділення</label>
                            </div>
                            <div class="col-sm-9">
                                <select name="warehouse_ref" id="warehouse" class="form-control">
                                    <option>--Не вибрано відділення--</option>
                                    @foreach($warehouses as $key => $warehouse)
                                    <option value="{{$key}}"
                                    @if ($key == $order->shipping->warehouse_ref) selected="selected" @endif
                                    >
                                        {{$warehouse}}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="tab-pane fade" id="pay" role="tabpanel" aria-labelledby="contact-tab">
                <div class="form-group row">
                    <div class="col-sm-3">
                        Спосіб оплати
                    </div>
                    <div class="col-sm-6">
                        <div class="form-check">
                            <input id="method-on_place" type="radio" name="method_pay" value="receipt"
                                   class="form-check-input"
                                   @if ($order->payment->method == 'receipt') checked @endif
                            >
                            <label for="method-on_place" class="form-check-label">Оплата при отриманні
                                замовлення</label>
                        </div>
                        <div class="form-check">
                            <input id="method-google_pay" type="radio" name="method_pay" value="google-pay"
                                   class="form-check-input"
                                   @if ($order->payment->method == 'google-pay') checked @endif
                            >
                            <label for="method-google_pay" class="form-check-label">Google Pay </label>
                        </div>
                        <div class="form-check">
                            <input id="method-credit_card" type="radio" name="method_pay" value="card"
                                   class="form-check-input"
                                   @if ($order->payment->method == 'card') checked @endif
                            >
                            <label for="method-credit_card" class="form-check-label">Оплатити зараз карткою
                                Visa/Mastercard</label>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-3">
                        Оплачено
                    </div>
                    <div class="col-sm-6">
                        <div class="form-check form-check-inline">
                            <input id="pay-status-yes" type="radio" name="paid" value="1"
                                   class="form-check-input"
                                @if ($order->payment->paid) checked @endif
                            >
                            <label for="pay-status-yes" class="form-check-label">Так</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input id="pay-status-no" type="radio" name="paid" value="0"
                                   class="form-check-input"
                                   @if (!$order->payment->paid) checked @endif
                            >
                            <label for="pay-status-no" class="form-check-label">Ні</label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-sm-12">
                <div class="text-right">
                    <button type="submit" class="btn btn-primary">
                        Save
                    </button>
                </div>

            </div>
        </div>
    </form>


@endsection
