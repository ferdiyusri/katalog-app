@extends('layouts.admin')

@section('page-title', 'Pesan Enquiry')
@section('page-subtitle', 'Semua pesan masuk dari form kontak')

@section('content')

    @if(session('sukses'))
        <div class="alert-success-custom">
            <i class="bi bi-check-circle-fill"></i> {{ session('sukses') }}
        </div>
    @endif

    @php $unread = $enquiries->where('is_read', false)->count(); @endphp

    <!-- Stat -->
    <div class="row g-3 mb-4">
        <div class="col-6 col-md-3">
            <div class="stat-card">
                <div class="stat-card-icon gold"><i class="bi bi-envelope"></i></div>
                <div class="stat-card-value">{{ $enquiries->total() }}</div>
                <div class="stat-card-label">Total Pesan</div>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="stat-card">
                <div class="stat-card-icon red"><i class="bi bi-envelope-exclamation"></i></div>
                <div class="stat-card-value">{{ $unread }}</div>
                <div class="stat-card-label">Belum Dibaca</div>
            </div>
        </div>
    </div>

    <div class="content-card">
        <div class="content-card-header">
            <h2 class="content-card-title">
                Pesan Masuk
                @if($unread > 0)
                    <span style="background: var(--danger); color: #fff; font-size: 0.65rem; font-weight: 700;
                        padding: 0.2rem 0.55rem; border-radius: 20px; margin-left: 0.4rem; vertical-align: middle;">
                        {{ $unread }} Baru
                    </span>
                @endif
            </h2>
            @if($unread > 0)
                <form method="POST" action="{{ route('admin.enquiry.markAllRead') }}">
                    @csrf
                    <button type="submit" class="btn-secondary-custom">
                        <i class="bi bi-check2-all"></i> Tandai Semua Dibaca
                    </button>
                </form>
            @endif
        </div>

        <div class="table-responsive">
            <table class="table table-custom">
                <thead>
                    <tr>
                        <th style="width: 12px;"></th>
                        <th>Pengirim</th>
                        <th>Layanan</th>
                        <th>Pesan</th>
                        <th>Tanggal</th>
                        <th style="text-align: center;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($enquiries as $enq)
                        <tr>
                            <td>
                                @if(!$enq->is_read)
                                    <span style="display:inline-block;width:8px;height:8px;background:var(--danger);border-radius:50%;"></span>
                                @endif
                            </td>
                            <td>
                                <div style="font-weight: {{ !$enq->is_read ? '700' : '500' }}; color: var(--primary);">
                                    {{ $enq->nama }}
                                </div>
                                <div style="font-size: 0.75rem; color: var(--gray); margin-top: 1px;">
                                    {{ $enq->telepon }}
                                </div>
                            </td>
                            <td>
                                <span class="table-badge interior">{{ $enq->layanan }}</span>
                            </td>
                            <td style="max-width: 260px;">
                                <div style="font-size: 0.85rem; color: #555; overflow: hidden;
                                    display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; line-height: 1.5;">
                                    {{ $enq->pesan }}
                                </div>
                            </td>
                            <td style="font-size: 0.8rem; color: var(--gray); white-space: nowrap;">
                                {{ $enq->created_at->format('d M Y') }}<br>
                                <span style="font-size: 0.72rem;">{{ $enq->created_at->format('H:i') }}</span>
                            </td>
                            <td>
                                <div class="d-flex gap-1 justify-content-center">
                                    <a href="{{ route('admin.enquiry.show', $enq) }}"
                                       class="btn-table-action" title="Lihat Detail">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                    <a href="mailto:{{ $enq->email }}"
                                       class="btn-table-action" title="Balas Email">
                                        <i class="bi bi-reply"></i>
                                    </a>
                                    <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $enq->telepon) }}"
                                       target="_blank" class="btn-table-action" title="WhatsApp">
                                        <i class="bi bi-whatsapp"></i>
                                    </a>
                                    <form method="POST" action="{{ route('admin.enquiry.destroy', $enq) }}"
                                          onsubmit="return confirm('Hapus pesan dari {{ addslashes($enq->nama) }}?')">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="btn-table-action delete" title="Hapus">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6">
                                <div class="empty-table">
                                    <i class="bi bi-envelope"></i>
                                    <h4>Belum Ada Pesan</h4>
                                    <p>Pesan dari form kontak website akan muncul di sini.</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($enquiries->hasPages())
            <div style="padding: 1rem 1.5rem; border-top: 1px solid var(--border);">
                {{ $enquiries->links() }}
            </div>
        @endif
    </div>

@endsection
