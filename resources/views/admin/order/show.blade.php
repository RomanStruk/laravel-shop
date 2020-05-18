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
        'edit' => $order->isEditable() ? route('admin.order.edit', $order->id) : null,
        'delete' => route('admin.order.destroy', $order->id),
        ]
    ])
    <!-- Main content -->
    <section class="content">
        @include('admin.component.events')

        <div class="row">
            <div class="col-md-6 col-sm-12 col-lg-6">
                <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">
                                <i class="fa fa-shopping-cart"></i> Деталі замовлення
                            </h3>
                        </div>
                        <div class="card-body">
                            <div class="row pb-1 border-bottom">
                                <div class="col-auto">
                                    <button data-toggle="tooltip" title="" class="btn btn-info btn-xs" data-original-title="Store">
                                        <i class="fa fa-shopping-cart fa-fw"></i></button>
                                </div>
                                <div class="col-auto">
                                    Статус:
                                    @if ($order->status == $order::STATUS_PENDING)
                                        <div class="badge badge-warning">
                                            {{$order->getStatus($order->status)}}
                                        </div>
                                    @elseif ($order->status == $order::STATUS_PROCESSING or $order->status == $order::STATUS_COMPLETED)
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
                                <div class="col-auto">
                                    <button data-toggle="tooltip" title="" class="btn btn-info btn-xs"
                                            data-original-title="Date Added"><i class="fa fa-calendar fa-fw"></i></button>
                                </div>
                                <div class="col-auto">
                                    {{$order->created_at}}
                                </div>
                            </div>
                            <div class="row pb-1 pt-1 border-bottom">
                                <div class="col-auto">
                                    <button data-toggle="tooltip" title="" class="btn btn-info btn-xs"
                                            data-original-title="Payment Method"><i class="fa fa-credit-card fa-fw"></i></button>
                                </div>
                                <div class="col-auto">
                                    @if ($order->payment->method == \App\Payment::METHOD_RECEIPT)
                                        Готівкою при доставці
                                    @elseif ($order->payment->method == \App\Payment::METHOD_GOOGLE_PAY)
                                        Google Pay
                                        @if ($order->payment->isPaid())
                                            <div class="badge badge-success">(Оплачено)</div>
                                        @elseif (! $order->payment->isPaid())
                                            <div class="badge badge-danger">(Не оплачено)</div>
                                        @endif
                                    @elseif ($order->payment->method == \App\Payment::METHOD_CARD)
                                        Оплатита карткою Visa/Mastercard
                                        @if ($order->payment->isPaid())
                                            <div class="badge badge-success">(Оплачено)</div>
                                        @elseif (! $order->payment->isPaid())
                                            <div class="badge badge-danger">(Не оплачено)</div>
                                        @endif
                                    @endif
                                </div>
                            </div>
                            <div class="row pt-1">
                                <div class="col-auto">
                                    <button data-toggle="tooltip" title="" class="btn btn-info btn-xs"
                                            data-original-title="Shipping Method"><i class="fa fa-truck fa-fw"></i></button>
                                </div>
                                <div class="col-auto">
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
            </div>

            <div class="col-md-6 col-sm-12 col-lg-6">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title"><i class="fa fa-user"></i> Інформація про клієнта</h3>
                    </div>
                    <div class="card-body">
                        <div class="row pb-1 border-bottom">
                            <div class="col-auto">
                                <button data-toggle="tooltip" title="" class="btn btn-info btn-xs"
                                        data-original-title="Customer"><i class="fa fa-user fa-fw"></i></button>
                            </div>
                            <div class="col-auto">
                                <a href="{{route('admin.user.show', ['user' => $order->user->id])}}" target="_blank">
                                    {{$order->user->fullName}}
                                </a>
                            </div>
                        </div>
                        <div class="row pb-1 pt-1 border-bottom">
                            <div class="col-auto">
                                <button data-toggle="tooltip" title="" class="btn btn-info btn-xs"
                                        data-original-title="Customer Group"><i class="fa fa-users fa-fw"></i></button>
                            </div>
                            <div class="col-auto">{{$order->user->roles->implode('name')}}</div>
                        </div>
                        <div class="row pb-1 pt-1 border-bottom">
                            <div class="col-auto">
                                <button data-toggle="tooltip" title="" class="btn btn-info btn-xs" data-original-title="E-Mail">
                                    <i class="fa fa-envelope fa-fw"></i></button>
                            </div>
                            <div class="col-auto">
                                <a href="mailto:{{$order->user->email}}">{{$order->user->email}}</a>
                            </div>
                        </div>
                        <div class="row pt-1">
                            <div class="col-auto">
                                <button data-toggle="tooltip" title="" class="btn btn-info btn-xs"
                                        data-original-title="Telephone"><i class="fa fa-phone fa-fw"></i></button>
                            </div>
                            <div class="col-auto">{{$order->user->detail->phone}}</div>
                        </div>
                    </div>
                </div>
            </div>

            @include('admin.order.cards.order_detail_tables')
            @include('admin.order.cards.order_history')
        </div>
    </section>
@endsection
