@extends('admin.layouts.app')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Dashboard v3</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Dashboard v3</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-header border-0">
                            <div class="d-flex justify-content-between">
                                <h3 class="card-title">Online Store Visitors</h3>
                                <a href="javascript:void(0);">View Report</a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="d-flex">
                                <p class="d-flex flex-column">
                                    <span class="text-bold text-lg">820</span>
                                    <span>Visitors Over Time</span>
                                </p>
                                <p class="ml-auto d-flex flex-column text-right">
                    <span class="text-success">
                      <i class="fas fa-arrow-up"></i> 12.5%
                    </span>
                                    <span class="text-muted">Since last week</span>
                                </p>
                            </div>
                            <!-- /.d-flex -->

                            <div class="position-relative mb-4">
                                <canvas id="visitors-chart" height="200"></canvas>
                            </div>

                            <div class="d-flex flex-row justify-content-end">
                  <span class="mr-2">
                    <i class="fas fa-square text-primary"></i> This Week
                  </span>

                                <span>
                    <i class="fas fa-square text-gray"></i> Last Week
                  </span>
                            </div>
                        </div>
                    </div>
                    <!-- /.card -->

                    <div class="card">
                        <div class="card-header border-0">
                            <h3 class="card-title">Популярні товари </h3>
                            <div class="card-tools">
                                <a href="#" class="btn btn-tool btn-sm">
                                    <i class="fas fa-download"></i>
                                </a>
                                <a href="#" class="btn btn-tool btn-sm">
                                    <i class="fas fa-bars"></i>
                                </a>
                            </div>
                        </div>
                        <div class="card-body table-responsive p-0">
                            <table class="table table-striped table-valign-middle">
                                <thead>
                                <tr>
                                    <th class="col-7">Товар</th>
                                    <th class="col-2">Ціна</th>
                                    <th class="col-3">Продажі</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($topList as $info)
                                    <tr>
                                        <td>
                                            <a href="{{route('admin.product.show', ['product' => $info['product']->id])}}">{{$info['product']->title}}</a>
                                        </td>
                                        <td>{{config('shop.currency_short')}}{{$info['product']->price}}</td>
                                        <td>
                                            {{$info['sales']}}
                                            @if($info['analytic'] < 5 and $info['analytic'] > -5)
                                                <small class="text-warning mr-1">
                                                    <i class="fas fa-arrow-down"></i>
                                                    {{$info['analytic']}}%
                                                </small>
                                            @endif
                                            @if($info['analytic'] > 5)
                                                <small class="text-success mr-1">
                                                    <i class="fas fa-arrow-up"></i>
                                                    {{$info['analytic']}}%
                                                </small>
                                            @endif
                                            @if($info['analytic'] < -5)
                                                <small class="text-danger mr-1">
                                                    <i class="fas fa-arrow-down"></i>
                                                    {{$info['analytic']}}%
                                                </small>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col-md-6 -->
                <div class="col-lg-6">
                    <!-- card -->
                    <sales-card currency_short="{{config('shop.currency_short')}}"></sales-card>
                    <!-- /.card -->


                    <div class="card">
                        <div class="card-header border-0">
                            <h3 class="card-title">Останні замовлення</h3>
                            <div class="card-tools">
                                <a href="#" class="btn btn-tool btn-sm">
                                    <i class="fas fa-download"></i>
                                </a>
                                <a href="#" class="btn btn-tool btn-sm">
                                    <i class="fas fa-bars"></i>
                                </a>
                            </div>
                        </div>
                        <div class="card-body table-responsive p-0">
                            <table class="table table-striped table-valign-middle">
                                <thead>
                                <tr>
                                    <th class="col-1">#</th>
                                    <th class="col-4">Користувач</th>
                                    <th class="col-2">Сума</th>
                                    <th class="col-4">Статус</th>
                                    <th class="col-1">Дія</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($orders as $order)
                                    <tr>
                                        <td>
                                            {{ $order->id }}
                                        </td>
                                        <td>
                                            <a href="{{route('admin.user.show', ['user' => $order->user->id])}}">
                                                {{ $order->user->fullName }}
                                            </a>
                                        </td>
                                        <td>{{$order->sum_price}} {{ config('shop.currency_short') }}</td>
                                        <td>

                                            @if ($order->status == $order::STATUS_PENDING)
                                                <span class="badge badge-warning">
                                                {{$order->getStatus($order->status)}}
                                            </span>
                                            @elseif ($order->status == $order::STATUS_PROCESSING or $order->status == $order::STATUS_COMPLETED)
                                                <span class="badge badge-success">
                                                {{$order->getStatus($order->status)}}
                                            </span>
                                            @else
                                                <span class="badge badge-danger">
                                                {{$order->getStatus($order->status)}}
                                            </span>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{route('admin.order.show', $order->id)}}"><i
                                                        class="fas fa-eye"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- /.col-md-6 -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- /.content -->
@endsection

@section('script')
    <script src="{{ mix('adm/js/dashboard.js')}}"></script>
@endsection