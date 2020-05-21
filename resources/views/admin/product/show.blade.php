@extends('admin.layouts.app')

@section('script')
    <script src="{{ mix('adm/js/product.js')}}"></script>
@endsection

@section('content')
    @include('admin.component.title_breadcrumbs', [
        'title' => 'Перегляд товару #'.$product->id,
        'breadcrumbs' => [
            'Товари' => route('admin.product.index'),
            'Перегляд',
        ],
    'actions' => [
        'edit' => route('admin.product.edit',['product' => $product->id]),
        'delete' => route('admin.product.destroy',['product' => $product->id])]
     ])
    <!-- Main content -->
    <section class="content">
        @include('admin.component.events')

        <div class="row pb-2 mb-3 border-bottom justify-content-md-center">
            <div class="col-md-auto col-sm-6 col-12">
                <div class="info-box bg-gradient-info">
                    <span class="info-box-icon"><i class="fas fa-shopping-cart"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Загальний обсяг продажів</span>
                        <span class="info-box-number">{{$soldProductsOverTime}}</span>

                        <div class="progress">
                            <div class="progress-bar" style="width: {{$progress}}%"></div>
                        </div>
                        <span class="progress-description">
                      {{$progress}}% за місяць
                    </span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <div class="col-md-auto col-sm-6 col-12">
                <div class="info-box bg-gradient-success">
                    <span class="info-box-icon"><i class="far fa-thumbs-up"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Популярність</span>
                        <span class="info-box-number">41,410</span>

                        <div class="progress">
                            <div class="progress-bar" style="width: 70%"></div>
                        </div>
                        <span class="progress-description">
                      70% Increase in 30 Days
                    </span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <div class="col-md-auto col-sm-6 col-12">
                <div class="info-box bg-gradient-warning">
                    <span class="info-box-icon"><i class="far fa-address-card"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Прогноз к-сті продажів</span>
                        <span class="info-box-number">41,410</span>

                        <div class="progress">
                            <div class="progress-bar" style="width: 70%"></div>
                        </div>
                        <span class="progress-description">
                      70% Increase in 30 Days
                    </span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                @include('admin.product.show.main')
                @include('admin.product.show.media')

            </div>
            <div class="col-md-6">
                @include('admin.product.show.syllable')
                @include('admin.product.show.filters')
                @include('admin.product.show.related')
                @include('admin.product.show.comments')
            </div>
            <div class="col-md-12">
                @include('admin.product.show.content')
            </div>
        </div>
    </section>
@endsection
