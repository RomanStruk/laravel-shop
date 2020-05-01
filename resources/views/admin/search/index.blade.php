@extends('admin.layouts.app')

@section('content')
    @include('admin.component.title_breadcrumbs', [
    'title' => 'Пошук',
    'breadcrumbs' => [
        'Пошук',
    ]])
    <!-- Main content -->
    <section class="content">
    @include('admin.component.events')
        <div class="row">
            <div class="col-6">
                @forelse($users as $user)
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">
                                <a href="{{route('admin.user.show', $user->id)}}">{{$user->fullName}}</a>
                            </h3>

                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                                </button>
                            </div>
                            <!-- /.card-tools -->
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <dl>
                                <dt>Email</dt>
                                <dd>{{$user->email}}</dd>
                                <dt>Телефон</dt>
                                <dd>{{$user->detail->phone}}</dd>
                                <dt>Зареєстрований</dt>
                                <dd>{{$user->created_at}}</dd>
                            </dl>
                        </div>
                        <!-- /.card-body -->
                    </div>
                @empty
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Користувачі</h3>

                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                                </button>
                            </div>
                            <!-- /.card-tools -->
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            Немає результатів
                        </div>
                        <!-- /.card-body -->
                    </div>
                @endforelse
            </div>


            <div class="col-6">
                @forelse($products as $product)
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">
                                <a href="{{route('admin.product.show', $product->id)}}">{{$product->title}}</a>
                            </h3>

                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                                </button>
                            </div>
                            <!-- /.card-tools -->
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <dl>
                                <dt>Опис</dt>
                                <dd>{{$product->description}}</dd>
                                <dt>Додано</dt>
                                <dd>{{$product->created_at}}</dd>
                                <dt>Ціна</dt>
                                <dd>{{$product->price}} {{config('shop.currency_short')}}</dd>
                            </dl>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    @empty
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Товари</h3>

                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                                    </button>
                                </div>
                                <!-- /.card-tools -->
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                Немає результатів
                            </div>
                            <!-- /.card-body -->
                        </div>
                    @endforelse
            </div>
        </div>
    </section>
@endsection