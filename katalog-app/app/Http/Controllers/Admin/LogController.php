<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AdminLog;

class LogController extends Controller
{
    public function index()
    {
        $logs = AdminLog::orderByDesc('created_at')->paginate(50);
        return view('admin.logs.index', compact('logs'));
    }

    public function clear()
    {
        AdminLog::truncate();
        return redirect()->route('admin.logs.index')->with('sukses', 'Semua log berhasil dihapus.');
    }
}
