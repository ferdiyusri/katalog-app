<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Product extends Model
{
    protected $fillable = [
        'name', 'slug', 'division', 'category', 'description', 'price', 'image', 'is_featured',
    ];

    protected static function booted(): void
    {
        static::saving(function (Product $product) {
            if (empty($product->slug) || $product->isDirty('name')) {
                $base = Str::slug($product->name);
                $slug = $base;
                $i = 1;
                while (
                    static::where('slug', $slug)
                        ->when($product->exists, fn ($q) => $q->where('id', '!=', $product->id))
                        ->exists()
                ) {
                    $slug = $base . '-' . $i++;
                }
                $product->slug = $slug;
            }
        });
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function getCategoryLabelAttribute(): string
    {
        static $map = null;
        if ($map === null) {
            $map = \App\Models\Category::pluck('name', 'slug')->toArray();
        }
        return $map[$this->category] ?? ucfirst($this->category);
    }
}
