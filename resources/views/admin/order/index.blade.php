@extends('admin.layouts.app')

@section('content')

    <!-- Content Header (Page header) -->
    @include('admin.component.title_breadcrumbs', [
        'title' => 'Список замовлень',
        'breadcrumbs' => [
            'Замовлення',
        ],
        'actions' => [
            'create' => route('admin.order.create')
            ]
        ])
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        @include('admin.component.events')
        @include('admin.component.sort', [
        'route' => route('admin.order.index'),
        'status' => \App\Order::listStatus(),
        'dateAdded' => true,
        'search' => true,
        'limit' => true
        ])
        <div class="card card-solid">
            <div class="card-body p-0">
                        <table class="table table-striped projects">
                            <thead>
                            <tr>
                                <th class="text-right">#</th>
                                <th class="text-left">Замовник</th>
                                <th class="text-left">Total</th>
                                <th class="text-left">Date Modified</th>
                                <th class="text-center">Status</th>
                                <th class="text-center" >Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($orders as $order)
                                <tr>
                                    <td class="text-right">{{ $order->id }}</td>
                                    <td class="text-left">
                                        <a href="{{route('admin.user.show', ['user' => $order->user->id])}}">
                                            {{ $order->user->fullName }}
                                        </a>
                                        <br>
                                        <small>
                                            Created {{ $order->created_at->format('d.M.Y h:m') }}
                                        </small>
                                    </td>
                                    <td class="text-left">{{$order->sum_price}} {{ config('shop.currency_short') }}</td>
                                    <td class="text-left">{{ $order->updated_at->format('j F Yр. h:m') }}</td>
                                    <td class="project-state">

                                        @if ($order->status == $order::STATUS_PENDING)
                                            <span class="badge badge-warning">
                                                {{$order->getStatus($order->status)}}
                                            </span>
                                        @elseif ($order->status == $order::STATUS_PROCESSING or $order->status == $order::STATUS_COMPLETED)
                                            <span class="badge badge-success">
                                                {{$order->getStatus($order->status)}}
                                            </span>
                                        @else
                                            <span class="badge badge-danger">
                                                {{$order->getStatus($order->status)}}
                                            </span>
                                        @endif

                                    </td>
                                    <td class="project-actions text-right" >
                                        @include('admin.component.dropdown_menu', [
                                            'show' => route( 'admin.order.show', ['order' => $order->id]),
                                            'edit' => $order->isEditable()? route( 'admin.order.edit', ['order' => $order->id]): null,
                                            'delete' => route( 'admin.order.destroy', ['order' => $order->id]),

                                        ])
                                    </td>
                                </tr>
                            @endforeach

                            </tbody>
                        </table>

                <div class="row p-3">
                    <div class="col-sm-12 col-md-5">
                        Showing {{$orders->firstItem()}} to {{$orders->lastItem()}} of {{$orders->total()}} entries
                    </div>
                    <div class="col-sm-12 col-md-7">
                        <div class="float-right">
                            {{ $orders->withQueryString()->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>
@endsection
