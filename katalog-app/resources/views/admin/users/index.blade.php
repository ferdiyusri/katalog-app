@extends('layouts.admin')
@section('page-title', 'Kelola Admin')
@section('page-subtitle', 'Daftar akun yang dapat mengakses panel admin')

@section('content')
<div class="dashboard-content">

    @if(session('sukses'))
    <div class="alert-success-custom">
        <i class="bi bi-check-circle-fill" style="color:#28a745;"></i> {{ session('sukses') }}
    </div>
    @endif

    @if(session('error'))
    <div class="alert-success-custom" style="background:rgba(239,68,68,0.08); border-left-color:#ef4444;">
        <i class="bi bi-exclamation-circle-fill" style="color:#ef4444;"></i> {{ session('error') }}
    </div>
    @endif

    <!-- Stat -->
    <div class="row g-4 mb-4">
        <div class="col-6 col-lg-3">
            <div class="stat-card">
                <div class="stat-card-icon gold"><i class="bi bi-person-badge"></i></div>
                <div class="stat-card-value">{{ $users->count() }}</div>
                <div class="stat-card-label">Total Admin</div>
            </div>
        </div>
    </div>

    <div class="row g-4">

        <!-- Tabel daftar user -->
        <div class="col-lg-8">
            <div class="content-card">
                <div class="content-card-header">
                    <h3 class="content-card-title">Daftar Akun Admin</h3>
                </div>

                @if($users->count())
                <div class="table-responsive">
                    <table class="table table-custom">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nama</th>
                                <th>Email</th>
                                <th>Hak Akses</th>
                                <th>Terdaftar</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($users as $i => $u)
                            <tr>
                                <td style="color:var(--gray); font-size:0.82rem;">{{ $i + 1 }}</td>
                                <td>
                                    <div style="display:flex; align-items:center; gap:0.75rem;">
                                        <div style="width:34px; height:34px; border-radius:50%; background:rgba(201,169,110,0.12); border:1px solid rgba(201,169,110,0.25); display:flex; align-items:center; justify-content:center; font-family:'Playfair Display',serif; font-size:0.82rem; font-weight:700; color:var(--accent); flex-shrink:0;">
                                            {{ strtoupper(substr($u->name, 0, 1)) }}
                                        </div>
                                        <div>
                                            <div style="font-weight:600; color:var(--primary); font-size:0.88rem;">{{ $u->name }}</div>
                                            @if($u->id === auth()->user()->id)
                                            <span style="font-size:0.68rem; background:rgba(201,169,110,0.1); color:var(--accent); padding:0.1rem 0.5rem; border-radius:10px; font-weight:600; letter-spacing:0.5px;">Anda</span>
                                            @endif
                                        </div>
                                    </div>
                                </td>
                                <td style="font-size:0.88rem; color:var(--gray);">{{ $u->email }}</td>
                                <td>
                                    @if($u->role === 'admin')
                                    <span style="font-size:0.7rem; font-weight:700; letter-spacing:0.5px; background:rgba(201,169,110,0.12); color:var(--accent); border:1px solid rgba(201,169,110,0.25); padding:0.2rem 0.65rem; border-radius:20px;">Admin</span>
                                    @else
                                    <span style="font-size:0.7rem; font-weight:700; letter-spacing:0.5px; background:rgba(138,143,168,0.1); color:var(--gray); border:1px solid rgba(138,143,168,0.2); padding:0.2rem 0.65rem; border-radius:20px;">Karyawan</span>
                                    @endif
                                </td>
                                <td style="font-size:0.82rem; color:var(--gray);">{{ $u->created_at->format('d M Y') }}</td>
                                <td>
                                    <div class="d-flex gap-1">
                                        <button type="button" class="btn-table-action btn-warning"
                                                title="Edit"
                                                data-bs-toggle="modal"
                                                data-bs-target="#modalEdit{{ $u->id }}">
                                            <i class="bi bi-pencil"></i>
                                        </button>
                                        @if($u->id !== auth()->user()->id)
                                        <button type="button" class="btn-table-action btn-danger"
                                                title="Hapus"
                                                data-bs-toggle="modal"
                                                data-bs-target="#modalHapus{{ $u->id }}">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @else
                <div style="text-align:center; padding:3rem 1rem; color:var(--gray);">
                    <i class="bi bi-person-x" style="font-size:2.5rem; opacity:0.3;"></i>
                    <p style="margin-top:0.75rem; font-size:0.88rem;">Belum ada akun admin.</p>
                </div>
                @endif
            </div>
        </div>

        <!-- Form tambah -->
        <div class="col-lg-4">
            <div class="content-card">
                <div class="content-card-header">
                    <h3 class="content-card-title">Tambah Admin Baru</h3>
                </div>
                <div style="padding:1.25rem 1.5rem 1.5rem;">
                    <form method="POST" action="{{ route('admin.users.store') }}">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label-custom">Nama Lengkap</label>
                            <input type="text" name="name" class="form-control form-control-custom @error('name') is-invalid @enderror"
                                   value="{{ old('name') }}" placeholder="cth. Budi Santoso" required>
                            @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label-custom">Email</label>
                            <input type="email" name="email" class="form-control form-control-custom @error('email') is-invalid @enderror"
                                   value="{{ old('email') }}" placeholder="email@domain.com" required>
                            @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label-custom">Password</label>
                            <div style="position:relative;">
                                <input type="password" name="password" id="inputPassNew"
                                       class="form-control form-control-custom @error('password') is-invalid @enderror"
                                       placeholder="Min. 8 karakter" required>
                                <button type="button" class="btn-toggle-pass" onclick="togglePass('inputPassNew', this)" tabindex="-1">
                                    <i class="bi bi-eye"></i>
                                </button>
                            </div>
                            @error('password')<div class="text-danger" style="font-size:0.8rem; margin-top:0.3rem;">{{ $message }}</div>@enderror
                        </div>
                        <div class="mb-4">
                            <label class="form-label-custom">Hak Akses</label>
                            <select name="role" class="form-control form-control-custom @error('role') is-invalid @enderror" required>
                                <option value="karyawan" {{ old('role') == 'karyawan' ? 'selected' : '' }}>Karyawan (akses terbatas)</option>
                                <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin (akses penuh)</option>
                            </select>
                            @error('role')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <button type="submit" class="btn-add w-100" style="justify-content:center;">
                            <i class="bi bi-person-plus"></i> Tambah Admin
                        </button>
                    </form>
                </div>
            </div>
        </div>

    </div>
