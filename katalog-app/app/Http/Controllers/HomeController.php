<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\SiteImage;

class HomeController extends Controller
{
    public function index()
    {
        $siteImages     = SiteImage::allKeyed();
        $totalProducts  = Product::count();
        $totalCategories = Category::count();

        return view('home', compact('siteImages', 'totalProducts', 'totalCategories'));
    }
}