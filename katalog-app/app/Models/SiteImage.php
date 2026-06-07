<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class SiteImage extends Model
{
    protected $fillable = ['key', 'path'];

    public const SLOTS = [
        'hero'                 => ['label' => 'Hero Beranda',            'icon' => 'bi-building',      'page' => 'Halaman Beranda'],
        'category_interior'    => ['label' => 'Kategori Interior',       'icon' => 'bi-lamp',          'page' => 'Halaman Beranda'],
        'category_builddesain' => ['label' => 'Kategori Build & Desain', 'icon' => 'bi-buildings',     'page' => 'Halaman Beranda'],
        'layanan_arsitektur'   => ['label' => 'Layanan Arsitektur',      'icon' => 'bi-building-gear', 'page' => 'Halaman Layanan'],
        'layanan_interior'     => ['label' => 'Layanan Interior Design', 'icon' => 'bi-palette2',      'page' => 'Halaman Layanan'],
        'layanan_designbuild'  => ['label' => 'Layanan Design & Build',  'icon' => 'bi-hammer',        'page' => 'Halaman Layanan'],
        'layanan_custom'       => ['label' => 'Layanan Custom Interior', 'icon' => 'bi-box-seam',      'page' => 'Halaman Layanan'],
    ];

    public static function allKeyed(): array
    {
        $rows = static::all()->keyBy('key');
        $result = [];
        foreach (array_keys(self::SLOTS) as $key) {
            $result[$key] = $rows->has($key) ? $rows[$key]->path : null;
        }
        return $result;
    }

    public function url(): string
    {
        return Storage::url($this->path);
    }
}
