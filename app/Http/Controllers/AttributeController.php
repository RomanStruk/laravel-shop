<?php

namespace App\Http\Controllers;

use App\GroupAttribute;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AttributeController extends Controller
{

    public static function getDataGroup(){
        $group = GroupAttribute::all();
        $group->load('allAttributes'); // жадна загрузка
        return $group;
    }

    public function getDataAttributesJson(Request $request)
    {
        //return response()->json($request->all());
        return self::getDataGroup();
    }
    //
    public function showGroup($id){
        $group_db = GroupAttribute::find($id);
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
