<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class Banner{
    public $image = 'img/banner/tab-banner.jpg';
    public $link = 'img/banner/tab-banner.jpg';
}
class IndexPageController extends Controller
{
    public function index()
    {
        // Вибрані сторінки
        $favorite = Product::with('media')->favorite()->get();

        //Популярні товари
        $popular = Product::with('media')->top(8)->get();

        //Нові надходження
        $newArrival = Product::with('media')->latest()->take(5)->get();

        //Рекомендовані
        $featured = Product::with('media')->take(5)->get();

        //Високо оцінений
        $topRated = Product::with('media')->orderBy('average_rating')->take(5)->get();

        //
        $banner = new Banner();

        return view('index')
            ->with('newArrival', $newArrival)
            ->with('featured', $featured)
            ->with('topRated', $topRated)
            ->with('banner', $banner)
            ->with('popular', $popular)
            ->with('favorite', $favorite);
    }
}
