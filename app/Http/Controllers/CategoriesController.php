<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    public function showCategoriesSideBar(){

        return view('sidebar.categories', ['categories' => Category::all()]);
    }

    public static function getDataCategories()
    {
        $categories = Category::with('children')->where('parent_id', '=', 0)->get();
        $result = $categories->map(function($items){
            $items['count_products'] = $items->countProducts();
            $items['children'] = $items->children
                ->map(function ($child){
                    $child['count_products'] = $child->countProducts();
                    return $child;
                });
            return $items;
        });
        return $result;
    }

    public function getDataCategoriesJson(Request $request)
    {
        return response()->json(self::getDataCategories());
    }


}
