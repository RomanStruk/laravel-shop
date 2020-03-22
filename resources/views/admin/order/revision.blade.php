@extends('admin.layouts.app')

@section('content')
    <h1>Перегляд замовлення #{{$order->id}}</h1>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/admin">Домашня</a></li>
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
    <div class="card-deck mb-2">
        <div class="card">
            <h5 class="card-header">
                <i class="fa fa-shopping-cart"></i> Деталі замовлення
            </h5>
            <div class="card-body">
                <div class="row pb-1 pt-1 border-bottom">
                    <div class="col-2">
                        <button data-toggle="tooltip" title="" class="btn btn-info btn-xs" data-original-title="Store">
                            <i class="fa fa-shopping-cart fa-fw"></i></button>
                    </div>
                    <div class="col-8">
                        @if ($order->detail_status == $order::STATUS_PENDING)
                            <div class="text-dark font-weight-bold bg-warning">
                                {{$order->getStatus($order->detail_status)}}
                            </div>
                        @elseif ($order->detail_status == $order::STATUS_CANCELED)
                            <div class="text-light font-weight-bold bg-danger">
                                {{$order->getStatus($order->detail_status)}}
                            </div>
                        @elseif ($order->detail_status == $order::STATUS_PROCESSING)
                            <div class="text-light font-weight-bold bg-success">
                                {{$order->getStatus($order->detail_status)}}
                            </div>
                        @elseif ($order->detail_status == $order::STATUS_COMPLETED)
                            <div class="text-light font-weight-bold bg-success">
                                {{$order->getStatus($order->detail_status)}}
                            </div>
                        @endif
                    </div>
                </div>
                <div class="row pb-1 pt-1 border-bottom">
                    <div class="col-2">
                        <button data-toggle="tooltip" title="" class="btn btn-info btn-xs"
                                data-original-title="Date Added"><i class="fa fa-calendar fa-fw"></i></button>
                    </div>
                    <div class="col-8">
                        {{$order->created_at}}
                    </div>
                </div>
                <div class="row pb-1 pt-1 border-bottom">
                    <div class="col-2">
                        <button data-toggle="tooltip" title="" class="btn btn-info btn-xs"
                                data-original-title="Payment Method"><i class="fa fa-credit-card fa-fw"></i></button>
                    </div>
                    <div class="col-8">
                        @if ($order->payment->method == 'receipt')
                            Готівкою при доставці
                        @elseif ($order->payment->method == 'google-pay')
                            Google Pay
                            @if ($order->payment->paid == '0')
                                <div class="bg-success">(Оплачено)</div>
                            @elseif ($order->payment->paid == '1')
                                <div class="bg-danger">(Не оплачено)</div>
                            @endif
                        @elseif ($order->payment->method == 'card')
                            Оплатита карткою Visa/Mastercard
                            @if ($order->payment->paid == '0')
                                <div class="bg-success">(Оплачено)</div>
                            @elseif ($order->payment->paid == '1')
                                <div class="bg-danger">(Не оплачено)</div>
                            @endif
                        @endif
                    </div>
                </div>
                <div class="row pt-1">
                    <div class="col-2">
                        <button data-toggle="tooltip" title="" class="btn btn-info btn-xs"
                                data-original-title="Shipping Method"><i class="fa fa-truck fa-fw"></i></button>
                    </div>
                    <div class="col-8">
                        @if ($order->shipping->method == 'courier')
                            Кур'єр
                        @elseif ($order->shipping->method == 'novaposhta')
                            Самовивіз з Нової Пошти
                        @else
                            Помилка!
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <div class="card">
            <h5 class="card-header"><i class="fa fa-user"></i> Інформація про клієнта</h5>
            <div class="card-body">
                <div class="row pb-1 pt-1 border-bottom">
                    <div class="col-2">
                        <button data-toggle="tooltip" title="" class="btn btn-info btn-xs"
                                data-original-title="Customer"><i class="fa fa-user fa-fw"></i></button>
                    </div>
                    <div class="col-8">
                        <a href="{{route('admin.show.index', ['id' => $order->user->id])}}" target="_blank">
                            {{$order->user->detail->first_name}} {{$order->user->detail->last_name}}
                        </a>
                    </div>
                </div>
                <div class="row pb-1 pt-1 border-bottom">
                    <div class="col-2">
                        <button data-toggle="tooltip" title="" class="btn btn-info btn-xs"
                                data-original-title="Customer Group"><i class="fa fa-group fa-fw"></i></button>
                    </div>
                    <div class="col-8">Default</div>
                </div>
                <div class="row pb-1 pt-1 border-bottom">
                    <div class="col-2">
                        <button data-toggle="tooltip" title="" class="btn btn-info btn-xs" data-original-title="E-Mail">
                            <i class="fa fa-envelope-o fa-fw"></i></button>
                    </div>
                    <div class="col-8">
                        <a href="mailto:{{$order->user->email}}">{{$order->user->email}}</a>
                    </div>
                </div>
                <div class="row pb-1 pt-1 border-bottom">
                    <div class="col-2">
                        <button data-toggle="tooltip" title="" class="btn btn-info btn-xs"
                                data-original-title="Telephone"><i class="fa fa-phone fa-fw"></i></button>
                    </div>
                    <div class="col-8">{{$order->user->detail->phone}}</div>
                </div>
            </div>
        </div>
        <div class="card">
            <h5 class="card-header"><i class="fa fa-cog"></i> Options</h5>
            <div class="card-body">
                <div class="row pb-1 pt-1 border-bottom">
                    <div class="col-6">
                        <a href="{{route('admin.order.edit', ['id' => $order->id])}}">Редагувати</a>
                    </div>
                    <div class="col-3"></div>
                    <div class="col-2">
                        <button id="button-invoice" data-loading-text="Loading..." data-toggle="tooltip" title=""
                                class="btn btn-success btn-xs" data-original-title="Generate"><i class="fa fa-cog"></i>
                        </button>
                    </div>
                </div>
                <div class="row pb-1 pt-1 border-bottom">
                    <div class="col-6">
                        <form method="POST" action="{{route('admin.order.destroy', ['order' => $order->id])}}">
                            @csrf
                            @method('DELETE')
                            <button class="dropdown-item" value="submit" type="submit">Delete</button>
                        </form>
                    </div>
                    <div class="col-3">300</div>
                    <div class="col-2">
                        <button id="button-reward-add" data-loading-text="Loading..." data-toggle="tooltip" title=""
                                class="btn btn-success btn-xs" data-original-title="Add Reward Points"><i
                                class="fa fa-plus-circle"></i></button>
                    </div>
                </div>
                <div class="row pb-1 pt-1 border-bottom">
                    <div class="col-6">Affiliate</div>
                    <div class="col-3">$0.00</div>
                    <div class="col-2">
                        <button disabled="disabled" class="btn btn-success btn-xs"><i class="fa fa-plus-circle"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card mt-3">
        <h3 class="card-header"><i class="fa fa-info-circle"></i> Order (#{{$order->id}})</h3>
        <div class="card-body">
            <table class="table table-bordered">
                <thead class="thead-light">
                <tr>
                    <th class="text-left">Адреса доставки</th>
                    <th>Коментар замовника</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td class="text-left col-5">
                        {{ $order->shipping->city }},
                        {{ $order->shipping->region }},
                        {{ $order->shipping->area }}
                        <br>
                        @if($order->shipping->method == 'courier')
                            {{ $order->shipping->street }},
                            {{ $order->shipping->house }},
                            {{ $order->shipping->flat }}
                        @elseif($order->shipping->method == 'novaposhta')
                            {{ $order->shipping->warehouse_title }}
                        @endif
                    </td>
                    <td class="col-8">{{$order->comment}}</td>
                </tr>
                </tbody>
            </table>

            <table class="table table-bordered">
                <thead class="thead-light">
                <tr>
                    <th class="text-center">#id</th>
                    <th class="text-left">Product</th>
                    <th class="text-left">Категорія</th>
                    <th class="text-right">Quantity</th>
                    <th class="text-right">Ціна за одиницю</th>
                    <th class="text-right">Total</th>
                </tr>
                </thead>
                <tbody>
                @foreach($order->products as $product)
                    <tr>
                        <td class="text-center">{{ $product->id }}</td>
                        <td class="text-left">
                            <a href="/admin/index.php?route=catalog/product/edit&amp;product_id=47">{{$product->title}}</a>

                        </td>
                        <td class="text-left">{{$product->category->name}}</td>
                        <td class="text-right">1</td>
                        <td class="text-right">{{ $product->price }}</td>
                        <td class="text-right">{{ $product->price }}</td>
                    </tr>
                @endforeach
                <tr>
                    <td colspan="5" class="text-right">Sub-Total</td>
                    <td class="text-right">{{$order->sum_price}}</td>
                </tr>
                <tr>
                    <td colspan="5" class="text-right">Єдиний тариф доставки</td>
                    <td class="text-right">{{ $order->shipping->shipping_rate }}</td>
                </tr>
                <tr>
                    <td colspan="5" class="text-right">Total</td>
                    <td class="text-right">{{$order->total_price}}</td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
    <div class="card mt-3">
        <h3 class="card-header"><i class="fa fa-comment-o"></i> Історія Замовленя</h3>
        <div class="card-body">
            <ul class="nav nav-tabs">
                <li class="nav-item ">
                    <a class="nav-link active" href="#tab-history" data-toggle="tab">Історія</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#tab-additional" data-toggle="tab">Додатково</a>
                </li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane border-right border-left p-3 active" id="tab-history">
                    <div id="history">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead class="thead-light">
                                <tr>
                                    <th class="text-left">Статус</th>
                                    <th class="text-left">Коментарій</th>
                                    <th class="text-left">Дата</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($order->details as $detail)
                                    <tr @if ($loop->last)
                                        class="table-primary"
                                        @endif
                                    >
                                        <td class="text-left">{{$order->getStatus($detail->status)}}</td>
                                        <td class="text-left">{{$detail->comment}}</td>
                                        <td class="text-left">{{$detail->date_added}}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <br>
                    <h4>Додати історію замовлень</h4>
                    <form action="{{route('admin.order.updateStatus', ['order' => $order->id])}}" method="post">
                        @csrf
                        <div class="form-group row">
                            <label for="input-order-status" class="col-sm-2 col-form-label">Статус замовлення</label>
                            <div class="col-sm-10">
                                <select name="status" id="input-order-status" class="form-control">
                                    @foreach($order::listStatus() as $key => $status)
                                        <option value="{{$key}}"
                                        @if ($key == $order->detail_status) selected="selected" @endif
                                        >{{$status}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-2">
                                <label class="form-check-label" for="gridCheck2">Повідомити Замовника</label>
                            </div>
                            <div class="col-sm-2">
                                <select name="send_mail" id="gridCheck2" class="form-control">
                                    <option value="0" selected>Ні</option>
                                    <option value="1">Так</option>
                                </select>
                            </div>
                            <div class="col-sm-8"></div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-2"><label for="input-comment">Коментар</label></div>
                            <div class="col-sm-10">
                                <textarea name="comment" rows="5" id="input-comment" class="form-control"></textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-10">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-plus-circle"></i> Add History
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="tab-pane" id="tab-additional">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <td colspan="2">Browser</td>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>IP Address</td>
                                <td>162.158.165.174</td>
                            </tr>
                            <tr>
                                <td>Forwarded IP</td>
                                <td>45.251.33.66</td>
                            </tr>
                            <tr>
                                <td>User Agent</td>
                                <td>Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko)
                                    Chrome/63.0.3235.0 Safari/537.36
                                </td>
                            </tr>
                            <tr>
                                <td>Accept Language</td>
                                <td>en-US,en;q=0.9</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
