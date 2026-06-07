@extends('layouts.admin')

@section('page-title', 'Data Registrasi')
@section('page-subtitle', 'Daftar pengguna yang mendaftar untuk melihat harga')

@section('content')
<div class="dashboard-content">

    @if(session('success'))
    <div class="alert-success-custom">
        <i class="bi bi-check-circle-fill" style="color:#28a745;"></i> {{ session('success') }}
    </div>
    @endif

    <!-- Stat Cards -->
    <div class="row g-4 mb-4">
        <div class="col-6 col-lg-3">
            <div class="stat-card">
                <div class="stat-card-icon gold"><i class="bi bi-people"></i></div>
                <div class="stat-card-value">{{ $registrasi->count() }}</div>
                <div class="stat-card-label">Total Pendaftar</div>
            </div>
        </div>
        <div class="col-6 col-lg-3">
            <div class="stat-card">
                <div class="stat-card-icon blue"><i class="bi bi-calendar-check"></i></div>
                <div class="stat-card-value">{{ $registrasi->where('created_at', '>=', now()->startOfMonth())->count() }}</div>
                <div class="stat-card-label">Bulan Ini</div>
            </div>
        </div>
    </div>

    <!-- Tabel + Form Email -->
    <form method="POST" action="{{ route('admin.registrasi.kirimEmail') }}" id="formEmail">
        @csrf
        <div class="content-card">
            <div class="content-card-header">
                <h3 class="content-card-title">Daftar Pendaftar</h3>
                <div class="d-flex gap-2 align-items-center flex-wrap">
                    <label style="font-size:0.82rem; color:var(--gray); margin:0; display:flex; align-items:center; gap:0.4rem;">
                        <input type="checkbox" id="pilihSemua" style="accent-color:var(--accent);"> Pilih Semua
                    </label>
                    <button type="button" class="btn-add" id="btnKirimEmail" disabled
                            data-bs-toggle="modal" data-bs-target="#modalEmail">
                        <i class="bi bi-envelope"></i> Kirim Email ke Terpilih
                    </button>
                </div>
            </div>

            @if($registrasi->count())
            <div class="table-responsive">
                <table class="table table-custom">
                    <thead>
                        <tr>
                            <th width="40"></th>
                            <th>#</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>No. Telepon</th>
                            <th>Tanggal Daftar</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($registrasi as $i => $r)
                        <tr>
                            <td>
                                <input type="checkbox" name="ids[]" value="{{ $r->id }}"
                                       class="cb-item" style="accent-color:var(--accent);">
                            </td>
                            <td style="color:var(--gray); font-size:0.82rem;">{{ $i + 1 }}</td>
                            <td style="font-weight:600; color:var(--primary);">{{ $r->nama }}</td>
                            <td>{{ $r->email }}</td>
                            <td>{{ $r->telpon }}</td>
                            <td style="font-size:0.82rem; color:var(--gray);">{{ $r->created_at->format('d M Y, H:i') }}</td>
                            <td>
                                <div class="d-flex gap-1">
                                    <button type="button" class="btn-table-action btn-kirim-satu" title="Kirim Email"
                                            data-id="{{ $r->id }}" data-nama="{{ $r->nama }}"
                                            data-bs-toggle="modal" data-bs-target="#modalEmail">
                                        <i class="bi bi-envelope"></i>
                                    </button>
                                    <form method="POST" action="{{ route('admin.registrasi.destroy', $r) }}"
                                          onsubmit="return confirm('Hapus data ini?');"
                                          style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn-table-action delete" title="Hapus">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @else
            <div class="empty-table">
                <i class="bi bi-inbox"></i>
                <h4>Belum Ada Pendaftar</h4>
                <p>Pendaftar akan muncul di sini ketika ada pengunjung yang mendaftar untuk melihat harga.</p>
            </div>
            @endif
        </div>

        <!-- Modal Kirim Email -->
        <div class="modal fade" id="modalEmail" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content" style="border-radius:14px; overflow:hidden; border:none; box-shadow:0 20px 60px rgba(0,0,0,0.2);">
                    <div class="modal-header" style="background:var(--primary); border-bottom:2px solid var(--accent); padding:1.25rem 1.75rem;">
                        <h5 class="modal-title" style="font-family:'Playfair Display',serif; color:#fff; font-size:1.1rem; font-weight:700;">
                            <i class="bi bi-envelope me-2" style="color:var(--accent);"></i>
                            Kirim Email — <span id="labelPenerima" style="color:var(--accent);"></span>
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" style="filter:invert(1) opacity(0.6);"></button>
                    </div>
                    <div class="modal-body" style="background:var(--light); padding:1.75rem;">
                        <div class="mb-3">
                            <label class="form-label-custom">Subjek Email</label>
                            <input type="text" name="subjek" class="form-control-custom"
                                   placeholder="Contoh: Penawaran Spesial HIKO STUDIO" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label-custom">Isi Pesan</label>
                            <textarea name="pesan" class="form-control-custom" rows="8"
                                      style="resize:vertical;"
                                      placeholder="Tulis pesan Anda di sini..." required></textarea>
                            <div class="form-hint">Email akan dikirim atas nama HIKO STUDIO dengan tanda tangan otomatis di bagian bawah.</div>
                        </div>
                    </div>
                    <div class="modal-footer" style="background:var(--light); border-top:1px solid rgba(0,0,0,0.07); padding:1rem 1.75rem; gap:0.5rem;">
                        <button type="button" class="btn-cancel" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn-add">
                            <i class="bi bi-send"></i> Kirim Email
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </form>

</div>
@endsection

@section('scripts')
<script>
    const pilihSemua = document.getElementById('pilihSemua');
    const cbItems = document.querySelectorAll('.cb-item');
    const btnKirimEmail = document.getElementById('btnKirimEmail');
    const labelPenerima = document.getElementById('labelPenerima');

    function updateBtn() {
        const terpilih = document.querySelectorAll('.cb-item:checked').length;
        btnKirimEmail.disabled = terpilih === 0;
        if (labelPenerima && !labelPenerima.dataset.single) {
            labelPenerima.textContent = terpilih > 0 ? terpilih + ' Penerima' : '';
        }
    }

    pilihSemua && pilihSemua.addEventListener('change', function() {
        cbItems.forEach(cb => cb.checked = this.checked);
        updateBtn();
    });

    cbItems.forEach(cb => cb.addEventListener('change', function() {
        pilihSemua.checked = [...cbItems].every(c => c.checked);
        delete labelPenerima.dataset.single;
        updateBtn();
    }));

    document.querySelectorAll('.btn-kirim-satu').forEach(btn => {
        btn.addEventListener('click', function() {
            const id = this.dataset.id;
            const nama = this.dataset.nama;
            cbItems.forEach(cb => cb.checked = false);
            const cb = document.querySelector(`.cb-item[value="${id}"]`);
            if (cb) cb.checked = true;
            labelPenerima.textContent = nama;
            labelPenerima.dataset.single = true;
            btnKirimEmail.disabled = false;
        });
    });
</script>
@endsection
