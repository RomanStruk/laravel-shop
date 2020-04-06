<div class="card">
    <div class="card-header">
        <h3 class="card-title">
            <i class="fas fa-credit-card"></i>
            Замовлення
        </h3>
    </div>
    <div class="card-body">
        <table class="table table-hover">
            <thead>
            <tr>
                <th scope="col" class="col-1">#</th>
                <th scope="col" class="col-7">Коментар</th>
                <th scope="col" class="col-2">Сума</th>
                <th scope="col" class="col-2">Дата</th>
            </tr>
            </thead>
            <tbody>
            @forelse($user->orders as $order)
            <tr>
                <th scope="row">
                    <a href="{{route('admin.order.show', ['order' =>$order->id])}}">{{$order->id}}</a>
                </th>
                <td>{{$order->comment}}</td>
                <td>{{$order->sum_price}} $</td>
                <td>{{$order->created_at}}</td>
            </tr>
            @empty
                <tr>
                    <td colspan="4">Нема замовлень</td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>
</div>
