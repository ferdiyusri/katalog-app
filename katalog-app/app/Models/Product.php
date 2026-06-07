<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name', 'division', 'category', 'description', 'price', 'image', 'is_featured',
    ];

    public function getCategoryLabelAttribute(): string
    {
        static $map = null;
        if ($map === null) {
            $map = \App\Models\Category::pluck('name', 'slug')->toArray();
        }
        return $map[$this->category] ?? ucfirst($this->category);
    }
}
