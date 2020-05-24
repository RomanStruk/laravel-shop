<?php

namespace App\Http\Controllers;

use App\OrderProduct;
use App\Product;
use Illuminate\Http\Request;

class Banner{
    public $image = 'img/banner/tab-banner.jpg';
    public $link = 'img/banner/tab-banner.jpg';
}
class IndexPageController extends Controller
{
    public function index()
    {
        //Нові надходження
        $newArrival = Product::avgRating()->latest()->take(5)->get();

        //Рекомендовані
        $featured = Product::avgRating()->take(5)->get();

        //Високо оцінений
        $topRated = Product::avgRating()->orderBy('average_rating')->take(5)->get();

        //
        $banner = new Banner();

        return view('index')
            ->with('newArrival', $newArrival)
            ->with('featured', $featured)
            ->with('topRated', $topRated)
            ->with('banner', $banner);
    }
}
