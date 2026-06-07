@extends('layouts.frontend')

@section('title', 'Kontak')

@section('styles')
<style>
    .page-header {
        background: linear-gradient(135deg, #0d0d1f 0%, #1a1a2e 45%, #0f3460 100%);
        padding: 3.5rem 0 4.5rem;
        position: relative;
        overflow: hidden;
    }
    .page-header::before {
        content: '';
        position: absolute;
        width: 500px; height: 500px;
        border-radius: 50%;
        background: radial-gradient(circle, rgba(201,169,110,0.07) 0%, transparent 70%);
        top: -150px; right: -80px;
        pointer-events: none;
    }
    .page-header::after {
        content: '';
        position: absolute;
        bottom: 0; left: 0; right: 0;
        height: 60px;
        background: var(--light);
        clip-path: ellipse(55% 100% at 50% 100%);
    }
    .page-header-badge {
        display: inline-flex; align-items: center; gap: 0.6rem;
        background: rgba(201,169,110,0.1);
        border: 1px solid rgba(201,169,110,0.25);
        border-radius: 30px;
        padding: 0.35rem 1rem;
        font-size: 0.72rem; font-weight: 700; letter-spacing: 3px;
        text-transform: uppercase; color: var(--accent);
        margin-bottom: 1.25rem;
    }

    .section-label {
        display: inline-flex; align-items: center; gap: 0.75rem;
        font-size: 0.72rem; font-weight: 700; letter-spacing: 4px;
        text-transform: uppercase; color: var(--accent); margin-bottom: 0.6rem;
    }
    .section-label::before { content: ''; width: 24px; height: 2px; background: var(--accent); border-radius: 2px; }

    .contact-section { padding: 5rem 0 6rem; }

    .info-card {
        background: var(--primary);
        border-radius: 16px; padding: 2.5rem 2rem;
        height: 100%; position: relative; overflow: hidden;
    }
    .info-card::before {
        content: '';
        position: absolute; inset: 0;
        background: radial-gradient(ellipse at 80% 0%, rgba(15,52,96,0.5) 0%, transparent 60%);
        pointer-events: none;
    }
    .info-card-title { font-family: 'Playfair Display', serif; font-size: 1.4rem; font-weight: 700; color: var(--white); margin-bottom: 0.4rem; position: relative; }
    .info-card-sub { font-size: 0.82rem; color: rgba(255,255,255,0.38); margin-bottom: 2.25rem; line-height: 1.6; position: relative; }
    .info-item { display: flex; gap: 1rem; margin-bottom: 1.5rem; position: relative; }
    .info-item-icon {
        width: 42px; height: 42px;
        background: rgba(201,169,110,0.1);
        border: 1px solid rgba(201,169,110,0.2);
        border-radius: 10px;
        display: flex; align-items: center; justify-content: center;
        color: var(--accent); font-size: 1rem; flex-shrink: 0;
    }
    .info-item-label { font-size: 0.65rem; font-weight: 700; letter-spacing: 1.5px; text-transform: uppercase; color: var(--accent); margin-bottom: 3px; }
    .info-item-value { font-size: 0.88rem; color: rgba(255,255,255,0.6); line-height: 1.55; }
    .info-divider { border-color: rgba(255,255,255,0.06); margin: 1.5rem 0; position: relative; }
    .info-social { display: flex; gap: 0.4rem; margin-top: 1rem; position: relative; }
    .info-social a {
        display: inline-flex; align-items: center; justify-content: center;
        width: 38px; height: 38px;
        border: 1px solid rgba(255,255,255,0.12); border-radius: 8px;
        color: rgba(255,255,255,0.45); font-size: 0.9rem;
        text-decoration: none; transition: all 0.3s ease;
    }
    .info-social a:hover { background: var(--accent); border-color: var(--accent); color: var(--primary); }

    .form-card {
        background: var(--white); border-radius: 16px;
        border: 1px solid rgba(0,0,0,0.07); padding: 2.5rem;
        height: 100%; box-shadow: 0 4px 24px rgba(0,0,0,0.06);
    }
    .form-card-title { font-family: 'Playfair Display', serif; font-size: 1.3rem; font-weight: 700; color: var(--primary); margin-bottom: 0.3rem; }
    .form-card-sub { font-size: 0.82rem; color: var(--gray); margin-bottom: 1.75rem; line-height: 1.6; }
    .form-label-custom { font-size: 0.7rem; font-weight: 700; letter-spacing: 1px; text-transform: uppercase; color: var(--primary); margin-bottom: 0.4rem; display: block; }
    .form-control-custom {
        border: 1.5px solid rgba(0,0,0,0.09); border-radius: 8px;
        padding: 0.75rem 1rem; font-size: 0.9rem; font-family: 'DM Sans', sans-serif;
        color: #333; background: var(--light); width: 100%;
        transition: border-color 0.2s ease, box-shadow 0.2s ease;
    }
    .form-control-custom:focus { border-color: var(--accent); box-shadow: 0 0 0 3px rgba(201,169,110,0.12); background: var(--white); outline: none; }
    .form-control-custom.is-invalid { border-color: #dc3545; }
    .btn-submit {
        background: var(--accent); color: var(--primary); border: none;
        border-radius: 8px; padding: 0.85rem 2.5rem;
        font-size: 0.82rem; font-weight: 700; letter-spacing: 1.5px;
        text-transform: uppercase; width: 100%; transition: all 0.3s ease; cursor: pointer;
    }
    .btn-submit:hover { background: #b8935a; color: var(--primary); transform: translateY(-2px); box-shadow: 0 8px 24px rgba(0,0,0,0.12); }

    .alert-success-custom {
        background: rgba(201,169,110,0.08); border: 1px solid rgba(201,169,110,0.25);
        border-left: 4px solid var(--accent); border-radius: 0 8px 8px 0;
        padding: 1rem 1.2rem; display: flex; align-items: flex-start; gap: 0.75rem; margin-bottom: 1.5rem;
    }
    .alert-success-custom i { color: var(--accent); font-size: 1.1rem; margin-top: 2px; flex-shrink: 0; }
    .alert-success-custom p { margin: 0; font-size: 0.88rem; color: var(--primary); line-height: 1.5; }

    @media (max-width: 991px) { .contact-section { padding: 3.5rem 0 4rem; } .form-card, .info-card { padding: 2rem 1.5rem; } }
    @media (max-width: 768px) { .page-header { padding: 2.5rem 0 3.5rem; } .info-card { margin-bottom: 1rem; } }
    @media (max-width: 480px) { .page-header::after { display: none; } }
</style>
@endsection

@section('content')
    <section class="page-header">
        <div class="container" style="position:relative;z-index:1;">
            <div class="page-header-badge"><i class="bi bi-envelope"></i> Hubungi Kami</div>
            <h1 style="font-family:'Playfair Display',serif;color:#fff;font-size:clamp(1.9rem,5vw,3rem);font-weight:700;line-height:1.2;max-width:540px;">
                Konsultasikan<br><span style="color:var(--accent);">Proyek Anda</span>
            </h1>
            <p style="color:rgba(255,255,255,0.5);margin-top:1rem;max-width:480px;font-size:0.95rem;line-height:1.85;">
                Kami siap membantu Anda mewujudkan ruang ideal. Sampaikan kebutuhan Anda dan tim kami akan segera merespons.
            </p>
        </div>
    </section>

    <section class="contact-section">
        <div class="container">
            <div class="row g-4 align-items-stretch">
                <div class="col-lg-4">
                    <div class="info-card">
                        <div class="info-card-title">Informasi Kontak</div>
                        <p class="info-card-sub">Jangan ragu untuk menghubungi kami melalui saluran di bawah ini.</p>
                        <div class="info-item">
                            <div class="info-item-icon"><i class="bi bi-geo-alt"></i></div>
                            <div>
                                <div class="info-item-label">Alamat</div>
                                <div class="info-item-value">Setu Pladen, Gedung Putih, Kec. Beji,<br>Kota Depok, Jawa Barat</div>
                            </div>
                        </div>
                        <div class="info-item">
                            <div class="info-item-icon"><i class="bi bi-telephone"></i></div>
                            <div>
                                <div class="info-item-label">Telepon / WhatsApp</div>
                                <div class="info-item-value">+62 851-1141-7001</div>
                            </div>
                        </div>
                        <div class="info-item">
                            <div class="info-item-icon"><i class="bi bi-clock"></i></div>
                            <div>
                                <div class="info-item-label">Jam Operasional</div>
                                <div class="info-item-value">Senin – Sabtu<br>08.00 – 17.00 WIB</div>
                            </div>
                        </div>
                        <hr class="info-divider">
                        <div class="info-item-label" style="margin-bottom:0.5rem;position:relative;">Ikuti Kami</div>
                        <div class="info-social">
                            <a href="https://www.instagram.com/hikostudio_/" target="_blank" title="Instagram"><i class="bi bi-instagram"></i></a>
                            <a href="https://www.tiktok.com/@hikostudio09" target="_blank" title="TikTok"><i class="bi bi-tiktok"></i></a>
                            <a href="https://wa.me/6285111417001" target="_blank" title="WhatsApp"><i class="bi bi-whatsapp"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="form-card">
                        <div class="form-card-title">Kirim Pesan</div>
                        <p class="form-card-sub">Isi formulir di bawah ini dan tim kami akan merespons dalam 1 × 24 jam kerja.</p>
                        @if(session('sukses'))
                            <div class="alert-success-custom">
                                <i class="bi bi-check-circle-fill"></i>
                                <p>{{ session('sukses') }}</p>
                            </div>
                        @endif
                        <form action="{{ route('kontak.kirim') }}" method="POST" novalidate>
                            @csrf
                            <input type="text" name="_hp" value="" style="display:none;" tabindex="-1" autocomplete="off">
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label-custom">Nama Lengkap <span style="color:#dc3545;">*</span></label>
                                    <input type="text" name="nama" value="{{ old('nama') }}"
                                        class="form-control-custom @error('nama') is-invalid @enderror"
                                        placeholder="Masukkan nama lengkap Anda">
                                    @error('nama')<div style="font-size:0.78rem;color:#dc3545;margin-top:0.3rem;">{{ $message }}</div>@enderror
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label-custom">Email <span style="color:#dc3545;">*</span></label>
                                    <input type="email" name="email" value="{{ old('email') }}"
                                        class="form-control-custom @error('email') is-invalid @enderror"
                                        placeholder="contoh@email.com">
                                    @error('email')<div style="font-size:0.78rem;color:#dc3545;margin-top:0.3rem;">{{ $message }}</div>@enderror
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label-custom">Nomor Telepon <span style="color:#dc3545;">*</span></label>
                                    <input type="text" name="telepon" value="{{ old('telepon') }}"
                                        class="form-control-custom @error('telepon') is-invalid @enderror"
                                        placeholder="+62 8xx-xxxx-xxxx">
                                    @error('telepon')<div style="font-size:0.78rem;color:#dc3545;margin-top:0.3rem;">{{ $message }}</div>@enderror
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label-custom">Layanan yang Diminati <span style="color:#dc3545;">*</span></label>
                                    <select name="layanan" class="form-control-custom @error('layanan') is-invalid @enderror">
                                        <option value="" disabled {{ old('layanan') ? '' : 'selected' }}>Pilih layanan...</option>
                                        <optgroup label="— Arsitektur">
                                            <option value="Arsitektur / Hiko Architecture" {{ old('layanan') === 'Arsitektur / Hiko Architecture' ? 'selected' : '' }}>Arsitektur / Hiko Architecture</option>
                                        </optgroup>
                                        <optgroup label="— Interior Design">
                                            <option value="Interior Rumah" {{ old('layanan') === 'Interior Rumah' ? 'selected' : '' }}>Interior Rumah</option>
                                            <option value="Interior Apartemen" {{ old('layanan') === 'Interior Apartemen' ? 'selected' : '' }}>Interior Apartemen</option>
                                            <option value="Interior Kantor" {{ old('layanan') === 'Interior Kantor' ? 'selected' : '' }}>Interior Kantor</option>
                                            <option value="Interior Hotel" {{ old('layanan') === 'Interior Hotel' ? 'selected' : '' }}>Interior Hotel</option>
                                        </optgroup>
                                        <optgroup label="— Design dan Build">
                                            <option value="Design dan Build" {{ old('layanan') === 'Design dan Build' ? 'selected' : '' }}>Design dan Build</option>
                                        </optgroup>
                                        <optgroup label="— Custom Interior">
                                            <option value="Kitchen Set" {{ old('layanan') === 'Kitchen Set' ? 'selected' : '' }}>Kitchen Set</option>
                                            <option value="Wardrobe Custom" {{ old('layanan') === 'Wardrobe Custom' ? 'selected' : '' }}>Wardrobe Custom</option>
                                            <option value="Furniture Built-in" {{ old('layanan') === 'Furniture Built-in' ? 'selected' : '' }}>Furniture Built-in</option>
                                        </optgroup>
                                        <option value="Lainnya" {{ old('layanan') === 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                                    </select>
                                    @error('layanan')<div style="font-size:0.78rem;color:#dc3545;margin-top:0.3rem;">{{ $message }}</div>@enderror
                                </div>
                                <div class="col-12">
                                    <label class="form-label-custom">Pesan <span style="color:#dc3545;">*</span></label>
                                    <textarea name="pesan" rows="5"
                                        class="form-control-custom @error('pesan') is-invalid @enderror"
                                        style="resize:vertical;"
                                        placeholder="Ceritakan kebutuhan proyek Anda secara singkat...">{{ old('pesan') }}</textarea>
                                    @error('pesan')<div style="font-size:0.78rem;color:#dc3545;margin-top:0.3rem;">{{ $message }}</div>@enderror
                                </div>
                                <div class="col-12 mt-1">
                                    <button type="submit" class="btn-submit">
                                        <i class="bi bi-send me-2"></i> Kirim Pesan
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
