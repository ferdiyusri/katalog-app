<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\EnquiryMail;
use App\Models\Enquiry;

class KontakController extends Controller
{
    public function index()
    {
        return view('kontak.index');
    }

    public function kirim(Request $request)
    {
        // Honeypot: bot akan mengisi field ini, manusia tidak
        if ($request->filled('_hp')) {
            return back()->with('sukses', 'Pesan Anda berhasil dikirim. Tim kami akan menghubungi Anda segera.');
        }

        $request->validate([
            'nama'    => 'required|string|max:255',
            'email'   => 'required|email|max:255',
            'telepon' => 'required|string|max:20',
            'layanan' => 'required|string',
            'pesan'   => 'required|string|max:2000',
        ]);

        Enquiry::create($request->only('nama', 'email', 'telepon', 'layanan', 'pesan'));

        Mail::to(env('ADMIN_EMAIL', 'info@hikostudio.com'))->send(new EnquiryMail($request->all()));

        return back()->with('sukses', 'Pesan Anda berhasil dikirim. Tim kami akan menghubungi Anda segera.');
    }
}
