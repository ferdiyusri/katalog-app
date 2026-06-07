@extends('layouts.frontend')

@section('title', 'Tim Kami')

@section('styles')
<style>
.page-header {
    background: linear-gradient(135deg, var(--primary) 0%, #16213e 50%, #0f3460 100%);
    padding: 2rem 0 3rem;
}

.section-team { padding: 5rem 0; background: var(--light); }

.section-title {
    font-family: 'Playfair Display', serif;
    font-size: clamp(1.8rem, 3vw, 2.5rem);
    font-weight: 700;
    color: var(--primary);
    line-height: 1.2;
    margin-bottom: 0.5rem;
}

.team-card {
    background: var(--white);
    border-radius: 14px;
    border: 1px solid var(--border);
    text-align: center;
    padding: 2rem 1.5rem 1.75rem;
    height: 100%;
    transition: all 0.3s ease;
    box-shadow: 0 2px 12px rgba(0,0,0,0.04);
}
.team-card:hover {
    transform: translateY(-6px);
    box-shadow: 0 16px 48px rgba(0,0,0,0.1);
    border-color: rgba(201,169,110,0.3);
}

.team-avatar {
    width: 110px;
    height: 110px;
    border-radius: 50%;
    background: linear-gradient(135deg, var(--primary) 0%, #16213e 100%);
    border: 3px solid rgba(201,169,110,0.25);
    display: flex;
    align-items: center;
    justify-content: center;
    position: relative;
    overflow: hidden;
    margin: 0 auto 1.25rem;
}
.team-avatar-icon { font-size: 2.5rem; color: var(--accent); opacity: 0.2; }
.team-avatar-initials {
    position: absolute;
    font-family: 'Playfair Display', serif;
    font-size: 1.75rem;
    font-weight: 700;
    color: var(--accent);
    letter-spacing: 2px;
}

.team-name {
    font-family: 'Playfair Display', serif;
    font-size: 1rem;
    font-weight: 700;
    color: var(--primary);
    line-height: 1.3;
    margin-bottom: 0.5rem;
}
.team-divider { width: 30px; height: 2px; background: var(--accent); margin: 0.5rem auto; opacity: 0.5; }
.team-role {
    display: inline-flex;
    align-items: center;
    font-size: 0.68rem;
    font-weight: 700;
    letter-spacing: 1.5px;
    text-transform: uppercase;
    color: var(--accent);
    background: var(--accent-light);
    border-radius: 20px;
    padding: 0.2rem 0.75rem;
}

@media (max-width: 991px) { .section-team { padding: 3.5rem 0; } }
@media (max-width: 768px) { .section-team { padding: 2.5rem 0; } .team-avatar { width: 90px; height: 90px; } }
</style>
@endsection

@section('content')
<section class="page-header">
    <div class="container">
        <div class="section-label" style="padding-left:0;">Tim Kami</div>
        <h1 style="font-family:'Playfair Display',serif;color:#fff;font-size:clamp(1.8rem,4vw,2.8rem);font-weight:700;margin-top:0.5rem;line-height:1.2;">
            Jajaran Profesional <span style="color:var(--accent);">HIKO STUDIO</span>
        </h1>
        <p style="color:rgba(255,255,255,0.55);margin-top:0.75rem;max-width:520px;font-size:0.95rem;line-height:1.8;">
            Didukung oleh tenaga profesional berpengalaman yang berdedikasi penuh dalam menghadirkan hasil terbaik di setiap proyek.
        </p>
    </div>
</section>

<section class="section-team">
    <div class="container">
        <div class="row g-4">
            @foreach($teamMembers as $anggota)
            <div class="col-md-6 col-lg-4">
                <div class="team-card">
                    <div class="team-avatar">
                        @if($anggota->photo)
                            <img src="{{ asset('storage/' . $anggota->photo) }}"
                                    alt="{{ $anggota->name }}"
                                    style="width:100%;height:100%;object-fit:cover;object-position:center 20%;position:absolute;inset:0;">
                        @else
                            <i class="bi bi-person team-avatar-icon"></i>
                            <span class="team-avatar-initials">{{ $anggota->initials }}</span>
                        @endif
                    </div>
                    <div class="team-name">{{ $anggota->name }}</div>
                    <div class="team-divider"></div>
                    <div class="team-role">{{ $anggota->role }}</div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endsection
