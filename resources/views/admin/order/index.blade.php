@extends('admin.layouts.app')

@section('content')
    @include('admin.component.title_breadcrumbs', [
        'title' => 'Список замовлень',
        'breadcrumbs' => [
            'Замовлення',
        ]
        ])
    @include('admin.component.sort', [
    'route' => route('admin.order.index'),
    'status' => \App\Order::listStatus(),
    'dateAdded' => true,
    'search' => true,
    'limit' => true
    ])

    @include('admin.component.events')

    <table class="table table-bordered table-hover">
        <thead>
        <tr>
            <td class="text-right">
                <a href="/admin/index.php?route=sale/order&amp;user_token=&amp;sort=o.order_id&amp;order=ASC"
                   class="desc">Order ID</a></td>
            <td class="text-left">
                <a href="#sort=customer&amp;order=ASC">Замовник</a>
            </td>
            <td class="text-left">
                <a href="/admin/index.php?route=sale/order&amp;sort=order_status&amp;order=ASC">Status</a>
            </td>
            <td class="text-right">
                <a href="https://demo.opencart.com/admin/index.php?route=sale/order&amp;sort=o.total&amp;order=ASC">Total</a>
            </td>
            <td class="text-left">
                <a href="https://demo.opencart.com/admin/index.php?route=sale/order&amp;sort=o.date_added&amp;order=ASC">Date
                    Added</a>
            </td>
            <td class="text-left">
                <a href="/admin/index.php?route=sale/order&amp;sort=o.date_modified&amp;order=ASC">Date
                    Modified</a>
            </td>
            <td class="text-right">Action</td>
        </tr>
        </thead>
        <tbody>
        @foreach($orders as $order)
            <tr>
                <td class="text-right">{{ $order->id }}</td>
                <td class="text-left">
                    <a href="{{route('admin.user.show', ['user' => $order->user->id])}}">
                        {{ $order->user->detail->first_name }} {{ $order->user->detail->last_name }}
                    </a>
                </td>
                <td class="text-left">{{$order->getStatus($order->detail_status)}}</td>
                <td class="text-right">{{$order->sum_price}}</td>
                <td class="text-left">{{ $order->created_at }}</td>
                <td class="text-left">{{ $order->updated_at }}</td>
                <td class="text-right">
                    @include('admin.component.dropdown_menu', [
                        'show' => route( 'admin.order.show', ['order' => $order->id]),
                        'edit' => route( 'admin.order.edit', ['order' => $order->id]),
                        'delete' => route( 'admin.order.destroy', ['order' => $order->id]),

                    ])
                </td>
            </tr>
        @endforeach

        </tbody>
    </table>

    {{ $orders->withQueryString()->links() }}
@endsection
