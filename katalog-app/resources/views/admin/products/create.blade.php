@extends('layouts.admin')

@section('page-title', 'Tambah Produk')
@section('page-subtitle', 'Tambahkan produk baru ke katalog')

@section('content')
<div class="form-content">

    @if(session('success'))
    <div class="alert-success-custom">
        <i class="bi bi-check-circle"></i> {{ session('success') }}
    </div>
    @endif

    @if($errors->any())
    <div class="alert-error-custom">
        <strong><i class="bi bi-exclamation-circle"></i> Terjadi kesalahan:</strong>
        <ul>
            @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="content-card mb-4">
            <div class="content-card-header">
                <h3 class="content-card-title">Informasi Produk</h3>
            </div>
            <div class="content-card-body">
                <div class="mb-4">
                    <label class="form-label-custom">Nama Produk *</label>
                    <input type="text" name="name" class="form-control form-control-custom"
                           placeholder="Contoh: Sofa Minimalis Modern" value="{{ old('name') }}" required>
                </div>

                <div class="row g-4 mb-4">
                    <div class="col-md-6">
                        <label class="form-label-custom">Kategori *</label>
                        @php $selKat = old('category', $defaultKategori ?? ''); @endphp
                        <select name="category" class="form-select-custom" required>
                            <option value="">-- Pilih Kategori --</option>
                            @foreach($kelompokAll as $grp)
                            @if($grp->categories->isNotEmpty())
                            <optgroup label="{{ $grp->name }}">
                                @foreach($grp->categories as $kat)
                                <option value="{{ $kat->slug }}" {{ $selKat == $kat->slug ? 'selected' : '' }}>{{ $kat->name }}</option>
                                @endforeach
                            </optgroup>
                            @endif
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label-custom">Harga (Rp)</label>
                        <input type="number" name="price" class="form-control form-control-custom"
                               placeholder="Contoh: 1500000" value="{{ old('price') }}">
                        <div class="form-hint">Kosongkan jika harga belum ditentukan</div>
                    </div>
                </div>

                <div class="mb-0">
                    <label class="form-label-custom">Deskripsi</label>
                    <textarea name="description" class="form-control form-control-custom" rows="4"
                              placeholder="Tulis deskripsi produk...">{{ old('description') }}</textarea>
                </div>
            </div>
        </div>

        <div class="content-card mb-4">
            <div class="content-card-header">
                <h3 class="content-card-title">Gambar Produk</h3>
            </div>
            <div class="content-card-body">
                <div class="upload-area" id="uploadArea">
                    <div id="uploadPlaceholder">
                        <i class="bi bi-cloud-arrow-up"></i>
                        <p>Klik atau seret gambar ke sini</p>
                        <small>Format: JPG, PNG, WEBP (Maks. 2MB)</small>
                    </div>
                    <img id="imagePreview" src="#" alt="Preview"
                         style="display:none; max-width:100%; max-height:280px; object-fit:contain; border-radius:2px;">
                    <input type="file" name="image" accept="image/*" id="imageInput">
                </div>
                <div id="previewName" style="margin-top:0.75rem; font-size:0.85rem; color:var(--accent); display:none;">
                    <i class="bi bi-check-circle"></i> <span></span>
                    &nbsp;·&nbsp;
                    <a href="#" id="removeImage" style="color:var(--danger); font-size:0.8rem;">Hapus</a>
                </div>
            </div>
        </div>

        <div class="d-flex gap-3">
            <button type="submit" class="btn-submit">
                <i class="bi bi-check-lg"></i> Simpan Produk
            </button>
            <a href="{{ route('admin.products.index') }}" class="btn-cancel">Batal</a>
        </div>
    </form>

</div>
@endsection

@section('scripts')
<script>
    const imageInput = document.getElementById('imageInput');
    const imagePreview = document.getElementById('imagePreview');
    const uploadPlaceholder = document.getElementById('uploadPlaceholder');
    const previewName = document.getElementById('previewName');
    const removeImage = document.getElementById('removeImage');

    if (imageInput) {
        imageInput.addEventListener('change', function() {
            if (this.files && this.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    imagePreview.src = e.target.result;
                    imagePreview.style.display = 'block';
                    uploadPlaceholder.style.display = 'none';
                    previewName.style.display = 'block';
                    previewName.querySelector('span').textContent = imageInput.files[0].name;
                };
                reader.readAsDataURL(this.files[0]);
            }
        });

        removeImage.addEventListener('click', function(e) {
            e.preventDefault();
            imageInput.value = '';
            imagePreview.src = '#';
            imagePreview.style.display = 'none';
            uploadPlaceholder.style.display = 'block';
            previewName.style.display = 'none';
        });
    }
</script>
@endsection
