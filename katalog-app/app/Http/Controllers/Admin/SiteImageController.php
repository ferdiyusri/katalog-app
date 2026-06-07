<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AdminLog;
use App\Models\SiteImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SiteImageController extends Controller
{
    public function index()
    {
        $images = SiteImage::all()->keyBy('key');
        return view('admin.site-images.index', compact('images'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'key'   => 'required|in:' . implode(',', array_keys(SiteImage::SLOTS)),
            'image' => 'required|image|mimes:jpg,jpeg,png,webp|max:3072',
        ]);

        $existing = SiteImage::where('key', $request->key)->first();
        if ($existing) {
            Storage::disk('public')->delete($existing->path);
            $existing->delete();
        }

        $path = $request->file('image')->store('site-images', 'public');

        SiteImage::create(['key' => $request->key, 'path' => $path]);

        $label = SiteImage::SLOTS[$request->key]['label'];
        AdminLog::catat('Upload Gambar', "Slot: {$label}");

        return back()->with('sukses', "Gambar \"{$label}\" berhasil diunggah.");
    }

    public function destroy(string $key)
    {
        $image = SiteImage::where('key', $key)->firstOrFail();

        Storage::disk('public')->delete($image->path);
        $label = SiteImage::SLOTS[$key]['label'] ?? $key;
        $image->delete();

        AdminLog::catat('Hapus Gambar', "Slot: {$label}");

        return back()->with('sukses', "Gambar \"{$label}\" berhasil dihapus.");
    }
}
