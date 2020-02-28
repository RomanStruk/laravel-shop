@extends('admin.layouts.app')

@section('content')
<div class="row">
    <div class="col-md-4">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-shopping-cart"></i> Order Details</h3>
            </div>
            <table class="table">
                <tbody>
                <tr>
                    <td style="width: 1%;"><button data-toggle="tooltip" title="" class="btn btn-info btn-xs" data-original-title="Store"><i class="fa fa-shopping-cart fa-fw"></i></button></td>
                    <td><a href="https://demo.opencart.com/" target="_blank">Your Store</a></td>
                </tr>
                <tr>
                    <td><button data-toggle="tooltip" title="" class="btn btn-info btn-xs" data-original-title="Date Added"><i class="fa fa-calendar fa-fw"></i></button></td>
                    <td>23/02/2020</td>
                </tr>
                <tr>
                    <td><button data-toggle="tooltip" title="" class="btn btn-info btn-xs" data-original-title="Payment Method"><i class="fa fa-credit-card fa-fw"></i></button></td>
                    <td>Готівкою при доставці</td>
                </tr>
                <tr>
                    <td><button data-toggle="tooltip" title="" class="btn btn-info btn-xs" data-original-title="Shipping Method"><i class="fa fa-truck fa-fw"></i></button></td>
                    <td>Flat Shipping Rate</td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
    <div class="col-md-4">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-user"></i> Customer Details</h3>
            </div>
            <table class="table">
                <tbody><tr>
                    <td style="width: 1%;"><button data-toggle="tooltip" title="" class="btn btn-info btn-xs" data-original-title="Customer"><i class="fa fa-user fa-fw"></i></button></td>
                    <td> <a href="https://demo.opencart.com/admin/index.php?route=customer/customer/edit&amp;user_token=Bajgcy6cPAOTrKM99s2ql0t4NpOP3k2c&amp;customer_id=70497" target="_blank">Jayabharathi Periyasamy</a> </td>
                </tr>
                <tr>
                    <td><button data-toggle="tooltip" title="" class="btn btn-info btn-xs" data-original-title="Customer Group"><i class="fa fa-group fa-fw"></i></button></td>
                    <td>Default</td>
                </tr>
                <tr>
                    <td><button data-toggle="tooltip" title="" class="btn btn-info btn-xs" data-original-title="E-Mail"><i class="fa fa-envelope-o fa-fw"></i></button></td>
                    <td><a href="mailto:jayabharathiece2019@gmail.com">jayabharathiece2019@gmail.com</a></td>
                </tr>
                <tr>
                    <td><button data-toggle="tooltip" title="" class="btn btn-info btn-xs" data-original-title="Telephone"><i class="fa fa-phone fa-fw"></i></button></td>
                    <td>6385348798</td>
                </tr>
                </tbody></table>
        </div>
    </div>
    <div class="col-md-4">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-cog"></i> Options</h3>
            </div>
            <table class="table">
                <tbody>
                <tr>
                    <td>Invoice</td>
                    <td id="invoice" class="text-right"></td>
                    <td style="width: 1%;" class="text-center"> <button id="button-invoice" data-loading-text="Loading..." data-toggle="tooltip" title="" class="btn btn-success btn-xs" data-original-title="Generate"><i class="fa fa-cog"></i></button>
                    </td>
                </tr>
                <tr>
                    <td>Reward Points</td>
                    <td class="text-right">300</td>
                    <td class="text-center"> <button id="button-reward-add" data-loading-text="Loading..." data-toggle="tooltip" title="" class="btn btn-success btn-xs" data-original-title="Add Reward Points"><i class="fa fa-plus-circle"></i></button>
                    </td>
                </tr>
                <tr>
                    <td>Affiliate
                    </td>
                    <td class="text-right">$0.00</td>
                    <td class="text-center"> <button disabled="disabled" class="btn btn-success btn-xs"><i class="fa fa-plus-circle"></i></button>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title"><i class="fa fa-info-circle"></i> Order (#8704)</h3>
    </div>
    <div class="panel-body">
        <table class="table table-bordered">
            <thead>
            <tr>
                <td style="width: 50%;" class="text-left">Payment Address</td>
                <td style="width: 50%;" class="text-left">Shipping Address</td>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td class="text-left">Jayabharathi Periyasamy<br>sri kasthuri ladies,chennai<br>chennai 607105<br>Tamil Nadu<br>India</td>
                <td class="text-left">
                    {{ $order->shipping->address }}
                </td>
            </tr>
            </tbody>
        </table>
        <table class="table table-bordered">
            <thead>
            <tr>
                <td class="text-left">Product</td>
                <td class="text-left">Категорія</td>
                <td class="text-right">Quantity</td>
                <td class="text-right">Ціна за одиницю</td>
                <td class="text-right">Total</td>
            </tr>
            </thead>
            <tbody>
            @foreach($order->products as $product)
            <tr>
                <td class="text-left">
                    <a href="/admin/index.php?route=catalog/product/edit&amp;product_id=47">{{$product->title}}</a> <br>
                    &nbsp;<small> - Дата доставки: 2011-04-22</small> </td>
                <td class="text-left">{{$product->category->name}}</td>
                <td class="text-right">1</td>
                <td class="text-right">${{ $product->price }}</td>
                <td class="text-right">${{ $product->price }}</td>
            </tr>
            @endforeach
            <tr>
                <td colspan="4" class="text-right">Sub-Total</td>
                <td class="text-right">${{ $order->sum }}</td>
            </tr>
            <tr>
                <td colspan="4" class="text-right">Єдиний тариф доставки</td>
                <td class="text-right">${{ $order->shipping->shipping_rate }}</td>
            </tr>
            <tr>
                <td colspan="4" class="text-right">Total</td>
                <td class="text-right">${{ $order->sum }}</td>
            </tr>
            </tbody>
        </table>
        <table class="table table-bordered">
            <thead>
            <tr>
                <td>Customer Comment</td>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>Надзвичайний наказ, будь ласка, врахуйте</td>
            </tr>
            </tbody>
        </table>
    </div>
