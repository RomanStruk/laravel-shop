<?php


namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Services\Data\Product\GetProductsByLimit;
use App\Services\Data\User\GetUsersByLimit;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function index(Request $request, GetProductsByLimit $getProductsByLimit, GetUsersByLimit $getUsersByLimit)
    {
        $products = $getProductsByLimit->handel(['search' => $request->q]);
        $users = $getUsersByLimit->handel(['search' => $request->q], ['id', 'email', 'created_at']);
        return view('admin.search.index')
            ->with('products', $products)
            ->with('users', $users);
    }
}