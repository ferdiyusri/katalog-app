@extends('layouts.app')

@section('content')
    <h1>{{ $title ?? 'Daftar Produk' }}</h1>

    <div style="margin-bottom: 20px;">
        <a href="{{ route('products.index') }}" class="btn">Semua</a>
        <a href="{{ route('products.interior') }}" class="btn">Interior</a>
        <a href="{{ route('products.builddesain') }}" class="btn btn-secondary">Build dan Desain</a>
    </div>

    <div class="grid">
        @forelse($products as $product)
            <div class="card">
                <h3>{{ $product->name }}</h3>
                <p><strong>Divisi:</strong> {{ ucfirst($product->division) }}</p>
                <p><strong>Kategori:</strong> {{ $product->category ?? '-' }}</p>
                <p>{{ \Illuminate\Support\Str::limit($product->description, 80) }}</p>
                <p class="price">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                <a href="{{ route('products.show', $product) }}" class="btn">Lihat Detail</a>
            </div>
        @empty
            <div class="card">
                <p>Produk belum tersedia.</p>
            </div>
        @endforelse
    </div>

    <div style="margin-top: 20px;">
        {{ $products->links() }}
    </div>
@endsection