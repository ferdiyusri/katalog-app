<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AdminLog;
use App\Models\Category;
use App\Models\CategoryGroup;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index()
    {
        $kategori      = request('kategori');
        $products      = Product::when($kategori, fn($q) => $q->where('category', $kategori))
            ->latest()->get();
        $kelompokAll  = CategoryGroup::with('categories')->orderBy('urutan')->get();
        $kategoriNama = $kategori
            ? (Category::where('slug', $kategori)->value('name') ?? ucfirst($kategori))
            : null;
        return view('admin.products.index', compact('products', 'kategori', 'kelompokAll', 'kategoriNama'));
    }

    public function create()
    {
        $defaultKategori = request('kategori');
        $kelompokAll     = CategoryGroup::with(['categories' => fn($q) => $q->orderBy('urutan')])->orderBy('urutan')->get();
        return view('admin.products.create', compact('defaultKategori', 'kelompokAll'));
    }

    public function store(Request $request)
    {
        $validSlugs = Category::pluck('slug')->toArray();

        $request->validate([
            'name'        => 'required|string|max:255',
            'category'    => 'required|in:' . implode(',', $validSlugs),
            'price'       => 'nullable|numeric|min:0',
            'description' => 'nullable|string',
            'image'       => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $data = $request->only(['name', 'category', 'description']);
        $data['price'] = $request->filled('price') ? $request->price : 0;

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('products', 'public');
        }

        $product = Product::create($data);
        AdminLog::catat('Tambah Produk', "Produk: {$product->name} (ID: {$product->id})");

        return redirect()->route('admin.products.index')->with('success', 'Produk berhasil ditambahkan.');
    }

    public function show(Product $product)
    {
        return view('admin.products.show', compact('product'));
    }

    public function edit(Product $product)
    {
        $kelompokAll = CategoryGroup::with(['categories' => fn($q) => $q->orderBy('urutan')])->orderBy('urutan')->get();
        return view('admin.products.edit', compact('product', 'kelompokAll'));
    }

    public function update(Request $request, Product $product)
    {
        $validSlugs = Category::pluck('slug')->toArray();

        $request->validate([
            'name'        => 'required|string|max:255',
            'category'    => 'required|in:' . implode(',', $validSlugs),
            'price'       => 'nullable|numeric|min:0',
            'description' => 'nullable|string',
            'image'       => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $data = $request->only(['name', 'category', 'description']);
        $data['price'] = $request->filled('price') ? $request->price : 0;

        if ($request->hasFile('image')) {
            if ($product->image) {
                Storage::disk('public')->delete($product->image);
            }
            $data['image'] = $request->file('image')->store('products', 'public');
        }

        $product->update($data);
        AdminLog::catat('Edit Produk', "Produk: {$product->name} (ID: {$product->id})");

        return redirect()->route('admin.products.index')->with('success', 'Produk berhasil diperbarui.');
    }

    public function destroy(Product $product)
    {
        if ($product->image) {
            Storage::disk('public')->delete($product->image);
        }

        AdminLog::catat('Hapus Produk', "Produk: {$product->name} (ID: {$product->id})");
        $product->delete();

        return redirect()->route('admin.products.index')->with('success', 'Produk berhasil dihapus.');
    }
}
