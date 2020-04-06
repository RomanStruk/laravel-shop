<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    public function showCategoriesSideBar(){

        return view('sidebar.categories', ['categories' => Category::all()]);
    }
}
