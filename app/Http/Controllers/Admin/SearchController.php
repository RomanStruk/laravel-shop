<?php


namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Product;
use App\User;
use App\Services\PaginateSession;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function index(Request $request, PaginateSession $paginateSession)
    {
        $products = Product::filter(['search' => $request->q])->paginate($paginateSession->getLimit());
        $users = User::filter(['search' => $request->q])->allRelations()->paginate($paginateSession->getLimit(), ['id', 'email', 'created_at']);
        return view('admin.search.index')
            ->with('products', $products)
            ->with('users', $users);
    }
}
