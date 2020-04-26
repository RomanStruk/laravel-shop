@extends('admin.layouts.app')

@section('content')
    @include('admin.component.title_breadcrumbs', [
    'title' => 'Перегляд замовлення #'.$order->id,
    'breadcrumbs' => [
        'Замовлення' => route('admin.order.index'),
        'Перегляд',
    ],
    'actions' => [
        'print' => route('admin.order.printOrder', $order->id),
        'edit' => route('admin.order.edit', $order->id),
        'delete' => route('admin.order.destroy', $order->id),
        ]
    ])
    <!-- Main content -->
    <section class="content">
        @include('admin.component.events')

        <div class="card-deck mb-2">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fa fa-shopping-cart"></i> Деталі замовлення
                    </h3>
                </div>
                <div class="card-body">
                    <div class="row pb-1 pt-1 border-bottom">
                        <div class="col-2">
                            <button data-toggle="tooltip" title="" class="btn btn-info btn-xs" data-original-title="Store">
                                <i class="fa fa-shopping-cart fa-fw"></i></button>
                        </div>
                        <div class="col-8">
                            Статус:
                            @if ($order->status == $order::STATUS_PENDING)
                                <div class="badge badge-warning">
                                    {{$order->getStatus($order->status)}}
                                </div>
                            @elseif ($order->status == $order::STATUS_CANCELED)
                                <div class="badge badge-danger">
                                    {{$order->getStatus($order->status)}}
                                </div>
                            @elseif ($order->status == $order::STATUS_PROCESSING)
                                <div class="badge badge-success">
                                    {{$order->getStatus($order->status)}}
                                </div>
                            @elseif ($order->status == $order::STATUS_COMPLETED)
                                <div class="badge badge-success">
                                    {{$order->getStatus($order->status)}}
                                </div>
                            @else
                                <div class="badge badge-danger">
                                    {{$order->getStatus($order->status)}}
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
                            @if ($order->payment->method == \App\Payment::METHOD_RECEIPT)
                                Готівкою при доставці
                            @elseif ($order->payment->method == \App\Payment::METHOD_GOOGLE_PAY)
                                Google Pay
                                @if ($order->payment->paid == '0')
                                    <div class="badge badge-success">(Оплачено)</div>
                                @elseif ($order->payment->paid == '1')
                                    <div class="badge badge-danger">(Не оплачено)</div>
                                @endif
                            @elseif ($order->payment->method == \App\Payment::METHOD_CARD)
                                Оплатита карткою Visa/Mastercard
                                @if ($order->payment->paid == '0')
                                    <div class="badge badge-success">(Оплачено)</div>
                                @elseif ($order->payment->paid == '1')
                                    <div class="badge badge-danger">(Не оплачено)</div>
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
                <div class="card-header">
                <h3 class="card-title"><i class="fa fa-user"></i> Інформація про клієнта</h3>
                </div>
                <div class="card-body">
                    <div class="row pb-1 pt-1 border-bottom">
                        <div class="col-2">
                            <button data-toggle="tooltip" title="" class="btn btn-info btn-xs"
                                    data-original-title="Customer"><i class="fa fa-user fa-fw"></i></button>
                        </div>
                        <div class="col-8">
                            <a href="{{route('admin.user.show', ['user' => $order->user->id])}}" target="_blank">
                                {{$order->user->fullName}}
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
                                <a href="{{route('admin.product.show', ['product' => $product->id])}}">{{$product->title}}</a>

                            </td>
                            <td class="text-left">{{$product->category->name}}</td>
                            <td class="text-right">{{$product->pivot->count}}</td>
                            <td class="text-right">{{ $product->price }} {{config('shop.currency_short')}}</td>
                            <td class="text-right">{{ $product->price * $product->pivot->count }} {{config('shop.currency_short')}}</td>
                        </tr>
                    @endforeach
                    <tr>
                        <td colspan="5" class="text-right">Sub-Total</td>
                        <td class="text-right">{{$order->sum_price}} {{config('shop.currency_short')}}</td>
                    </tr>
                    <tr>
                        <td colspan="5" class="text-right">Єдиний тариф доставки</td>
                        <td class="text-right">{{ $order->shipping->shipping_rate }} {{config('shop.currency_short')}}</td>
                    </tr>
                    <tr>
                        <td colspan="5" class="text-right">Total</td>
                        <td class="text-right">{{$order->total_price}} {{config('shop.currency_short')}}</td>
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
                                        <th class="text-left">Користувач</th>
                                        <th class="text-left">Коментарій</th>
                                        <th class="text-left">Дата</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($order->histories as $history)
                                        <tr @if ($loop->last)
                                            class="table-primary"
                                            @endif
                                        >
                                            <td class="text-left">
                                                @if ($history->status == $order::STATUS_PENDING)
                                                    <div class="badge badge-warning">
                                                        {{$order->getStatus($history->status)}}
                                                    </div>
                                                @elseif ($history->status == $order::STATUS_CANCELED)
                                                    <div class="badge badge-danger">
                                                        {{$order->getStatus($history->status)}}
                                                    </div>
                                                @elseif ($history->status == $order::STATUS_PROCESSING)
                                                    <div class="badge badge-success">
                                                        {{$order->getStatus($history->status)}}
                                                    </div>
                                                @elseif ($history->status == $order::STATUS_COMPLETED)
                                                    <div class="badge badge-success">
                                                        {{$order->getStatus($history->status)}}
                                                    </div>
                                                @else
                                                    <div class="badge badge-danger">
                                                        {{$order->getStatus($history->status)}}
                                                    </div>
                                                @endif
                                            </td>
                                            <td class="text-left">
                                                <a href="{{route('admin.user.show', $history->user->id)}}">{{$history->user->fullName}}</a>
                                            </td>
                                            <td class="text-left">{{$history->comment}}</td>
                                            <td class="text-left">{{$history->date_added}}</td>
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
                                    <label class="form-check-label" for="notification">Повідомити Замовника</label>
                                </div>
                                <div class="col-sm-2">
                                    <input type="checkbox" name="notification" id="notification" value="1">
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
    </section>
@endsection
