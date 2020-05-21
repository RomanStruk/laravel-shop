<div class="card">
    <div class="card-header">
        <h3 class="card-title">Відгуки</h3>
    </div>
    <div class="card-body">
        @forelse($product->comments as $comment)
            <div class="post">
                <div class="user-block">
                    <img class="img-circle img-bordered-sm" src="{{$comment->user->detail->avatar }}" alt="user image">
                    <span class="username">
                          <a href="{{route('admin.user.show',$comment->user)}}">{{$comment->user->fullName }}</a>
                          <a href="#" class="float-right btn-tool"><i class="fas fa-times"></i></a>
                        </span>
                    <span class="description">Shared publicly - {{$comment->created_at }}</span>
                </div>
                <!-- /.user-block -->
                <div class="rating-summary fix mtb-10">
                    <div class="rating f-left">
                        @for($i = 1; $i <= 5; $i++)
                            @if($i <= $comment->rating)
                                <i class="fa fa-star" style="color: #f9ba48;"></i>
                            @else
                                <i class="fa fa-star"></i>
                            @endif
                        @endfor
                    </div>
                </div>
                <p>{{$comment->text }}</p>
                <form class="form-horizontal">
                    <div class="input-group input-group-sm mb-0">
                        <input class="form-control form-control-sm" placeholder="Response">
                        <div class="input-group-append">
                            <button type="submit" class="btn btn-danger">Send</button>
                        </div>
                    </div>
                </form>
            </div>
        @empty
            <p>Нема даних</p>
        @endforelse
    </div>
</div>
