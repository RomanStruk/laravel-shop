<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UpSellController extends Controller
{
    public function showUpSellList(){
        return view('sidebar.upsell');
    }
}
