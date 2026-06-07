@extends('layouts.admin')

@section('page-title', 'Log Aktivitas')
@section('page-subtitle', 'Rekam jejak semua aksi di panel admin')

@section('styles')
<style>
    .log-badge {
        display: inline-flex;
        align-items: center;
        font-size: 0.7rem;
        font-weight: 700;
        letter-spacing: 0.5px;
        text-transform: uppercase;
        padding: 0.25rem 0.65rem;
        border-radius: 20px;
    }
    .log-login   { background: rgba(34,197,94,0.1);   color: #15803d; }
    .log-logout  { background: rgba(245,158,11,0.1);  color: #b45309; }
    .log-hapus   { background: rgba(239,68,68,0.1);   color: #dc2626; }
    .log-tambah  { background: rgba(99,102,241,0.1);  color: #4f46e5; }
    .log-edit    { background: rgba(14,165,233,0.1);  color: #0369a1; }
    .log-default { background: rgba(100,100,120,0.08); color: #6b7280; }
</style>
@endsection

@section('content')

    @if(session('sukses'))
        <div class="alert-success-custom">
            <i class="bi bi-check-circle-fill"></i> {{ session('sukses') }}
        </div>
    @endif

    <div class="content-card">
        <div class="content-card-header">
            <h2 class="content-card-title">Riwayat Aktivitas</h2>
            <form method="POST" action="{{ route('admin.logs.clear') }}"
                  onsubmit="return confirm('Hapus semua log? Tindakan ini tidak dapat dibatalkan.')">
                @csrf @method('DELETE')
                <button type="submit" class="btn-cancel"
                    style="border-color: var(--danger); color: var(--danger);">
                    <i class="bi bi-trash"></i> Hapus Semua
                </button>
            </form>
        </div>

        <div class="table-responsive">
            <table class="table table-custom">
                <thead>
                    <tr>
                        <th>Waktu</th>
                        <th>Admin</th>
                        <th>Aksi</th>
                        <th>Detail</th>
                        <th>IP Address</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($logs as $log)
                        <tr>
                            <td style="white-space: nowrap;">
                                <div style="font-size: 0.82rem; font-weight: 600; color: var(--primary);">
                                    {{ \Carbon\Carbon::parse($log->created_at)->format('d M Y') }}
                                </div>
                                <div style="font-size: 0.72rem; color: var(--gray);">
                                    {{ \Carbon\Carbon::parse($log->created_at)->format('H:i:s') }}
                                </div>
                            </td>
                            <td>
                                <div style="font-size: 0.85rem; font-weight: 600; color: var(--primary);">
                                    {{ $log->admin ?? '—' }}
                                </div>
                            </td>
                            <td>
                                @php
                                    $aksiClass = match(true) {
                                        str_contains($log->aksi, 'Login')  => 'log-login',
                                        str_contains($log->aksi, 'Logout') => 'log-logout',
                                        str_contains($log->aksi, 'Hapus')  => 'log-hapus',
                                        str_contains($log->aksi, 'Tambah') => 'log-tambah',
                                        str_contains($log->aksi, 'Edit')   => 'log-edit',
                                        default                            => 'log-default',
                                    };
                                @endphp
                                <span class="log-badge {{ $aksiClass }}">{{ $log->aksi }}</span>
                            </td>
                            <td style="font-size: 0.85rem; color: #555; max-width: 280px;">
                                {{ $log->detail ?? '—' }}
                            </td>
                            <td style="font-size: 0.8rem; color: var(--gray); font-family: 'Courier New', monospace;">
                                {{ $log->ip ?? '—' }}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5">
                                <div class="empty-table">
                                    <i class="bi bi-shield-check"></i>
                                    <h4>Belum Ada Log</h4>
                                    <p>Aktivitas admin akan tercatat di sini secara otomatis.</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($logs->hasPages())
            <div style="padding: 1rem 1.5rem; border-top: 1px solid var(--border);">
                {{ $logs->links() }}
            </div>
        @endif
    </div>

@endsection
