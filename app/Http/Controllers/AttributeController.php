<?php

namespace App\Http\Controllers;

use App\Filter;
use App\Services\Data\Filter\GetFilters;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AttributeController extends Controller
{

    public function getDataAttributesJson(Request $request, GetFilters $getFilters)
    {
        return $getFilters->handel();
    }
    //
    public function showGroup($id){
        $group_db = Filter::find($id);
        return $group_db;
    }


    public static function showGroups($group = null){
        $data = [
            'title' => 'Test',
            'text' => 'same data'
        ];
        return $data;
        //return view('sidebar.single-sidebar', $data);
    }

    public function compose(View $view)
    {
        $view->with('title', 'Test');
        $view->with('items', [1,2,3]);
    }



}
