@extends('layouts.admin')

@section('page-title', 'Kategori Produk')
@section('page-subtitle', 'Kelola kategori yang muncul di filter produk')

@section('content')

    @if(session('sukses'))
        <div class="alert-success-custom">
            <i class="bi bi-check-circle-fill"></i> {{ session('sukses') }}
        </div>
    @endif

    @if($errors->has('delete') || $errors->has('delete_kelompok'))
        <div class="alert-error-custom">
            <i class="bi bi-exclamation-circle-fill"></i>
            {{ $errors->first('delete') ?: $errors->first('delete_kelompok') }}
        </div>
    @endif

    <div class="row g-4">

        {{-- FORM TAMBAH --}}
        <div class="col-lg-4">
            <div class="content-card">
                <div class="content-card-header">
                    <h2 class="content-card-title">Tambah Kategori</h2>
                </div>
                <div class="content-card-body" style="padding: 1.5rem;">
                    <form method="POST" action="{{ route('admin.kategori.store') }}">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label-custom">Nama Kategori *</label>
                            <input type="text" name="name" value="{{ old('name') }}"
                                class="form-control form-control-custom @error('name') is-invalid @enderror"
                                placeholder="Contoh: Villa" required>
                            @error('name')
                                <div style="color:#dc3545; font-size:0.78rem; margin-top:0.3rem;">{{ $message }}</div>
                            @enderror
                            <div class="form-hint">Slug dibuat otomatis dari nama</div>
                        </div>
                        <div class="mb-4">
                            <label class="form-label-custom">Kelompok *</label>
                            <select name="group" class="form-select-custom" required>
                                <option value="">-- Pilih Kelompok --</option>
                                @foreach($kelompokAll as $grp)
                                <option value="{{ $grp->slug }}" {{ old('group') == $grp->slug ? 'selected' : '' }}>{{ $grp->name }}</option>
                                @endforeach
                            </select>
                            <div class="form-hint">Menentukan tab filter di halaman produk</div>
                        </div>
                        <button type="submit" class="btn-primary-custom w-100">
                            <i class="bi bi-plus-lg"></i> Tambah Kategori
                        </button>
                    </form>
                </div>
            </div>

            {{-- KELOLA KELOMPOK --}}
            <div class="content-card mt-4">
                <div class="content-card-header">
                    <h2 class="content-card-title">Kelola Kelompok</h2>
                </div>
                <div class="content-card-body" style="padding:1.25rem 1.5rem;">
                    <form method="POST" action="{{ route('admin.kelompok.store') }}" class="d-flex gap-2 mb-3">
                        @csrf
                        <input type="text" name="name" value="{{ old('name_kelompok') }}"
                            class="form-control-custom" placeholder="Nama kelompok baru" required style="flex:1;">
                        <button type="submit" class="btn-primary-custom" style="white-space:nowrap;">
                            <i class="bi bi-plus-lg"></i>
                        </button>
                    </form>
                    @error('name')<div style="color:#dc3545;font-size:0.78rem;margin-bottom:0.5rem;">{{ $message }}</div>@enderror
                    <ul style="list-style:none;padding:0;margin:0;display:flex;flex-direction:column;gap:0.4rem;">
                        @foreach($kelompokAll as $grp)
                        <li style="display:flex;align-items:center;gap:0.5rem;background:var(--light);border-radius:8px;padding:0.5rem 0.75rem;">
                            <span style="flex:1;font-size:0.875rem;font-weight:600;color:var(--primary);">{{ $grp->name }}</span>
                            <span style="font-size:0.72rem;color:var(--gray);margin-right:0.25rem;">{{ $grp->category_count }} kat</span>
                            <button type="button" class="btn-table-action"
                                onclick="bukaEditKelompok({{ $grp->id }}, '{{ addslashes($grp->name) }}')"
                                title="Edit" style="width:26px;height:26px;font-size:0.72rem;">
                                <i class="bi bi-pencil"></i>
                            </button>
                            <form method="POST" action="{{ route('admin.kelompok.destroy', $grp) }}"
                                  onsubmit="return konfirmasiHapusKelompok('{{ addslashes($grp->name) }}', {{ $grp->category_count }})"
                                  style="display:contents;">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn-table-action delete" title="Hapus kelompok" style="width:26px;height:26px;font-size:0.72rem;">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>

        {{-- DAFTAR KATEGORI --}}
        <div class="col-lg-8">

            @php $colors = ['rgba(99,102,241,0.1)','rgba(239,68,68,0.1)','rgba(34,197,94,0.1)','rgba(245,158,11,0.1)']; $textColors = ['#4f46e5','#dc2626','#16a34a','#b45309']; @endphp

            @foreach($kelompokAll as $i => $grp)
            @php
                $katGrp = $kategori->where('group', $grp->slug);
                $bg     = $colors[$i % count($colors)];
                $clr    = $textColors[$i % count($textColors)];
            @endphp
            <div class="content-card {{ !$loop->last ? 'mb-4' : '' }}">
                <div class="content-card-header">
                    <h2 class="content-card-title">
                        <span style="background:{{ $bg }}; color:{{ $clr }}; font-size:0.7rem; font-weight:700; letter-spacing:1.5px; text-transform:uppercase; padding:0.2rem 0.65rem; border-radius:20px;">
                            {{ $grp->name }}
                        </span>
                        &nbsp; Tab Produk → {{ $grp->name }}
                    </h2>
                </div>
                <div class="table-responsive">
                    <table class="table table-custom">
                        <thead>
                            <tr>
                                <th>Nama</th>
                                <th>Slug</th>
                                <th style="text-align:center;">Jumlah Produk</th>
                                <th style="text-align:center;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($katGrp as $kat)
                                <tr>
                                    <td style="font-weight:600; color:var(--primary);">{{ $kat->name }}</td>
                                    <td style="font-family:monospace; font-size:0.82rem; color:var(--gray);">{{ $kat->slug }}</td>
                                    <td style="text-align:center;">
                                        <span class="badge-count">{{ $kat->product_count }}</span>
                                    </td>
                                    <td>
                                        <div class="d-flex gap-1 justify-content-center">
                                            <button type="button" class="btn-table-action"
                                                onclick="bukaEdit({{ $kat->id }}, '{{ addslashes($kat->name) }}', '{{ $kat->group }}')"
                                                title="Edit">
                                                <i class="bi bi-pencil"></i>
                                            </button>
                                            <form method="POST" action="{{ route('admin.kategori.destroy', $kat) }}"
                                                  onsubmit="return konfirmasiHapusKategori('{{ addslashes($kat->name) }}', {{ $kat->product_count }})">
                                                @csrf @method('DELETE')
                                                <button type="submit" class="btn-table-action delete" title="Hapus">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr><td colspan="4" style="text-align:center; color:var(--gray); padding:1.5rem;">Belum ada kategori {{ $grp->name }}.</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            @endforeach

        </div>
    </div>

    {{-- MODAL EDIT --}}
    <div class="modal fade" id="modalEdit" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content" style="border-radius:12px; border:none; overflow:hidden; box-shadow:0 20px 60px rgba(0,0,0,0.2);">
                <form method="POST" id="formEdit">
                    @csrf @method('PUT')
                    <div class="modal-header" style="background:var(--primary); border-bottom:2px solid var(--accent); padding:1.25rem 1.75rem;">
                        <h5 class="modal-title" style="font-family:'Playfair Display',serif; color:#fff; font-size:1rem; font-weight:700;">
                            <i class="bi bi-pencil me-2" style="color:var(--accent);"></i> Edit Kategori
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" style="filter:invert(1) opacity(0.6);"></button>
                    </div>
                    <div class="modal-body" style="padding:1.75rem;">
                        <div class="mb-3">
                            <label class="form-label-custom">Nama Kategori *</label>
                            <input type="text" name="name" id="editName"
                                class="form-control form-control-custom" required>
                        </div>
                        <div class="mb-2">
                            <label class="form-label-custom">Kelompok *</label>
                            <select name="group" id="editGroup" class="form-select-custom">
                                @foreach($kelompokAll as $grp)
                                <option value="{{ $grp->slug }}">{{ $grp->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer" style="padding:1rem 1.75rem; gap:0.5rem;">
                        <button type="button" class="btn-cancel" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn-primary-custom">
                            <i class="bi bi-check-lg"></i> Simpan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- MODAL EDIT KELOMPOK --}}
    <div class="modal fade" id="modalEditKelompok" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-sm">
            <div class="modal-content" style="border-radius:12px;border:none;overflow:hidden;box-shadow:0 20px 60px rgba(0,0,0,0.2);">
                <form method="POST" id="formEditKelompok">
                    @csrf @method('PUT')
                    <div class="modal-header" style="background:var(--primary);border-bottom:2px solid var(--accent);padding:1rem 1.5rem;">
                        <h5 class="modal-title" style="font-family:'Playfair Display',serif;color:#fff;font-size:0.95rem;font-weight:700;">
                            <i class="bi bi-pencil me-2" style="color:var(--accent);"></i> Edit Kelompok
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" style="filter:invert(1) opacity(0.6);"></button>
                    </div>
                    <div class="modal-body" style="padding:1.5rem;">
                        <label class="form-label-custom">Nama Kelompok *</label>
                        <input type="text" name="name" id="editKelompokName" class="form-control-custom" required>
                        <div class="form-hint">Slug otomatis diperbarui. Semua kategori ikut diperbarui.</div>
                    </div>
                    <div class="modal-footer" style="padding:0.75rem 1.5rem;gap:0.5rem;">
                        <button type="button" class="btn-cancel" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn-primary-custom">
                            <i class="bi bi-check-lg"></i> Simpan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection

@section('scripts')
<script>
    function bukaEdit(id, name, group) {
        document.getElementById('editName').value  = name;
        document.getElementById('editGroup').value = group;
        document.getElementById('formEdit').action = '/admin/kategori/' + id;
        new bootstrap.Modal(document.getElementById('modalEdit')).show();
    }

    function bukaEditKelompok(id, name) {
        document.getElementById('editKelompokName').value = name;
        document.getElementById('formEditKelompok').action = '/admin/kelompok/' + id;
        new bootstrap.Modal(document.getElementById('modalEditKelompok')).show();
    }

    function konfirmasiHapusKategori(nama, jumlahProduk) {
        if (jumlahProduk > 0) {
            return confirm('Hapus kategori "' + nama + '"?\n\nPerhatian: ' + jumlahProduk + ' produk yang menggunakan kategori ini akan kehilangan kategorinya.\n\nLanjutkan?');
        }
        return confirm('Hapus kategori "' + nama + '"?');
    }

    function konfirmasiHapusKelompok(nama, jumlahKat) {
        if (jumlahKat > 0) {
            return confirm('Hapus kelompok "' + nama + '" beserta ' + jumlahKat + ' kategori di dalamnya?\n\nKategori yang masih memiliki produk tidak akan bisa dihapus.');
        }
        return confirm('Hapus kelompok "' + nama + '"?');
    }
</script>
@endsection