</div>
<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title"><i class="fa fa-comment-o"></i> Order History</h3>
    </div>
    <div class="panel-body">
        <ul class="nav nav-tabs">
            <li class="active"><a href="#tab-history" data-toggle="tab">History</a></li>
            <li><a href="#tab-additional" data-toggle="tab">Additional</a></li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane active" id="tab-history">
                <div id="history"><div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <td class="text-left">Date Added</td>
                                <td class="text-left">Comment</td>
                                <td class="text-left">Status</td>
                                <td class="text-left">Customer Notified</td>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td class="text-left">23/02/2020</td>
                                <td class="text-left"></td>
                                <td class="text-left">Pending</td>
                                <td class="text-left">No</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="row">
                        <div class="col-sm-6 text-left"></div>
                        <div class="col-sm-6 text-right">Showing 1 to 1 of 1 (1 Pages)</div>
                    </div>
                </div>
                <br>
                <fieldset>
                    <legend>Add Order History</legend>
                    <form class="form-horizontal">
                        <div class="form-group">
                            <label class="col-sm-2 control-label" for="input-order-status">Order Status</label>
                            <div class="col-sm-10">
                                <select name="order_status_id" id="input-order-status" class="form-control">
                                    <option value="7">Canceled</option>
                                    <option value="9">Canceled Reversal</option>
                                    <option value="13">Chargeback</option>
                                    <option value="5">Complete</option>
                                    <option value="8">Denied</option>
                                    <option value="14">Expired</option>
                                    <option value="10">Failed</option>
                                    <option value="1" selected="selected">Pending</option>
                                    <option value="15">Processed</option>
                                    <option value="2">Processing</option>
                                    <option value="11">Refunded</option>
                                    <option value="12">Reversed</option>
                                    <option value="3">Shipped</option>
                                    <option value="16">Voided</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-10">
                            <label class="col-sm-2 control-label" for="input-override">
                                <span data-toggle="tooltip" title="" data-original-title="Якщо замовлення замовника блокується для зміни статусу замовлення через розширення проти шахрайства, увімкніть можливість скасування.">не брати до уваги

</span></label>
                                <input type="checkbox" name="override" value="1" id="input-override">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-10">
                                <label class="col-sm-2 control-label" for="input-notify">Повідомити Замовника</label>
                                <input type="checkbox" name="notify" value="1" id="input-notify">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label" for="input-comment">Comment</label>
                            <div class="col-sm-10">
                                <textarea name="comment" rows="8" id="input-comment" class="form-control"></textarea>
                            </div>
                        </div>
                    </form>
                </fieldset>
                <div class="text-right">
                    <button id="button-history" data-loading-text="Loading..." class="btn btn-primary"><i class="fa fa-plus-circle"></i> Add History</button>
                </div>
            </div>
            <div class="tab-pane" id="tab-additional"> <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <td colspan="2">Browser</td>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>IP Address</td>
                            <td>162.158.165.174</td>
                        </tr>
                        <tr>
                            <td>Forwarded IP</td>
                            <td>45.251.33.66</td>
                        </tr>
                        <tr>
                            <td>User Agent</td>
                            <td>Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/63.0.3235.0 Safari/537.36</td>
                        </tr>
                        <tr>
                            <td>Accept Language</td>
                            <td>en-US,en;q=0.9</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
