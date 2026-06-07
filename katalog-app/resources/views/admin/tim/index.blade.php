@extends('layouts.admin')

@section('page-title', 'Kelola Tim')
@section('page-subtitle', 'Tambah, ubah, atau hapus anggota tim yang tampil di halaman Tim Kami')

@section('content')

    @if(session('sukses'))
        <div class="alert-success-custom">
            <i class="bi bi-check-circle-fill"></i> {{ session('sukses') }}
        </div>
    @endif

    <div class="row g-4">

        {{-- FORM TAMBAH --}}
        <div class="col-lg-4">
            <div class="content-card">
                <div class="content-card-header">
                    <h2 class="content-card-title">Tambah Anggota</h2>
                </div>
                <div class="content-card-body" style="padding:1.5rem;">
                    <form method="POST" action="{{ route('admin.tim.store') }}" enctype="multipart/form-data">
                        @csrf

                        {{-- Avatar upload --}}
                        <div class="mb-3">
                            <label class="form-label-custom">Foto Profil</label>
                            <div id="addAvatarWrap" style="position:relative;width:80px;height:80px;margin-bottom:0.5rem;cursor:pointer;" onclick="document.getElementById('addPhotoInput').click()">
                                <div id="addAvatarPreview" style="width:80px;height:80px;border-radius:50%;background:rgba(201,169,110,0.12);border:2px dashed rgba(201,169,110,0.4);display:flex;align-items:center;justify-content:center;overflow:hidden;">
                                    <i class="bi bi-camera" style="font-size:1.4rem;color:var(--accent);opacity:0.6;"></i>
                                </div>
                                <div style="position:absolute;bottom:0;right:0;width:22px;height:22px;background:var(--accent);border-radius:50%;display:flex;align-items:center;justify-content:center;">
                                    <i class="bi bi-plus" style="font-size:0.75rem;color:var(--primary);font-weight:700;"></i>
                                </div>
                            </div>
                            <input type="file" name="photo" id="addPhotoInput" accept="image/*" style="display:none;">
                            <div class="form-hint">Klik foto untuk ganti · JPG/PNG maks 2MB</div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label-custom">Nama Lengkap *</label>
                            <input type="text" name="name" value="{{ old('name') }}"
                                class="form-control-custom @error('name') is-invalid @enderror"
                                placeholder="Contoh: Budi Santoso" required>
                            @error('name')
                                <div style="color:#dc3545;font-size:0.78rem;margin-top:0.3rem;">{{ $message }}</div>
                            @enderror
                            <div class="form-hint">Inisial dibuat otomatis dari nama</div>
                        </div>

                        <div class="mb-4">
                            <label class="form-label-custom">Jabatan *</label>
                            <input type="text" name="role" value="{{ old('role') }}"
                                class="form-control-custom @error('role') is-invalid @enderror"
                                placeholder="Contoh: Project Manager" required>
                            @error('role')
                                <div style="color:#dc3545;font-size:0.78rem;margin-top:0.3rem;">{{ $message }}</div>
                            @enderror
                        </div>

                        <button type="submit" class="btn-primary-custom w-100">
                            <i class="bi bi-plus-lg"></i> Tambah Anggota
                        </button>
                    </form>
                </div>
            </div>
        </div>

        {{-- DAFTAR TIM --}}
        <div class="col-lg-8">
            <div class="content-card">
                <div class="content-card-header">
                    <h2 class="content-card-title">Daftar Anggota Tim</h2>
                    <span style="font-size:0.78rem;color:var(--gray);">{{ $tim->count() }} anggota</span>
                </div>
                <div class="table-responsive">
                    <table class="table table-custom">
                        <thead>
                            <tr>
                                <th>Foto</th>
                                <th>Nama</th>
                                <th>Jabatan</th>
                                <th style="text-align:center;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($tim as $anggota)
                                <tr>
                                    <td>
                                        @if($anggota->photo)
                                            <img src="{{ asset('storage/' . $anggota->photo) }}"
                                                 style="width:40px;height:40px;border-radius:50%;object-fit:cover;border:2px solid rgba(201,169,110,0.25);">
                                        @else
                                            <div style="width:40px;height:40px;background:rgba(201,169,110,0.12);border-radius:50%;display:flex;align-items:center;justify-content:center;font-family:'Playfair Display',serif;font-weight:700;font-size:0.82rem;color:var(--accent);">
                                                {{ $anggota->initials }}
                                            </div>
                                        @endif
                                    </td>
                                    <td style="font-weight:600;color:var(--primary);">{{ $anggota->name }}</td>
                                    <td style="font-size:0.82rem;color:var(--gray);">{{ $anggota->role }}</td>
                                    <td>
                                        <div class="d-flex gap-1 justify-content-center">
                                            <button type="button" class="btn-table-action"
                                                onclick="bukaEdit({{ $anggota->id }}, '{{ addslashes($anggota->name) }}', '{{ addslashes($anggota->role) }}', '{{ $anggota->photo ? asset('storage/'.$anggota->photo) : '' }}')"
                                                title="Edit">
                                                <i class="bi bi-pencil"></i>
                                            </button>
                                            <form method="POST" action="{{ route('admin.tim.destroy', $anggota) }}"
                                                  onsubmit="return confirm('Hapus anggota {{ addslashes($anggota->name) }}?')">
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
                                    <td colspan="4" style="text-align:center;color:var(--gray);padding:2rem;">
                                        Belum ada anggota tim.
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
                <form method="POST" id="formEdit" enctype="multipart/form-data">
                    @csrf @method('PUT')
                    <div class="modal-header" style="background:var(--primary);border-bottom:2px solid var(--accent);padding:1.25rem 1.75rem;">
                        <h5 class="modal-title" style="font-family:'Playfair Display',serif;color:#fff;font-size:1rem;font-weight:700;">
                            <i class="bi bi-pencil me-2" style="color:var(--accent);"></i> Edit Anggota Tim
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" style="filter:invert(1) opacity(0.6);"></button>
                    </div>
                    <div class="modal-body" style="padding:1.75rem;">

                        {{-- Avatar preview & upload --}}
                        <div class="mb-3 d-flex align-items-center gap-3">
                            <div style="position:relative;cursor:pointer;flex-shrink:0;" onclick="document.getElementById('editPhotoInput').click()">
                                <div id="editAvatarPreview" style="width:64px;height:64px;border-radius:50%;background:rgba(201,169,110,0.12);border:2px dashed rgba(201,169,110,0.4);display:flex;align-items:center;justify-content:center;overflow:hidden;">
                                    <i class="bi bi-person" style="font-size:1.6rem;color:var(--accent);opacity:0.5;"></i>
                                </div>
                                <div style="position:absolute;bottom:0;right:0;width:20px;height:20px;background:var(--accent);border-radius:50%;display:flex;align-items:center;justify-content:center;">
                                    <i class="bi bi-camera" style="font-size:0.6rem;color:var(--primary);"></i>
                                </div>
                            </div>
                            <div>
                                <input type="file" name="photo" id="editPhotoInput" accept="image/*" style="display:none;">
                                <div style="font-size:0.78rem;color:var(--gray);">Klik foto untuk ganti</div>
                                <div style="font-size:0.72rem;color:var(--gray);opacity:0.7;">JPG/PNG maks 2MB · Kosongkan jika tidak berubah</div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label-custom">Nama Lengkap *</label>
                            <input type="text" name="name" id="editName" class="form-control-custom" required>
                        </div>
                        <div class="mb-2">
                            <label class="form-label-custom">Jabatan *</label>
                            <input type="text" name="role" id="editRole" class="form-control-custom" required>
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
    // Add form: preview foto sebelum upload
    document.getElementById('addPhotoInput').addEventListener('change', function() {
        if (this.files && this.files[0]) {
            const reader = new FileReader();
            reader.onload = e => {
                const wrap = document.getElementById('addAvatarPreview');
                wrap.innerHTML = '<img src="' + e.target.result + '" style="width:100%;height:100%;object-fit:cover;object-position:top center;">';
            };
            reader.readAsDataURL(this.files[0]);
        }
    });

    // Edit modal: preview foto & isi data
    document.getElementById('editPhotoInput').addEventListener('change', function() {
        if (this.files && this.files[0]) {
            const reader = new FileReader();
            reader.onload = e => {
                const wrap = document.getElementById('editAvatarPreview');
                wrap.innerHTML = '<img src="' + e.target.result + '" style="width:100%;height:100%;object-fit:cover;object-position:top center;">';
            };
            reader.readAsDataURL(this.files[0]);
        }
    });

    function bukaEdit(id, name, role, photoUrl) {
        document.getElementById('editName').value = name;
        document.getElementById('editRole').value = role;
        document.getElementById('formEdit').action = '/admin/tim/' + id;

        const wrap = document.getElementById('editAvatarPreview');
        if (photoUrl) {
            wrap.innerHTML = '<img src="' + photoUrl + '" style="width:100%;height:100%;object-fit:cover;object-position:top center;">';
        } else {
            wrap.innerHTML = '<i class="bi bi-person" style="font-size:1.6rem;color:var(--accent);opacity:0.5;"></i>';
        }

        document.getElementById('editPhotoInput').value = '';
        new bootstrap.Modal(document.getElementById('modalEdit')).show();
    }
</script>
@endsection
