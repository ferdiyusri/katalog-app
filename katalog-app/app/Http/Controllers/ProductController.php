<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\CategoryGroup;
use App\Models\Product;

class ProductController extends Controller
{
    public function index()
    {
        $kategori = request('kategori');

        $products = Product::when($kategori, function ($query) use ($kategori) {
                $slugs = Category::where('group', $kategori)->pluck('slug');
                return $query->whereIn('category', $slugs);
            })
            ->latest()
            ->paginate(12);

        $kelompokAll = CategoryGroup::orderBy('urutan')->get();

        return view('products.index', compact('products', 'kategori', 'kelompokAll'));
    }

    public function show(Product $product)
    {
        return view('products.show', compact('product'));
    }

    public function interior()
    {
        $slugs    = Category::where('group', 'interior')->pluck('slug');
        $products = Product::whereIn('category', $slugs)->latest()->get();

        return view('products.interior', compact('products'));
    }

    public function buildDesain()
    {
        $slugs    = Category::where('group', 'build')->pluck('slug');
        $products = Product::whereIn('category', $slugs)->latest()->get();

        return view('products.builddesain', compact('products'));
    }
}