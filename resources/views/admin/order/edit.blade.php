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
                                <label for="first-name">Ім'я</label>
                                <input name="first_name" id="first-name" value="{{$order->user->detail->first_name}}"
                                       class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="last-name">Прізвище</label>
                                <input name="last_name" id="last-name" value="{{$order->user->detail->last_name}}"
                                       class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="input-telephone">Телефон</label>
                                <input name="phone" id="input-telephone" value="{{$order->user->detail->phone}}"
                                       class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="inputClientCompany">Email</label>
                                <input name="email" id="input-email" value="{{$order->user->email}}"
                                       class="form-control" disabled>
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
                        <div class="card-body">
                            <div class="form-group">
                                <label for="input-product">Товари</label>
                                <select name="products[]" class="form-control select2" data-dropdown-css-class="select2"
                                        style="width: 100%;" multiple id="input-product">
                                    @foreach($order->products as $product)
                                        <option value="{{$product->id}}"
                                                selected="selected">{{$product->title}}</option>

                                    @endforeach
                                    @foreach($products as $product)
                                        <option value="{{$product->id}}">{{$product->title}}</option>

                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="inputComment">Коментар замовника</label>
                                <textarea class="form-control" name="comment" id="orderComment" cols="30" rows="4">{{$order->comment}}</textarea>
                            </div>
                        </div>
                        <!-- /.card-body -->
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
                            <div class="form-group row">
                                <div class="col-sm-3">
                                    Спосіб доставки
                                </div>
                                <div class="col-sm-6">
                                    <div class="btn-group" data-toggle="buttons">
                                        <label class="">
                                            <a href="#address_currier" data-toggle="tab"
                                               @if ($order->shipping->method == 'courier') class="btn active focus"
                                               @else class="btn" @endif
                                            >
                                                <input type="radio" name="shipping_method" autocomplete="off"
                                                       value="courier"
                                                       @if ($order->shipping->method == 'courier')checked @endif
                                                >Курєр
                                            </a>
                                        </label>
                                        <label class="">
                                            <a href="#address_novaposhta" data-toggle="tab"
                                               @if ($order->shipping->method == 'novaposhta') class="btn active focus"
                                               @else class="btn" @endif
                                            >
                                                <input type="radio" name="shipping_method" autocomplete="off"
                                                       value="novaposhta"
                                                       @if ($order->shipping->method == 'novaposhta')checked @endif
                                                >Нова Пошта
                                            </a>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                    <label class="col-form-label" for="city">Місто/Село</label>
                                    <shipping
                                        v-bind:props_city_ref="'{{$order->shipping->city_ref}}'"
                                        v-bind:props_city="'{{$order->shipping->city}}'"
                                    ></shipping>
                            </div>
                            <div class="tab-content">
                                <div id="address_currier"
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
                                                       id="address_street" value="{{$order->shipping->street}}">
                                            </div>
                                            <div class="input-group col-3">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">буд.</div>
                                                </div>
                                                <input name="house" id="address_house"
                                                       value="{{$order->shipping->house}}"
                                                       type="text" class="form-control">
                                            </div>
                                            <div class="input-group col-3">
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
                                     @if ($order->shipping->method == 'novaposhta') class="tab-pane active"
                                     @else class="tab-pane" @endif
                                >
                                    <div class="form-group row ">
                                        <div class="col-sm-3">
                                            <label class="col-form-label" for="warehouse">Відділення</label>
                                        </div>
                                        <div class="col-sm-9">
                                            <warehouse
                                                v-bind:warehouse_ref="'{{$order->shipping->warehouse_ref}}'"
                                            ></warehouse>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-5">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <a href="" class="btn btn-secondary">Cancel</a>
                    <input type="submit" value="Save Changes" class="btn btn-success float-right">
                </div>
            </div>
        </form>
    </section>

@endsection

@section('script')
    <script src="{{ mix('adm/js/order-edit.js')}}"></script>
@endsection