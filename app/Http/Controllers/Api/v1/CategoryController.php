<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Services\Data\Category\GetCategories;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(GetCategories $getCategories)
    {
        $categories = $getCategories->handel(true);
        $result = $categories->map(function($items){
            $items['count_products'] = $items->countProducts();
            $items['children'] = $items->children
                ->map(function ($child){
                    $child['count_products'] = $child->countProducts();
                    return $child;
                });
            return $items;
        });
        return response()->json($result);
    }
}
