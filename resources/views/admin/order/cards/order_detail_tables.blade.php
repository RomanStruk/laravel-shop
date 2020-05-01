<div class="col-sm-12 col-md-12">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title"><i class="fa fa-info-circle"></i> Order (#{{$order->id}})</h3>
        </div>
        <div class="card-body">
            <div class="table-responsive">
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
                            {{ $order->shipping->getCityTitle() }}
                            <br>
                            {{ $order->shipping->getAddressTitle() }}
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
                        <td class="text-right">{{ $order->getTotalPriceForProduct($product->id) }} {{config('shop.currency_short')}}</td>
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
            </div>
        </div>
    </div>
</div>