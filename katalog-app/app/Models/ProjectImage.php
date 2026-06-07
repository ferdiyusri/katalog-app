<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProjectImage extends Model
{
    protected $table = 'project_images';

    public $timestamps = false;

    public function project()
    {
        return $this->belongsTo(Project::class);
    }
}