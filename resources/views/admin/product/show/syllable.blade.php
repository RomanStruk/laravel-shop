<div class="card">
    <div class="card-header">
        <h3 class="card-title">Склад</h3>
        <div class="card-tools">
            <!-- button with a dropdown -->
            <div class="btn-group">
                <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown" data-display="static" aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-bars"></i></button>
                <div class="dropdown-menu float-right dropdown-menu-lg-right" role="menu">
                    <a href="{{route('admin.syllable.create', ['product' =>$product->id])}}" class="dropdown-item">Додати поставку</a>
                    <a href="{{route('admin.supplier.create')}}" class="dropdown-item">Додати постачальника</a>
                    <div class="dropdown-divider"></div>
                    <a href="#" class="dropdown-item">View calendar</a>
                </div>
            </div>
            <button type="button" class="btn btn-default btn-sm" data-card-widget="collapse">
                <i class="fas fa-minus"></i>
            </button>
        </div>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-12">
                <ul>

                    @forelse($product->syllable as $syllable)
                        <li>
                            {{$syllable->supplier->name}}
                            <span class="badge badge-primary">{{$syllable->imported}}</span>
                            <span class="badge badge-success">{{$syllable->remains}}</span>
                            <span class="badge badge-info">{{$syllable->countAvailableRemains}}</span>
                            <span class="badge badge-warning">{{$syllable->countProcessed}}</span>
                            <a class="float-right btn-tool" href="{{route('admin.syllable.show', $syllable)}}"
                               title="Поставка"><i class="fas fa-shopping-bag"></i></a>
                            <a class="float-right btn-tool" href="{{route('admin.supplier.show', $syllable->supplier)}}"
                               title="Постачальник"><i class="fas fa-truck"></i></a>

                        </li>
                    @empty
                        <li>Нема даних</li>
                    @endforelse
                </ul>
                <span class="badge badge-primary">@lang('shop.imported')</span>
                <span class="badge badge-success">@lang('shop.remains')</span>
                <span class="badge badge-info">@lang('shop.available')</span>
                <span class="badge badge-warning">@lang('shop.processed')</span>
            </div>
        </div>
    </div>
</div>
