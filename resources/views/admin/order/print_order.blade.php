<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <title>PrintOrder</title>
</head>
<body class="p-5">
<h1>Рахунок-фактура #{{$order->id}}</h1>
<table class="table table-bordered">
    <thead class="">
    <tr>
        <th class="text-left">Деталі замовлення</th>
        <th>Користувач</th>
    </tr>
    </thead>
    <tbody>
    <tr>
        <td class="text-left col-5">
            <b>Дата створення</b> {{$order->created_at}}<br>
            <b>Індитифікатор</b>: {{$order->id}}<br>
            <b>Спосіб оплати</b>
            @if ($order->payment->method == 'receipt')
                Готівкою при доставці
            @elseif ($order->payment->method == 'google-pay')
                Google Pay
                @if ($order->payment->paid == '0')(Оплачено)@elseif ($order->payment->paid == '1')(Не оплачено)@endif
            @elseif ($order->payment->method == 'card')
                Оплатита карткою Visa/Mastercard
                @if ($order->payment->paid == '0')(Оплачено)@elseif ($order->payment->paid == '1')(Не оплачено)@endif
            @endif<br>
            <b>Спосіб доставки</b>
            @if ($order->shipping->method == 'courier')
                Кур'єр
            @elseif ($order->shipping->method == 'novaposhta')
                Самовивіз з Нової Пошти
            @else
                Помилка!
            @endif<br>
        </td>
        <td class="col-8">
            <b>Ім'я:</b> {{$order->user->fullName}}<br>
            <b>E-mail:</b> {{$order->user->email}}<br>
            <b>Телефон:</b> {{$order->user->detail->phone}}<br>
        </td>
    </tr>
    </tbody>
</table>

<table class="table table-bordered">
    <thead class="">
    <tr>
        <th class="text-left">Адреса доставки</th>
        <th>Коментар замовника</th>
    </tr>
    </thead>
    <tbody>
    <tr>
        <td class="text-left col-5">
            {{ $order->shipping->getCityTitle() }}
            <br>
            {{ $order->shipping->getAddressTitle() }}
        </td>
        <td class="col-8">{{$order->comment}}</td>
    </tr>
    </tbody>
</table>

<table class="table table-bordered">
    <thead class="">
    <tr>
        <th class="text-center">#id</th>
        <th class="text-left">Товар</th>
        <th class="text-left">Категорія</th>
        <th class="text-right">Quantity</th>
        <th class="text-right">Ціна за одиницю</th>
        <th class="text-right">Total</th>
    </tr>
    </thead>
    <tbody>
    @foreach($order->orderProducts as $orderProduct)
        <tr>
            <td class="text-center">{{ $orderProduct->product->id }}</td>
            <td class="text-left">
                {{$orderProduct->product->title}}

            </td>
            <td class="text-left">{{$orderProduct->product->category->name}}</td>
            <td class="text-right">{{$orderProduct->count}}</td>
            <td class="text-right">{{ $orderProduct->product->price }} {{config('shop.currency_short')}}</td>
            <td class="text-right">{{ $orderProduct->getTotalPriceForProduct() }} {{config('shop.currency_short')}}</td>
        </tr>
    @endforeach
    <tr>
        <td colspan="5" class="text-right">Sub-Total</td>
        <td class="text-right">{{$order->getSubTotalPrice()}} {{config('shop.currency_short')}}</td>
    </tr>
    <tr>
        <td colspan="5" class="text-right">Єдиний тариф доставки</td>
        <td class="text-right">{{ $order->shipping->shipping_rate }} {{config('shop.currency_short')}}</td>
    </tr>
    <tr>
        <td colspan="5" class="text-right">Total</td>
        <td class="text-right">{{$order->getTotalPrice()}} {{config('shop.currency_short')}}</td>
    </tr>
    </tbody>
</table>
</body>
</html>
