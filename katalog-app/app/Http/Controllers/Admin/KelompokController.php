<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AdminLog;
use App\Models\Category;
use App\Models\CategoryGroup;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class KelompokController extends Controller
{
    public function index()
    {
        $kelompok = CategoryGroup::orderBy('urutan')->get();
        return view('admin.kelompok.index', compact('kelompok'));
    }

    public function store(Request $request)
    {
        $request->validate(['name' => 'required|string|max:100']);

        $slug = Str::slug($request->name);
        if (CategoryGroup::where('slug', $slug)->exists()) {
            return back()->withErrors(['name' => 'Kelompok dengan nama serupa sudah ada.'])->withInput();
        }

        $urutan  = (CategoryGroup::max('urutan') ?? 0) + 1;
        $kelompok = CategoryGroup::create(['name' => $request->name, 'slug' => $slug, 'urutan' => $urutan]);
        AdminLog::catat('Tambah Kelompok', "Kelompok: {$kelompok->name}");

        return back()->with('sukses', 'Kelompok berhasil ditambahkan.');
    }

    public function update(Request $request, CategoryGroup $kelompok)
    {
        $request->validate(['name' => 'required|string|max:100']);

        $oldSlug = $kelompok->slug;
        $newSlug = Str::slug($request->name);

        if ($newSlug !== $oldSlug && CategoryGroup::where('slug', $newSlug)->exists()) {
            return back()->withErrors(['name' => 'Kelompok dengan nama serupa sudah ada.'])->withInput();
        }

        if ($newSlug !== $oldSlug) {
            Category::where('group', $oldSlug)->update(['group' => $newSlug]);
        }

        $kelompok->update(['name' => $request->name, 'slug' => $newSlug]);
        AdminLog::catat('Edit Kelompok', "Kelompok: {$kelompok->name}");

        return back()->with('sukses', 'Kelompok berhasil diperbarui.');
    }

    public function destroy(CategoryGroup $kelompok)
    {
        $categories = Category::where('group', $kelompok->slug)->get();

        foreach ($categories as $cat) {
            $produkCount = Product::where('category', $cat->slug)->count();
            if ($produkCount > 0) {
                return back()->withErrors(['delete_kelompok' =>
                    "Tidak dapat menghapus \"{$kelompok->name}\" — kategori \"{$cat->name}\" masih memiliki {$produkCount} produk. Hapus atau pindahkan produknya terlebih dahulu."
                ]);
            }
        }

        Category::where('group', $kelompok->slug)->delete();

        AdminLog::catat('Hapus Kelompok', "Kelompok: {$kelompok->name} (+ {$categories->count()} kategori)");
        $kelompok->delete();

        return back()->with('sukses', "Kelompok \"{$kelompok->name}\" berhasil dihapus.");
    }
}
