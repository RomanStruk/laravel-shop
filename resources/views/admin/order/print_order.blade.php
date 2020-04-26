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
    @foreach($order->products as $product)
        <tr>
            <td class="text-center">{{ $product->id }}</td>
            <td class="text-left">
                {{$product->title}}

            </td>
            <td class="text-left">{{$product->category->name}}</td>
            <td class="text-right">1</td>
            <td class="text-right">{{ $product->price }} {{config('shop.currency_short')}}</td>
            <td class="text-right">{{ $product->price }} {{config('shop.currency_short')}}</td>
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
</body>
</html>