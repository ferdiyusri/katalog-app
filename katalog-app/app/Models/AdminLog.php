<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;

class AdminLog extends Model
{
    public $timestamps = false;

    protected $fillable = ['admin', 'aksi', 'detail', 'ip'];

    public static function catat(string $aksi, string $detail = null): void
    {
        static::create([
            'admin'  => Auth::check() ? Auth::user()->email : 'system',
            'aksi'   => $aksi,
            'detail' => $detail,
            'ip'     => Request::ip(),
        ]);
    }
}
