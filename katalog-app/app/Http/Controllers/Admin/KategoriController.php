<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AdminLog;
use App\Models\Category;
use App\Models\CategoryGroup;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class KategoriController extends Controller
{
    public function index()
    {
        $kategori    = Category::orderBy('group')->orderBy('urutan')->get();
        $kelompokAll = CategoryGroup::orderBy('urutan')->get();
        return view('admin.kategori.index', compact('kategori', 'kelompokAll'));
    }

    public function store(Request $request)
    {
        $validSlugs = CategoryGroup::pluck('slug')->toArray();
        $request->validate([
            'name'  => 'required|string|max:100',
            'group' => 'required|in:' . implode(',', $validSlugs),
        ]);

        $slug = Str::slug($request->name);

        if (Category::where('slug', $slug)->exists()) {
            return back()->withErrors(['name' => 'Kategori dengan nama tersebut sudah ada.'])->withInput();
        }

        $urutan = Category::where('group', $request->group)->max('urutan') + 1;

        $cat = Category::create([
            'name'   => $request->name,
            'slug'   => $slug,
            'group'  => $request->group,
            'urutan' => $urutan,
        ]);

        AdminLog::catat('Tambah Kategori', "Kategori: {$cat->name} (group: {$cat->group})");

        return back()->with('sukses', "Kategori \"{$cat->name}\" berhasil ditambahkan.");
    }

    public function update(Request $request, Category $kategori)
    {
        $validSlugs = CategoryGroup::pluck('slug')->toArray();
        $request->validate([
            'name'  => 'required|string|max:100',
            'group' => 'required|in:' . implode(',', $validSlugs),
        ]);

        $oldSlug = $kategori->slug;
        $newSlug = Str::slug($request->name);

        if ($newSlug !== $oldSlug && Category::where('slug', $newSlug)->exists()) {
            return back()->withErrors(['name_' . $kategori->id => 'Nama ini sudah dipakai kategori lain.'])->withInput();
        }

        if ($newSlug !== $oldSlug) {
            Product::where('category', $oldSlug)->update(['category' => $newSlug]);
        }

        $kategori->update([
            'name'  => $request->name,
            'slug'  => $newSlug,
            'group' => $request->group,
        ]);

        AdminLog::catat('Edit Kategori', "Kategori: {$kategori->name}");

        return back()->with('sukses', "Kategori \"{$kategori->name}\" berhasil diperbarui.");
    }

    public function destroy(Category $kategori)
    {
        $jumlahProduk = Product::where('category', $kategori->slug)->count();

        if ($jumlahProduk > 0) {
            Product::where('category', $kategori->slug)->update(['category' => null]);
        }

        AdminLog::catat('Hapus Kategori', "Kategori: {$kategori->name}" . ($jumlahProduk > 0 ? " ({$jumlahProduk} produk dikosongkan kategorinya)" : ''));
        $kategori->delete();

        return back()->with('sukses', "Kategori \"{$kategori->name}\" berhasil dihapus." . ($jumlahProduk > 0 ? " {$jumlahProduk} produk kategorinya dikosongkan." : ''));
    }
}
