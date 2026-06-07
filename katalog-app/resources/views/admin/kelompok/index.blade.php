@extends('layouts.admin')

@section('page-title', 'Kelola Kelompok')
@section('page-subtitle', 'Tambah, ubah, atau hapus kelompok kategori produk')

@section('content')

    @if(session('sukses'))
        <div class="alert-success-custom">
            <i class="bi bi-check-circle-fill"></i> {{ session('sukses') }}
        </div>
    @endif

    @if($errors->has('delete'))
        <div class="alert-error-custom">
            <i class="bi bi-exclamation-circle-fill"></i> {{ $errors->first('delete') }}
        </div>
    @endif

    <div class="row g-4">

        {{-- FORM TAMBAH --}}
        <div class="col-lg-4">
            <div class="content-card">
                <div class="content-card-header">
                    <h2 class="content-card-title">Tambah Kelompok</h2>
                </div>
                <div class="content-card-body" style="padding:1.5rem;">
                    <form method="POST" action="{{ route('admin.kelompok.store') }}">
                        @csrf
                        <div class="mb-4">
                            <label class="form-label-custom">Nama Kelompok *</label>
                            <input type="text" name="name" value="{{ old('name') }}"
                                class="form-control-custom @error('name') is-invalid @enderror"
                                placeholder="Contoh: Outdoor" required>
                            @error('name')
                                <div style="color:#dc3545;font-size:0.78rem;margin-top:0.3rem;">{{ $message }}</div>
                            @enderror
                            <div class="form-hint">Slug dibuat otomatis dari nama</div>
                        </div>
                        <button type="submit" class="btn-primary-custom w-100">
                            <i class="bi bi-plus-lg"></i> Tambah Kelompok
                        </button>
                    </form>
                </div>
            </div>
        </div>

        {{-- DAFTAR KELOMPOK --}}
        <div class="col-lg-8">
            <div class="content-card">
                <div class="content-card-header">
                    <h2 class="content-card-title">Daftar Kelompok</h2>
                    <span style="font-size:0.78rem;color:var(--gray);">{{ $kelompok->count() }} kelompok</span>
                </div>
                <div class="table-responsive">
                    <table class="table table-custom">
                        <thead>
                            <tr>
                                <th>Nama</th>
                                <th>Slug</th>
                                <th style="text-align:center;">Jumlah Kategori</th>
                                <th style="text-align:center;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($kelompok as $grp)
                                <tr>
                                    <td style="font-weight:600;color:var(--primary);">{{ $grp->name }}</td>
                                    <td style="font-family:monospace;font-size:0.82rem;color:var(--gray);">{{ $grp->slug }}</td>
                                    <td style="text-align:center;">
                                        <span class="badge-count">{{ $grp->category_count }}</span>
                                    </td>
                                    <td>
                                        <div class="d-flex gap-1 justify-content-center">
                                            <button type="button" class="btn-table-action"
                                                onclick="bukaEdit({{ $grp->id }}, '{{ addslashes($grp->name) }}')"
                                                title="Edit">
                                                <i class="bi bi-pencil"></i>
                                            </button>
                                            @if($grp->category_count == 0)
                                            <form method="POST" action="{{ route('admin.kelompok.destroy', $grp) }}"
                                                  onsubmit="return confirm('Hapus kelompok \"{{ addslashes($grp->name) }}\"?')">
                                                @csrf @method('DELETE')
                                                <button type="submit" class="btn-table-action delete" title="Hapus">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </form>
                                            @else
                                            <button class="btn-table-action" disabled title="Masih ada kategori di kelompok ini"
                                                    style="opacity:0.3;cursor:not-allowed;">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" style="text-align:center;color:var(--gray);padding:2rem;">
                                        Belum ada kelompok.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    {{-- MODAL EDIT --}}
    <div class="modal fade" id="modalEdit" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content" style="border-radius:12px;border:none;overflow:hidden;box-shadow:0 20px 60px rgba(0,0,0,0.2);">
                <form method="POST" id="formEdit">
                    @csrf @method('PUT')
                    <div class="modal-header" style="background:var(--primary);border-bottom:2px solid var(--accent);padding:1.25rem 1.75rem;">
                        <h5 class="modal-title" style="font-family:'Playfair Display',serif;color:#fff;font-size:1rem;font-weight:700;">
                            <i class="bi bi-pencil me-2" style="color:var(--accent);"></i> Edit Kelompok
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" style="filter:invert(1) opacity(0.6);"></button>
                    </div>
                    <div class="modal-body" style="padding:1.75rem;">
                        <div class="mb-2">
                            <label class="form-label-custom">Nama Kelompok *</label>
                            <input type="text" name="name" id="editName"
                                class="form-control-custom" required>
                            <div class="form-hint">Slug akan diperbarui otomatis. Semua kategori yang tergabung ikut diperbarui.</div>
                        </div>
                    </div>
                    <div class="modal-footer" style="padding:1rem 1.75rem;gap:0.5rem;">
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
    function bukaEdit(id, name) {
        document.getElementById('editName').value = name;
        document.getElementById('formEdit').action = '/admin/kelompok/' + id;
        new bootstrap.Modal(document.getElementById('modalEdit')).show();
    }
</script>
@endsection
