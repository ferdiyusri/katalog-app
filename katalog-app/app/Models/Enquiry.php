<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Enquiry extends Model
{
    protected $fillable = ['nama', 'email', 'telepon', 'layanan', 'pesan', 'is_read'];

    protected $casts = [
        'is_read' => 'boolean',
        'email'   => 'encrypted',
        'telepon' => 'encrypted',
        'pesan'   => 'encrypted',
    ];
}
