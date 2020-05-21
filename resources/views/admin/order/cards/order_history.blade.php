<div class="col-sm-12 col-md-6">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Історія Замовленя</h3>
        </div>
        <div class="card-body">

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
                                @elseif ($history->status == $order::STATUS_PROCESSING or $history->status == $order::STATUS_COMPLETED)
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
    </div>
</div>
<div class="col-sm-12 col-md-6">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Додати історію замовлень</h3>
        </div>
        <form action="{{route('admin.order.updateStatus', ['order' => $order->id])}}" method="post">
            <div class="card-body">
                @csrf
                <div class="form-group">
                    <label for="input-order-status">Статус замовлення</label>
                    <select name="status" id="input-order-status" class="form-control">
                        @foreach($order->availableListStatus() as $key => $status)
                            <option value="{{$key}}"
                                    @if ($key == $order->status) selected="selected" @endif
                            >{{$status}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" name="notification" id="notification" value="1" class="custom-control-input">
                        <label for="notification" class="custom-control-label">Повідомити Замовника</label>
                    </div>
                </div>
                <div class="form-group">
                    <label for="input-comment">Коментар</label>
                    <textarea name="comment" rows="5" id="input-comment" class="form-control"></textarea>
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary"><i class="fa fa-plus-circle"></i> Add History</button>
            </div>
    </form>
    </div>
</div>
