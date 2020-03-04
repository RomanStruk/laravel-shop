@extends('admin.layouts.app')

@section('content')

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    @if (\Session::has('success'))
        <div class="alert alert-success">
            <ul>
                <li>{!! \Session::get('success') !!}</li>
            </ul>
        </div>
    @endif

    <div class="row">
        <div class="col-md-12 col-md-pull-3 col-sm-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title"><i class="fa fa-list"></i> Список замовлень</h3>
                </div>
                <div class="panel-body">
                    <table class="table table-bordered table-hover">
                        <thead>
                        <tr>
                            <td class="text-right"><a class="desc">ID</a></td>
                            <td class="text-left"><a href="">Заголовок</a></td>
                            <td class="text-left">Дія</td>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($categories as $category)
                            <tr>
                                <td class="text-right">{{ $category->id }}</td>
                                <td class="text-left">{{ $category->name }}</td>
                                <td class="text-right">
                                    <div class="btn-group">
                                        <a
                                            href="{{route('category.show', ['category' => $category->id])}}"
                                            data-toggle="tooltip" title="" class="btn btn-primary"
                                            data-original-title="View">
                                            <i class="fa fa-eye"></i>
                                        </a>
                                        <button type="button" class="btn btn-primary dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <span class="sr-only">Toggle Dropdown</span>
                                        </button>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item" href="{{route('category.edit', ['category' => $category->id])}}"><i class="fa fa-pencil"></i> Edit</a>
                                            <form method="POST" action="" >
                                                @csrf
                                                @method('DELETE')
                                                <button class="dropdown-item" value="submit" type="submit"><i class="fa fa-trash-o"></i> Delete</button>
                                            </form>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach

                        </tbody>
                    </table>
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
    </div>
@endsection
