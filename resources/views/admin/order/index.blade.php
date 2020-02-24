@extends('admin.layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-9 col-md-pull-3 col-sm-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title"><i class="fa fa-list"></i> Order List</h3>
                </div>
                <div class="panel-body">
                    <form method="post" action="" enctype="multipart/form-data" id="form-order">
                        <table class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <td style="width: 1px;" class="text-center"><input type="checkbox"
                                                                                   onclick="$('input[name*=\'selected\']').prop('checked', this.checked);">
                                </td>
                                <td class="text-right"><a
                                        href="https://demo.opencart.com/admin/index.php?route=sale/order&amp;user_token=Bajgcy6cPAOTrKM99s2ql0t4NpOP3k2c&amp;sort=o.order_id&amp;order=ASC"
                                        class="desc">Order ID</a></td>
                                <td class="text-left"><a
                                        href="https://demo.opencart.com/admin/index.php?route=sale/order&amp;user_token=Bajgcy6cPAOTrKM99s2ql0t4NpOP3k2c&amp;sort=customer&amp;order=ASC">Customer</a>
                                </td>
                                <td class="text-left"><a
                                        href="https://demo.opencart.com/admin/index.php?route=sale/order&amp;user_token=Bajgcy6cPAOTrKM99s2ql0t4NpOP3k2c&amp;sort=order_status&amp;order=ASC">Status</a>
                                </td>
                                <td class="text-right"><a
                                        href="https://demo.opencart.com/admin/index.php?route=sale/order&amp;user_token=Bajgcy6cPAOTrKM99s2ql0t4NpOP3k2c&amp;sort=o.total&amp;order=ASC">Total</a>
                                </td>
                                <td class="text-left"><a
                                        href="https://demo.opencart.com/admin/index.php?route=sale/order&amp;user_token=Bajgcy6cPAOTrKM99s2ql0t4NpOP3k2c&amp;sort=o.date_added&amp;order=ASC">Date
                                        Added</a></td>
                                <td class="text-left"><a
                                        href="https://demo.opencart.com/admin/index.php?route=sale/order&amp;user_token=Bajgcy6cPAOTrKM99s2ql0t4NpOP3k2c&amp;sort=o.date_modified&amp;order=ASC">Date
                                        Modified</a></td>
                                <td class="text-right">Action</td>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($orders as $order)
                            <tr>
                                <td class="text-center">
                                    <input type="checkbox" name="selected[]" value="{{ $order->id }}">
                                    <input type="hidden" name="shipping_code[]" value="flat.flat">
                                </td>
                                <td class="text-right">{{ $order->id }}</td>
                                <td class="text-left">{{ $order->name }}</td>
                                <td class="text-left">{{ $order->status }}</td>
                                <td class="text-right">$ </td>
                                <td class="text-left">{{ $order->created_at }}</td>
                                <td class="text-left">{{ $order->updated_at }}</td>
                                <td class="text-right">
                                    <div style="min-width: 120px;">
                                        <div class="btn-group">
                                            <a
                                                href="{{ route( 'admin.order.revision', ['id' => $order->id]) }}"
                                                data-toggle="tooltip" title="" class="btn btn-primary"
                                                data-original-title="View">
                                                <i class="fa fa-eye"></i>
                                            </a>
                                            <button type="button" data-toggle="dropdown"
                                                    class="btn btn-primary dropdown-toggle">
                                                <span class="caret"></span>
                                            </button>
                                            <ul class="dropdown-menu dropdown-menu-right">
                                                <li>
                                                    <a href="https://demo.opencart.com/admin/index.php?route=sale/order/edit&amp;user_token=Bajgcy6cPAOTrKM99s2ql0t4NpOP3k2c&amp;order_id=8704"><i
                                                            class="fa fa-pencil"></i> Edit</a></li>
                                                <li><a href="8704"><i class="fa fa-trash-o"></i> Delete</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            @endforeach

                            </tbody>
                        </table>
                    </form>
                    <div class="row">
                        <div class="col-sm-6 text-left">
                            <ul class="pagination">
                                <li class="active"><span>1</span></li>
                                <li>
                                    <a href="https://demo.opencart.com/admin/index.php?route=sale/order&amp;user_token=Bajgcy6cPAOTrKM99s2ql0t4NpOP3k2c&amp;page=2">2</a>
                                </li>
                                <li>
                                    <a href="https://demo.opencart.com/admin/index.php?route=sale/order&amp;user_token=Bajgcy6cPAOTrKM99s2ql0t4NpOP3k2c&amp;page=3">3</a>
                                </li>
                                <li>
                                    <a href="https://demo.opencart.com/admin/index.php?route=sale/order&amp;user_token=Bajgcy6cPAOTrKM99s2ql0t4NpOP3k2c&amp;page=4">4</a>
                                </li>
                                <li>
                                    <a href="https://demo.opencart.com/admin/index.php?route=sale/order&amp;user_token=Bajgcy6cPAOTrKM99s2ql0t4NpOP3k2c&amp;page=5">5</a>
                                </li>
                                <li>
                                    <a href="https://demo.opencart.com/admin/index.php?route=sale/order&amp;user_token=Bajgcy6cPAOTrKM99s2ql0t4NpOP3k2c&amp;page=6">6</a>
                                </li>
                                <li>
                                    <a href="https://demo.opencart.com/admin/index.php?route=sale/order&amp;user_token=Bajgcy6cPAOTrKM99s2ql0t4NpOP3k2c&amp;page=7">7</a>
                                </li>
                                <li>
                                    <a href="https://demo.opencart.com/admin/index.php?route=sale/order&amp;user_token=Bajgcy6cPAOTrKM99s2ql0t4NpOP3k2c&amp;page=8">8</a>
                                </li>
                                <li>
                                    <a href="https://demo.opencart.com/admin/index.php?route=sale/order&amp;user_token=Bajgcy6cPAOTrKM99s2ql0t4NpOP3k2c&amp;page=9">9</a>
                                </li>
                                <li>
                                    <a href="https://demo.opencart.com/admin/index.php?route=sale/order&amp;user_token=Bajgcy6cPAOTrKM99s2ql0t4NpOP3k2c&amp;page=2">&gt;</a>
                                </li>
                                <li>
                                    <a href="https://demo.opencart.com/admin/index.php?route=sale/order&amp;user_token=Bajgcy6cPAOTrKM99s2ql0t4NpOP3k2c&amp;page=325">&gt;|</a>
                                </li>
                            </ul>
                        </div>
                        <div class="col-sm-6 text-right">Showing 1 to 20 of 6495 (325 Pages)</div>
                    </div>
                </div>
            </div>
        </div>
        <div id="filter-order" class="col-md-3 col-md-push-9 col-sm-12 hidden-sm hidden-xs">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title"><i class="fa fa-filter"></i> Filter</h3>
                </div>
                <div class="panel-body">
                    <div class="form-group">
                        <label class="control-label" for="input-order-id">Order ID</label>
                        <input type="text" name="filter_order_id" value="" placeholder="Order ID" id="input-order-id"
                               class="form-control">
                    </div>
                    <div class="form-group">
                        <label class="control-label" for="input-customer">Customer</label>
                        <input type="text" name="filter_customer" value="" placeholder="Customer" id="input-customer"
                               class="form-control" autocomplete="off">
                        <ul class="dropdown-menu"></ul>
                    </div>
                    <div class="form-group">
                        <label class="control-label" for="input-order-status">Order Status</label>
                        <select name="filter_order_status_id" id="input-order-status" class="form-control">
                            <option value=""></option>
                            <option value="0">Missing Orders</option>
                            <option value="7">Canceled</option>
                            <option value="9">Canceled Reversal</option>
                            <option value="13">Chargeback</option>
                            <option value="5">Complete</option>
                            <option value="8">Denied</option>
                            <option value="14">Expired</option>
                            <option value="10">Failed</option>
                            <option value="1">Pending</option>
                            <option value="15">Processed</option>
                            <option value="2">Processing</option>
                            <option value="11">Refunded</option>
                            <option value="12">Reversed</option>
                            <option value="3">Shipped</option>
                            <option value="16">Voided</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="control-label" for="input-total">Total</label>
                        <input type="text" name="filter_total" value="" placeholder="Total" id="input-total"
                               class="form-control">
                    </div>
                    <div class="form-group">
                        <label class="control-label" for="input-date-added">Date Added</label>
                        <div class="input-group date">
                            <input type="text" name="filter_date_added" value="" placeholder="Date Added"
                                   data-date-format="YYYY-MM-DD" id="input-date-added" class="form-control">
                            <span class="input-group-btn">
<button type="button" class="btn btn-default"><i class="fa fa-calendar"></i></button>
</span></div>
                    </div>
                    <div class="form-group">
                        <label class="control-label" for="input-date-modified">Date Modified</label>
                        <div class="input-group date">
                            <input type="text" name="filter_date_modified" value="" placeholder="Date Modified"
                                   data-date-format="YYYY-MM-DD" id="input-date-modified" class="form-control">
                            <span class="input-group-btn">
<button type="button" class="btn btn-default"><i class="fa fa-calendar"></i></button>
</span></div>
                    </div>
                    <div class="form-group text-right">
                        <button type="button" id="button-filter" class="btn btn-default"><i class="fa fa-filter"></i>
                            Filter
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
