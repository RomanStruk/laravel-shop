@extends('admin.layouts.app')


@section('content')
    @include('admin.component.title_breadcrumbs', [
        'title' => 'Додати замовлення',
        'breadcrumbs' => [
            'Замовлення' => route('admin.order.index'),
            'Додати'
        ]])


    <!-- Main content -->
    <section class="content">
        @include('admin.component.events')
        <form action="{{route('admin.order.store')}}" method="post">
            @csrf
            <div class="row">
                <div class="col-md-6">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Замовник</h3>

                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse"
                                        data-toggle="tooltip" title="Collapse">
                                    <i class="fas fa-minus"></i></button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="user-select2">Користувач</label>
                                <select name="user" id="user-select2" class="form-control">
                                    @if(old('user')) {{$user = \App\User::findOrFail(old('user'))}}
                                    <option value="{{$user->id}}">{{$user->fullName}}</option> @endif
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="comment">Коментар замовника</label>
                                <textarea name="comment" id="comment" rows="5"
                                          class="form-control">{{old('comment')}}</textarea>
                            </div>
                        </div>
                    </div>

                    @include('admin.order.cards.form_products')
                </div>
                {{-- /.col--}}
                <div class="col-md-6">
                    <div class="card card-info">
                        <div class="card-header">
                            <h3 class="card-title">Доставка</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse"
                                        data-toggle="tooltip" title="Collapse">
                                    <i class="fas fa-minus"></i></button>
                            </div>
                        </div>
                        <div class="card-body">

                            <div class="form-group">
                                <label for="shipping-select2">Місто/Село</label>
                                <select name="city_code" id="shipping-select2" class="form-control"
                                        style="width: 100%"></select>
                            </div>

                            <div class="nav nav-tabs border-0 mb-3" role="tablist">
                                <p class=" m-1">Спосіб доставки:</p>
                                <div class="custom-control custom-radio m-1">
                                    <input type="radio" id="radio_courier" name="shipping_method" value="courier"
                                           data-target="#courier" class="custom-control-input"
                                           @if(old('shipping_method', 'courier') == 'courier') checked @endif
                                    >
                                    <label for="radio_courier" class="custom-control-label">Курєр </label>
                                </div>
                                <div class="custom-control custom-radio m-1">
                                    <input type="radio" id="radio_novaposhta" name="shipping_method" value="novaposhta"
                                           data-target="#novaposhta" class="custom-control-input"
                                           @if(old('shipping_method') == 'novaposhta') checked @endif
                                    >
                                    <label for="radio_novaposhta" class="custom-control-label">Нова Пошта </label>
                                </div>
                            </div>
                            <div class="tab-content">
                                <div id="courier"
                                     class="tab-pane @if(old('shipping_method', 'courier') == 'courier') active @endif">
                                    <div class="form-group">
                                        <label>Адрес</label>
                                        <div class="form-row">
                                            <div class="input-group col-6">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">вул.</div>
                                                </div>
                                                <input name="street" type="text" class="form-control"
                                                       id="address_street" value="{{old('street')}}">
                                            </div>
                                            <div class="input-group col-3">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">буд.</div>
                                                </div>
                                                <input name="house" id="address_house"
                                                       value="{{old('house')}}"
                                                       type="text" class="form-control">
                                            </div>
                                            <div class="input-group col-3">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">кв.</div>
                                                </div>
                                                <input name="flat" id="address_flat" value="{{old('flat')}}"
                                                       type="text" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div id="novaposhta"
                                     class="tab-pane @if(old('shipping_method') == 'novaposhta') active @endif">
                                    <div class="form-group">
                                        <label for="address-select2">Відділення</label>
                                        <select name="warehouse_code" id="address-select2" class="form-control"
                                                style="width: 100%"></select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="shipping-rate">Вартість доставки</label>
                                <input type="number" name="shipping_rate" id="shipping-rate"
                                       value="{{old('shipping_rate')}}" class="form-control">
                            </div>

                        </div>
                    </div>

                    {{-- payment card--}}
                    @include('admin.order.cards.create_payment')

                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">

                            <a href="" class="btn btn-secondary">Cancel</a>
                            <input type="submit" value="Save" class="btn btn-success float-right">
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </section>
@endsection

@section('script')
    <script src="{{ mix('adm/js/order-edit.js')}}"></script>
@endsection