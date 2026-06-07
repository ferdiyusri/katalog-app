@extends('layouts.admin')

@section('page-title', $kategoriNama ?? ($kategori ? ucfirst($kategori) : 'Dashboard'))
@section('page-subtitle', $kategori ? 'Kelola produk kategori ini' : 'Ringkasan & daftar produk HIKO STUDIO')

@section('content')

    @if(session('success'))
        <div class="alert-success-custom">
            <i class="bi bi-check-circle-fill"></i> {{ session('success') }}
        </div>
    @endif

    @if(!$kategori)
    <!-- Stat Cards -->
    @php
        $statIcons  = ['gold' => 'bi-lamp', 'blue' => 'bi-buildings', 'green' => 'bi-grid', 'purple' => 'bi-tag'];
        $statColors = ['gold', 'blue', 'green', 'purple'];
    @endphp
    <div class="row g-3 mb-4">
        <div class="col-6 col-xl-3">
            <div class="stat-card">
                <div class="stat-card-icon gold"><i class="bi bi-box-seam"></i></div>
                <div class="stat-card-value">{{ $products->count() }}</div>
                <div class="stat-card-label">Total Produk</div>
            </div>
        </div>
        @foreach($kelompokAll as $i => $grp)
        @php
            $slugsGrp = $grp->categories->pluck('slug')->toArray();
            $color    = $statColors[($i + 1) % count($statColors)];
            $icon     = array_values($statIcons)[$i % count($statIcons)];
        @endphp
        <div class="col-6 col-xl-3">
            <div class="stat-card">
                <div class="stat-card-icon {{ $color }}"><i class="bi {{ $icon }}"></i></div>
                <div class="stat-card-value">{{ $products->whereIn('category', $slugsGrp)->count() }}</div>
                <div class="stat-card-label">{{ $grp->name }}</div>
            </div>
        </div>
        @endforeach
        <div class="col-6 col-xl-3">
            <div class="stat-card">
                <div class="stat-card-icon purple"><i class="bi bi-people"></i></div>
                <div class="stat-card-value">{{ \App\Models\PriceRegistration::count() }}</div>
                <div class="stat-card-label">Pendaftar</div>
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="row g-3 mb-4">
        <div class="col-md-4">
            <a href="{{ route('admin.products.create') }}" class="quick-card">
                <div class="quick-card-icon"><i class="bi bi-plus-square"></i></div>
                <h5>Tambah Produk Baru</h5>
                <p>Tambahkan produk interior atau build dan desain</p>
            </a>
        </div>
        <div class="col-md-4">
            <a href="{{ route('admin.enquiry.index') }}" class="quick-card">
                <div class="quick-card-icon" style="background: rgba(239,68,68,0.08); color: var(--danger);">
                    <i class="bi bi-envelope"></i>
                </div>
                <h5>Pesan Enquiry</h5>
                <p>
                    @php $baru = \App\Models\Enquiry::where('is_read', false)->count(); @endphp
                    @if($baru > 0)
                        <span style="color: var(--danger); font-weight: 600;">{{ $baru }} pesan baru</span>
                    @else
                        Tidak ada pesan baru
                    @endif
                </p>
            </a>
        </div>
        <div class="col-md-4">
            <a href="{{ route('admin.registrasi.index') }}" class="quick-card">
                <div class="quick-card-icon" style="background: rgba(99,102,241,0.08); color: #6366f1;">
                    <i class="bi bi-people"></i>
                </div>
                <h5>Data Registrasi</h5>
                <p>{{ \App\Models\PriceRegistration::count() }} pengguna terdaftar</p>
            </a>
        </div>
    </div>
    @endif

    <!-- Products Table -->
    <div class="content-card">
        <div class="content-card-header">
            <h3 class="content-card-title">
                {{ $kategoriNama ?? ($kategori ? ucfirst($kategori) : 'Semua Produk') }}
                <span style="font-size: 0.8rem; font-weight: 400; color: var(--gray); margin-left: 0.4rem;">
                    {{ $products->count() }} produk
                </span>
            </h3>
            <a href="{{ route('admin.products.create', $kategori ? ['kategori' => $kategori] : []) }}" class="btn-add">
                <i class="bi bi-plus-lg"></i>
                Tambah {{ $kategoriNama ?? 'Produk' }}
            </a>
        </div>

        @if($products->count())
        <div class="table-responsive">
            <table class="table table-custom">
                <thead>
                    <tr>
                        <th>Foto</th>
                        <th>Nama Produk</th>
                        <th>Kategori</th>
                        <th>Harga</th>
                        <th>Tanggal</th>
                        <th style="text-align: center;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($products as $product)
                    <tr>
                        <td>
                            @if($product->image)
                                <img src="{{ asset('storage/' . $product->image) }}"
                                     alt="{{ $product->name }}" class="table-img">
                            @else
                                <div class="table-img-placeholder"><i class="bi bi-image"></i></div>
                            @endif
                        </td>
                        <td>
                            <div class="table-product-name">{{ $product->name }}</div>
                        </td>
                        <td>
                            <span class="table-badge interior">
                                {{ $product->category_label }}
                            </span>
                        </td>
                        <td>
                            @if($product->price)
                                <span style="font-weight: 600; color: var(--primary);">
                                    Rp {{ number_format($product->price, 0, ',', '.') }}
                                </span>
                            @else
                                <span style="color: var(--gray);">—</span>
                            @endif
                        </td>
                        <td style="color: var(--gray); font-size: 0.82rem;">
                            {{ $product->created_at->format('d M Y') }}
                        </td>
                        <td style="text-align: center;">
                            <div class="d-flex gap-1 justify-content-center">
                                <a href="{{ route('admin.products.edit', $product) }}"
                                   class="btn-table-action" title="Edit">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <form action="{{ route('admin.products.destroy', $product) }}" method="POST"
                                      onsubmit="return confirm('Yakin hapus produk ini?')">
                                    @csrf @method('DELETE')
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
            <h4>Belum Ada Produk</h4>
            <p>Mulai tambahkan produk pertama untuk kategori ini.</p>
            <a href="{{ route('admin.products.create', $kategori ? ['kategori' => $kategori] : []) }}" class="btn-add">
                <i class="bi bi-plus-lg"></i> Tambah Sekarang
            </a>
        </div>
        @endif
    </div>

@endsection
