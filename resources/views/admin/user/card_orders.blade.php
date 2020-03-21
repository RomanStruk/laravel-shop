<div class="card">
    <div class="card-body">
        <h5 class="card-title">Замовлення</h5>
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
                    <a href="{{route('admin.order.revision', ['id' =>$order->id])}}">{{$order->id}}</a>
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
