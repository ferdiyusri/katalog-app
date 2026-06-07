<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AdminLog;
use App\Models\Enquiry;

class EnquiryController extends Controller
{
    public function index()
    {
        $enquiries = Enquiry::latest()->paginate(20);
        return view('admin.enquiry.index', compact('enquiries'));
    }

    public function show(Enquiry $enquiry)
    {
        $enquiry->update(['is_read' => true]);
        AdminLog::catat('Lihat Enquiry', "Dari: {$enquiry->nama} — Layanan: {$enquiry->layanan}");
        return view('admin.enquiry.show', compact('enquiry'));
    }

    public function destroy(Enquiry $enquiry)
    {
        AdminLog::catat('Hapus Enquiry', "Dari: {$enquiry->nama} — Layanan: {$enquiry->layanan}");
        $enquiry->delete();
        return redirect()->route('admin.enquiry.index')->with('sukses', 'Pesan berhasil dihapus.');
    }

    public function markAllRead()
    {
        $jumlah = Enquiry::where('is_read', false)->count();
        Enquiry::where('is_read', false)->update(['is_read' => true]);
        AdminLog::catat('Tandai Semua Dibaca', "{$jumlah} pesan enquiry ditandai dibaca");
        return back()->with('sukses', 'Semua pesan ditandai sudah dibaca.');
    }
}
