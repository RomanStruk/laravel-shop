<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RelatedProductsController extends Controller
{
    // повязані продукти
    public function show(){
        return view('sidebar.related');
    }
}
