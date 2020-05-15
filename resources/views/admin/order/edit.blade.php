@extends('admin.layouts.app')


@section('content')
    @include('admin.component.title_breadcrumbs', [
        'title' => 'Редагування замовлення',
        'breadcrumbs' => [
            'Замовлення' => route('admin.order.index'),
            'Перегляд' => route('admin.order.show', ['order' => $order->id]),
            'Редагувати',
        ],
        'actions' => [
            'delete' => route('admin.order.destroy',['order' => $order->id])
        ]])




    <!-- Main content -->
    <section class="content">
        @include('admin.component.events')
        <form action="{{route('admin.order.update', ['order' => $order->id])}}" method="post">
            @csrf
            @method('PATCH')

            <div class="row">
                <div class="col-md-6">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Профіль замовника</h3>

                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse"
                                        data-toggle="tooltip" title="Collapse">
                                    <i class="fas fa-minus"></i></button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="user-select2">Користувач</label>
                                <select name="user" id="user-select2" class="form-control">
                                    <option value="{{$order->user->id}}">{{$order->user->fullName}}</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="orderComment">Коментар замовника</label>
                                <textarea class="form-control" name="comment" id="orderComment" cols="30" rows="4">{{$order->comment}}</textarea>
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Спосіб оплати</h3>

                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse"
                                        data-toggle="tooltip" title="Collapse">
                                    <i class="fas fa-minus"></i></button>
                            </div>
                        </div>
                        <div class="card-body">
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
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <div class="col-md-6">
                    <div class="card card-secondary">
                        <div class="card-header">
                            <h3 class="card-title">Товари</h3>

                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse"
                                        data-toggle="tooltip" title="Collapse">
                                    <i class="fas fa-minus"></i></button>
                            </div>
                        </div>
                        <div class="card-body" id="card-for-append">
                            <div class="form-group row">
                            <div class="col-6">Товар</div><div class="col-4">Склад</div><div class="col-2">Кількість</div>
                            </div>
                        @foreach($order->orderProducts as $orderProduct)
                                <div class="form-group row">
                                <div class="col-6">
                                    <select name="products[{{$orderProduct->id}}][id]" class="form-control select2 product-select2" style="width: 100%;">
                                        <option value="{{$orderProduct->product->id}}" selected="selected">{{$orderProduct->product->title}}</option>
                                    </select>
                                </div>
                                <div class="col-4">
                                    <select name="products[{{$orderProduct->id}}][syllable]" id="syllable" class="form-control">
                                        @foreach($orderProduct->product->syllable as $syllable)
                                            <option value="{{$syllable->id}}"
                                            @if ($orderProduct->syllable_id == $syllable->id) selected @endif
                                            >{{$syllable->supplier->name}} ({{$syllable->remains - $syllable->countProcessed()}})</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-2">
                                    <input type="number" name="products[{{$orderProduct->id}}][count]" class="form-control" value="{{$orderProduct->count}}">
                                </div>
                            </div>
                            @endforeach
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <button class="btn btn-info btn-sm float-right" title="Add a new field" id="add-new-field"><i class="fa fa-plus"></i></button>
                        </div>
                    </div>
                    <!-- /.card -->
                    <div class="card card-info">
                        <div class="card-header">
                            <h3 class="card-title">Спосіб доставки</h3>

                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse"
                                        data-toggle="tooltip" title="Collapse">
                                    <i class="fas fa-minus"></i></button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="shipping-select2">Місто/Село</label>
                                <select name="city_code" id="shipping-select2" class="form-control" style="width: 100%">
                                    <option value="{{$order->shipping->getCity()->code}}" selected>{{$order->shipping->getCity()->description}}</option>
                                </select>
                            </div>

                            <div class="nav nav-tabs border-0 mb-3" role="tablist">
                                <p class=" m-1">Спосіб доставки:</p>
                                <div class="custom-control custom-radio m-1">
                                    <input type="radio" id="radio_courier" name="shipping_method" value="courier"
                                           data-target="#courier" class="custom-control-input"
                                           @if ($order->shipping->method == 'courier')checked @endif
                                    >
                                    <label for="radio_courier" class="custom-control-label">Курєр </label>
                                </div>
                                <div class="custom-control custom-radio m-1">
                                    <input type="radio" id="radio_novaposhta" name="shipping_method" value="novaposhta"
                                           data-target="#novaposhta" class="custom-control-input"
                                           @if ($order->shipping->method == 'novaposhta')checked @endif
                                    >
                                    <label for="radio_novaposhta" class="custom-control-label">Нова Пошта </label>
                                </div>

                            </div>
                            <div class="tab-content">
                                <div id="courier"
                                     @if ($order->shipping->method == 'courier') class="tab-pane active"
                                     @else class="tab-pane" @endif
                                >
                                    <div class="form-group">
                                        <label class="col-form-label">Адрес</label>
                                        <div class="form-row">
                                            <div class="input-group col-6">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">вул.</div>
                                                </div>
                                                <input name="street" type="text" class="form-control"
                                                       id="address_street" value="@if ($order->shipping->method == 'courier'){{explode(', ',$order->shipping->getAddress()->title)[0]}}@endif">
                                            </div>
                                            <div class="input-group col-3">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">буд.</div>
                                                </div>
                                                <input name="house" id="address_house"
                                                       value="@if ($order->shipping->method == 'courier'){{explode(', ',$order->shipping->getAddress()->title)[1]}}@endif"
                                                       type="text" class="form-control">
                                            </div>
                                            <div class="input-group col-3">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">кв.</div>
                                                </div>
                                                <input name="flat" id="address_flat" value="@if ($order->shipping->method == 'courier'){{explode(', ',$order->shipping->getAddress()->title)[2]}}@endif"
                                                       type="text" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div id="novaposhta"
                                     @if ($order->shipping->method == 'novaposhta') class="tab-pane active"
                                     @else class="tab-pane" @endif
                                >
                                    <div class="form-group">
                                        <label for="address-select2">Відділення</label>
                                        <select name="warehouse_code" id="address-select2" class="form-control" style="width: 100%">
                                            @if ($order->shipping->method == 'novaposhta')
                                                <option value="{{$order->shipping->getAddress()->code}}">{{$order->shipping->getAddress()->title}}</option>
                                            @endif
                                        </select>
                                    </div>
                                </div>

                            </div>
                            <div class="form-group">
                                <label for="shipping-rate">Вартість доставки </label>
                                <input type="number" name="shipping_rate" id="shipping-rate" value="{{$order->shipping->shipping_rate}}" class="form-control">
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <a href="" class="btn btn-secondary">Cancel</a>
                            <input type="submit" value="Save" class="btn btn-success float-right">
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </section>

@endsection

@section('script')
    <script src="{{ mix('adm/js/order-edit.js')}}"></script>
@endsection
