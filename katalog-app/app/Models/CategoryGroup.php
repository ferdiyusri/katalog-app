<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CategoryGroup extends Model
{
    protected $fillable = ['name', 'slug', 'urutan'];

    public function categories()
    {
        return $this->hasMany(Category::class, 'group', 'slug')->orderBy('urutan');
    }

    public function getCategoryCountAttribute(): int
    {
        return Category::where('group', $this->slug)->count();
    }
}
