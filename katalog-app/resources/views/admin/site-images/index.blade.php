@extends('layouts.admin')
@section('page-title', 'Gambar Website')
@section('page-subtitle', 'Kelola gambar yang tampil di halaman Beranda dan Layanan')

@section('content')
<div class="dashboard-content">

    @if(session('sukses'))
    <div class="alert-success-custom">
        <i class="bi bi-check-circle-fill"></i> {{ session('sukses') }}
    </div>
    @endif

    @php
        $slots = \App\Models\SiteImage::SLOTS;
        $pages = collect($slots)->pluck('page')->unique()->values();
    @endphp

    @foreach($pages as $page)
    <div class="content-card mb-4">
        <div class="content-card-header">
            <h3 class="content-card-title">
                <i class="bi bi-images me-2" style="color:var(--accent);"></i>{{ $page }}
            </h3>
        </div>
        <div style="padding:1.25rem 1.5rem 1.5rem;">
            <div class="row g-3">
                @foreach($slots as $key => $slot)
                @if($slot['page'] !== $page) @continue @endif
                @php $img = $images->get($key); @endphp
                <div class="col-md-6 col-lg-4">
                    <div style="border:1px solid var(--border); border-radius:12px; overflow:hidden; background:var(--white); box-shadow:0 2px 8px rgba(0,0,0,0.04);">

                        {{-- Preview area --}}
                        <div style="position:relative; width:100%; aspect-ratio:16/9; background:linear-gradient(135deg,#1e1e33,#2a2a42); display:flex; align-items:center; justify-content:center; overflow:hidden;">
                            @if($img)
                                <img src="{{ Storage::url($img->path) }}" alt="{{ $slot['label'] }}"
                                     style="width:100%; height:100%; object-fit:cover;">
                                <div style="position:absolute; top:0.5rem; right:0.5rem;">
                                    <span style="background:rgba(34,197,94,0.9); color:#fff; font-size:0.65rem; font-weight:700; letter-spacing:1px; padding:0.2rem 0.55rem; border-radius:20px; text-transform:uppercase;">
                                        <i class="bi bi-check2"></i> Terpasang
                                    </span>
                                </div>
                            @else
                                <div style="text-align:center;">
                                    <i class="bi {{ $slot['icon'] }}" style="font-size:2.5rem; color:rgba(201,169,110,0.35);"></i>
                                    <p style="color:rgba(255,255,255,0.25); font-size:0.72rem; letter-spacing:2px; text-transform:uppercase; margin:0.5rem 0 0;">Belum ada gambar</p>
                                </div>
                            @endif
                        </div>

                        {{-- Info + actions --}}
                        <div style="padding:1rem 1.1rem 1.1rem;">
                            <div style="font-weight:600; font-size:0.85rem; color:var(--primary); margin-bottom:0.85rem;">
                                <i class="bi {{ $slot['icon'] }}" style="color:var(--accent); margin-right:0.35rem;"></i>
                                {{ $slot['label'] }}
                            </div>

                            {{-- Upload form --}}
                            <form method="POST" action="{{ route('admin.site-images.store') }}" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="key" value="{{ $key }}">
                                <div style="display:flex; gap:0.5rem; align-items:center;">
                                    <label style="flex:1; cursor:pointer;">
                                        <div style="border:1.5px dashed rgba(201,169,110,0.35); border-radius:8px; padding:0.5rem 0.75rem; font-size:0.78rem; color:var(--gray); text-align:center; transition:all 0.2s ease; cursor:pointer;"
                                             id="label-{{ $key }}"
                                             ondragover="this.style.borderColor='var(--accent)'"
                                             ondragleave="this.style.borderColor='rgba(201,169,110,0.35)'"
                                             ondrop="this.style.borderColor='rgba(201,169,110,0.35)'">
                                            <i class="bi bi-cloud-upload" style="margin-right:0.3rem;"></i>
                                            <span id="fname-{{ $key }}">Pilih gambar</span>
                                        </div>
                                        <input type="file" name="image" accept="image/jpg,image/jpeg,image/png,image/webp"
                                               style="display:none;"
                                               onchange="previewFile(this, 'fname-{{ $key }}', 'label-{{ $key }}')">
                                    </label>
                                    <button type="submit" class="btn-add" style="white-space:nowrap; flex-shrink:0; padding:0.45rem 0.9rem; font-size:0.78rem;">
                                        <i class="bi bi-upload"></i>
                                        {{ $img ? 'Ganti' : 'Upload' }}
                                    </button>
                                </div>
                            </form>

                            {{-- Delete button --}}
                            @if($img)
                            <form method="POST" action="{{ route('admin.site-images.destroy', $key) }}" style="margin-top:0.5rem;"
                                  onsubmit="return confirm('Hapus gambar {{ addslashes($slot['label']) }}?')">
                                @csrf @method('DELETE')
                                <button type="submit" style="width:100%; background:rgba(239,68,68,0.08); border:1px solid rgba(239,68,68,0.2); color:#ef4444; border-radius:8px; padding:0.4rem; font-size:0.78rem; font-weight:600; cursor:pointer; transition:all 0.2s ease;"
                                        onmouseover="this.style.background='rgba(239,68,68,0.15)'"
                                        onmouseout="this.style.background='rgba(239,68,68,0.08)'">
                                    <i class="bi bi-trash"></i> Hapus Gambar
                                </button>
                            </form>
                            @endif
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
    @endforeach

    <div style="background:rgba(201,169,110,0.06); border:1px solid rgba(201,169,110,0.15); border-radius:10px; padding:0.85rem 1.25rem; font-size:0.8rem; color:var(--gray);">
        <i class="bi bi-info-circle" style="color:var(--accent); margin-right:0.4rem;"></i>
        Format yang didukung: JPG, PNG, WEBP. Ukuran maksimal 3 MB. Rasio gambar ideal: <strong>16:9</strong> untuk layanan dan <strong>4:3</strong> untuk hero/kategori.
    </div>

</div>
@endsection

@section('scripts')
<script>
function previewFile(input, fnameId, labelId) {
    const fname = document.getElementById(fnameId);
    const label = document.getElementById(labelId);
    if (input.files && input.files[0]) {
        fname.textContent = input.files[0].name;
        label.style.borderColor = 'var(--accent)';
        label.style.color = 'var(--accent)';
    }
}
</script>
@endsection
