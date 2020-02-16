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
        $categories = Category::with('children')->where('parent_id', '=', Null)->get();
        $result = [];
        foreach ($categories as $category){
            $children = [];
            $parent_count = $category->countProducts();
            foreach ($category->children as $rr){
                //dd($rr->countProducts());
                $rr['count_products'] = $rr->countProducts();
                $parent_count += $rr['count_products'];
                $children[] = $rr;
            }
            $result[$category->id] = [
                'id' => $category->id,
                'parent_id' => $category->parent_id,
                'name' => $category->name,
                'slug' => $category->slug,
                'count_products' => $parent_count,
                'children' => $children
            ];
        }
        return $result;
    }

    public function getDataCategoriesJson(Request $request)
    {
        return response()->json(self::getDataCategories());
    }


}
