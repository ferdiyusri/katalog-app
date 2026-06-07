<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['name', 'slug', 'group', 'urutan'];

    public function products()
    {
        return $this->hasMany(Product::class, 'category', 'slug');
    }

    public function getProductCountAttribute(): int
    {
        return Product::where('category', $this->slug)->count();
    }
}
