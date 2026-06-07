@extends('layouts.admin')

@section('page-title', 'Detail Pesan')
@section('page-subtitle', 'Enquiry dari ' . $enquiry->nama)

@section('content')
<div class="dashboard-content">

    <div class="mb-3">
        <a href="{{ route('admin.enquiry.index') }}" class="btn-cancel" style="font-size: 0.8rem; padding: 0.5rem 1.2rem;">
            <i class="bi bi-arrow-left me-1"></i> Kembali
        </a>
    </div>

    <div class="row g-4">
        <div class="col-lg-8">
            <div class="content-card">
                <div class="content-card-header">
                    <h2 class="content-card-title">Isi Pesan</h2>
                    <span style="font-size: 0.78rem; color: var(--gray);">
                        {{ $enquiry->created_at->format('d M Y, H:i') }} WIB
                    </span>
                </div>
                <div class="content-card-body">
                    <div style="background: var(--light); padding: 1.5rem; border-left: 3px solid var(--accent);
                        font-size: 0.95rem; color: #333; line-height: 1.8; white-space: pre-line;">
                        {{ $enquiry->pesan }}
                    </div>

                    <div class="mt-4 d-flex gap-2 flex-wrap">
                        <a href="mailto:{{ $enquiry->email }}" class="btn-submit" style="text-decoration: none;">
                            <i class="bi bi-reply"></i> Balas via Email
                        </a>
                        <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $enquiry->telepon) }}"
                           target="_blank" class="btn-submit"
                           style="background: #25D366; text-decoration: none;">
                            <i class="bi bi-whatsapp"></i> Balas via WhatsApp
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="content-card">
                <div class="content-card-header">
                    <h2 class="content-card-title">Info Pengirim</h2>
                </div>
                <div class="content-card-body" style="padding: 1.5rem;">

                    <div style="margin-bottom: 1.25rem;">
                        <div style="font-size: 0.68rem; font-weight: 700; letter-spacing: 1.5px; text-transform: uppercase;
                            color: var(--accent); margin-bottom: 4px;">Nama</div>
                        <div style="font-size: 0.95rem; font-weight: 600; color: var(--primary);">{{ $enquiry->nama }}</div>
                    </div>

                    <div style="margin-bottom: 1.25rem;">
                        <div style="font-size: 0.68rem; font-weight: 700; letter-spacing: 1.5px; text-transform: uppercase;
                            color: var(--accent); margin-bottom: 4px;">Email</div>
                        <a href="mailto:{{ $enquiry->email }}"
                           style="font-size: 0.9rem; color: #3498db; text-decoration: none;">{{ $enquiry->email }}</a>
                    </div>

                    <div style="margin-bottom: 1.25rem;">
                        <div style="font-size: 0.68rem; font-weight: 700; letter-spacing: 1.5px; text-transform: uppercase;
                            color: var(--accent); margin-bottom: 4px;">Telepon</div>
                        <div style="font-size: 0.9rem; color: #333;">{{ $enquiry->telepon }}</div>
                    </div>

                    <div style="margin-bottom: 1.25rem;">
                        <div style="font-size: 0.68rem; font-weight: 700; letter-spacing: 1.5px; text-transform: uppercase;
                            color: var(--accent); margin-bottom: 4px;">Layanan yang Diminati</div>
                        <span class="table-badge interior">{{ $enquiry->layanan }}</span>
                    </div>

                    <div>
                        <div style="font-size: 0.68rem; font-weight: 700; letter-spacing: 1.5px; text-transform: uppercase;
                            color: var(--accent); margin-bottom: 4px;">Status</div>
                        @if($enquiry->is_read)
                            <span style="font-size: 0.78rem; color: #27ae60; font-weight: 600;">
                                <i class="bi bi-check-circle-fill me-1"></i> Sudah Dibaca
                            </span>
                        @else
                            <span style="font-size: 0.78rem; color: var(--warning); font-weight: 600;">
                                <i class="bi bi-circle-fill me-1"></i> Belum Dibaca
                            </span>
                        @endif
                    </div>

                    <hr style="border-color: rgba(0,0,0,0.06); margin: 1.5rem 0;">

                    <form method="POST" action="{{ route('admin.enquiry.destroy', $enquiry) }}"
                          onsubmit="return confirm('Hapus pesan ini?')">
                        @csrf @method('DELETE')
                        <button type="submit" class="btn-cancel delete"
                            style="border-color: var(--danger); color: var(--danger); width: 100%; justify-content: center;">
                            <i class="bi bi-trash me-1"></i> Hapus Pesan
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection
