<div class="card mt-4">
    <div class="card-body">
        <h5 class="card-title">Коментарі</h5>
        <table class="table table-hover">
            <thead>
            <tr>
                <th scope="col" class="col-4">To</th>
                <th scope="col" class="col-7">Text</th>
                <th scope="col" class="col-1">Оцінка</th>
            </tr>
            </thead>
            <tbody>
            @forelse($user->comments as $comment)
            <tr>
                <td>
                    <a href="{{route('admin.product.show', ['product' => $comment->product->id])}}">
                        {{$comment->product->title}}
                    </a>
                </td>
                <td>{{$comment->text}}</td>
                <td>{{$comment->rating}}</td>
            </tr>
            @empty
                <tr>
                    <td colspan="3">Нема коментарів</td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>
</div>
