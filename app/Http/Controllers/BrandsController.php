<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use View;

class BrandsController extends Controller
{
    // список брендов
    public static function showBrandList(){
        return '';
        //return view('sidebar.brand', [])->renderContents();
    }
}
