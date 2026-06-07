<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\KirimEmailPelanggan;
use App\Models\AdminLog;
use App\Models\PriceRegistration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class RegistrasiController extends Controller
{
    public function index()
    {
        $registrasi = PriceRegistration::latest()->get();
        return view('admin.registrasi.index', compact('registrasi'));
    }

    public function kirimEmail(Request $request)
    {
        $request->validate([
            'subjek' => 'required|string|max:255',
            'pesan'  => 'required|string',
            'ids'    => 'required|array|min:1',
            'ids.*'  => 'exists:price_registrations,id',
        ]);

        $penerima = PriceRegistration::whereIn('id', $request->ids)->get();
        $berhasil = 0;

        foreach ($penerima as $p) {
            try {
                Mail::to($p->email)->send(
                    new KirimEmailPelanggan($p->nama, $request->subjek, $request->pesan)
                );
                $berhasil++;
            } catch (\Exception) {
                // lanjut ke penerima berikutnya jika gagal
            }
        }

        AdminLog::catat('Kirim Email Registrasi', "Subjek: {$request->subjek} — {$berhasil} penerima");

        return back()->with('success', "Email berhasil dikirim ke {$berhasil} penerima.");
    }

    public function destroy(PriceRegistration $registrasi)
    {
        AdminLog::catat('Hapus Registrasi', "Nama: {$registrasi->nama} ({$registrasi->email})");
        $registrasi->delete();
        return back()->with('success', 'Data berhasil dihapus.');
    }
}