</div>

<!-- MODAL EDIT -->
@foreach($users as $u)
<div class="modal fade" id="modalEdit{{ $u->id }}" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content modal-custom">
            <div class="modal-header modal-header-custom">
                <h5 class="modal-title">Edit Admin</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <form method="POST" action="{{ route('admin.users.update', $u) }}">
                @csrf @method('PUT')
                <div class="modal-body" style="padding:1.5rem;">
                    <div class="mb-3">
                        <label class="form-label-custom">Nama Lengkap</label>
                        <input type="text" name="name" class="form-control form-control-custom"
                               value="{{ $u->name }}" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label-custom">Email</label>
                        <input type="email" name="email" class="form-control form-control-custom"
                               value="{{ $u->email }}" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label-custom">Hak Akses</label>
                        <select name="role" class="form-control form-control-custom" required>
                            <option value="karyawan" {{ $u->role === 'karyawan' ? 'selected' : '' }}>Karyawan (akses terbatas)</option>
                            <option value="admin" {{ $u->role === 'admin' ? 'selected' : '' }}>Admin (akses penuh)</option>
                        </select>
                    </div>
                    <div class="mb-1">
                        <label class="form-label-custom">Password Baru <span style="color:var(--gray); font-weight:400;">(kosongkan jika tidak diubah)</span></label>
                        <div style="position:relative;">
                            <input type="password" name="password" id="inputPassEdit{{ $u->id }}"
                                   class="form-control form-control-custom"
                                   placeholder="Min. 8 karakter">
                            <button type="button" class="btn-toggle-pass" onclick="togglePass('inputPassEdit{{ $u->id }}', this)" tabindex="-1">
                                <i class="bi bi-eye"></i>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="modal-footer modal-footer-custom">
                    <button type="button" class="btn-cancel" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn-add"><i class="bi bi-check2"></i> Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- MODAL HAPUS -->
@if($u->id !== auth()->user()->id)
<div class="modal fade" id="modalHapus{{ $u->id }}" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-sm">
        <div class="modal-content modal-custom">
            <div class="modal-header modal-header-custom">
                <h5 class="modal-title">Hapus Admin</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body" style="padding:1.5rem; text-align:center;">
                <i class="bi bi-person-x" style="font-size:2.5rem; color:#ef4444; opacity:0.7;"></i>
                <p style="margin-top:0.75rem; font-size:0.9rem; color:var(--gray);">Hapus akun <strong style="color:var(--primary);">{{ $u->name }}</strong>? Tindakan ini tidak dapat dibatalkan.</p>
            </div>
            <div class="modal-footer modal-footer-custom">
                <button type="button" class="btn-cancel" data-bs-dismiss="modal">Batal</button>
                <form method="POST" action="{{ route('admin.users.destroy', $u) }}">
                    @csrf @method('DELETE')
                    <button type="submit" class="btn-add" style="background:#ef4444;">
                        <i class="bi bi-trash"></i> Hapus
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endif
@endforeach

@endsection

@section('scripts')
<script>
function togglePass(id, btn) {
    const input = document.getElementById(id);
    const icon  = btn.querySelector('i');
    if (input.type === 'password') {
        input.type = 'text';
        icon.className = 'bi bi-eye-slash';
    } else {
        input.type = 'password';
        icon.className = 'bi bi-eye';
    }
}
</script>
<style>
.btn-toggle-pass {
    position: absolute;
    right: 0.75rem;
    top: 50%;
    transform: translateY(-50%);
    background: none;
    border: none;
    color: var(--gray);
    cursor: pointer;
    padding: 0;
    line-height: 1;
}
.btn-toggle-pass:hover { color: var(--accent); }
</style>
@endsection
