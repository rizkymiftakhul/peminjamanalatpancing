@extends('layouts.app')

@section('title', 'Dashboard Pemancing')

@section('sidebar')
    @include('user.components.sidebar')
@endsection

@section('navbar')
    @include('layouts.navigation')
@endsection

@section('content')
<div class="container-fluid px-4 py-4">
    <!-- Hero Section dengan Nuansa Laut -->
    <div class="hero-welcome mb-5" style="background: linear-gradient(135deg, #0B3B5C 0%, #1B6B8F 100%); border-radius: 28px; padding: 2.5rem 2rem; color: white; box-shadow: 0 20px 30px -10px rgba(0,80,120,0.3);">
        <div class="row align-items-center position-relative" style="z-index: 1;">
            <div class="col-lg-8">
                <h1 class="display-5 fw-bold mb-3">
                    {{ auth()->user()->name }}! Siap Melaut Hari Ini?
                </h1>
                <p class="fs-5 mb-4 opacity-90">Dapatkan perlengkapan mancing berkualitas. Dari joran, reel, hingga umpan — semua tersedia!</p>
                <div class="d-flex gap-3 flex-wrap">
                    <a href="{{ route('user.peminjaman.create') }}" class="btn btn-warning fw-bold px-4 py-2 shadow-sm" style="border-radius: 50px;">
                        <i class="bi bi-basket3-fill me-2"></i>Sewa Alat Pancing
                    </a>
                    <a href="{{ route('user.peminjaman.index') }}" class="btn btn-outline-light fw-bold px-4 py-2" style="border-radius: 50px;">
                        <i class="bi bi-clock-history me-2"></i>Lihat Peminjaman Saya
                    </a>
                </div>
            </div>
            <div class="col-lg-4 d-none d-lg-block text-center">
                <i class="bi bi-fish" style="font-size: 8rem; opacity: 0.15; transform: rotate(10deg);"></i>
            </div>
        </div>
        <!-- Ombak-ombak dekoratif -->
        <div style="position: absolute; bottom: 0; left: 0; right: 0; height: 30px; background: url('data:image/svg+xml;utf8,<svg xmlns=\'http://www.w3.org/2000/svg\' viewBox=\'0 0 1440 320\' preserveAspectRatio=\'none\'><path fill=\'%23ffffff\' fill-opacity=\'0.1\' d=\'M0,256L48,240C96,224,192,192,288,181.3C384,171,480,181,576,197.3C672,213,768,235,864,234.7C960,235,1056,213,1152,197.3C1248,181,1344,171,1392,165.3L1440,160L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z\'></path></svg>'); background-size: cover; background-repeat: no-repeat;"></div>
    </div>

    <!-- Statistik Cepat ala Nelayan -->
    <div class="row g-4 mb-5">
        <div class="col-md-3">
            <div class="card border-0 shadow-sm h-100" style="border-radius: 24px; background: #E6F7FF;">
                <div class="card-body d-flex align-items-center">
                    <div class="rounded-circle bg-primary bg-opacity-10 p-3 me-3">
                        <i class="bi bi-fish text-primary fs-4"></i>
                    </div>
                    <div>
                        <span class="text-secondary-emphasis text-uppercase small fw-semibold">Total Mancing</span>
                        <h3 class="fw-bold mb-0">{{ $stats['total_peminjaman'] }}</h3>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-0 shadow-sm h-100" style="border-radius: 24px; background: #FFF3D9;">
                <div class="card-body d-flex align-items-center">
                    <div class="rounded-circle bg-warning bg-opacity-10 p-3 me-3">
                        <i class="bi bi-hourglass-split text-warning fs-4"></i>
                    </div>
                    <div>
                        <span class="text-secondary-emphasis text-uppercase small fw-semibold">Antri</span>
                        <h3 class="fw-bold mb-0">{{ $stats['pending'] }}</h3>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-0 shadow-sm h-100" style="border-radius: 24px; background: #DFF0E6;">
                <div class="card-body d-flex align-items-center">
                    <div class="rounded-circle bg-success bg-opacity-10 p-3 me-3">
                        <i class="bi bi-check2-circle text-success fs-4"></i>
                    </div>
                    <div>
                        <span class="text-secondary-emphasis text-uppercase small fw-semibold">Disetujui</span>
                        <h3 class="fw-bold mb-0">{{ $stats['approved'] }}</h3>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-0 shadow-sm h-100" style="border-radius: 24px; background: #FFEBEF;">
                <div class="card-body d-flex align-items-center">
                    <div class="rounded-circle bg-danger bg-opacity-10 p-3 me-3">
                        <i class="bi bi-arrow-return-left text-danger fs-4"></i>
                    </div>
                    <div>
                        <span class="text-secondary-emphasis text-uppercase small fw-semibold">Selesai</span>
                        <h3 class="fw-bold mb-0">{{ $stats['returned'] }}</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Dua Kolom Utama: Rekomendasi Alat + Aktivitas -->
    <div class="row g-4">
        <!-- Kiri: Rekomendasi Alat Pancing -->
        <div class="col-xl-8">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h4 class="fw-bold text-dark">
                    <i class="bi bi-star-fill text-warning me-2"></i>Rekomendasi Alat Pancing
                </h4>
                <a href="{{ route('user.peminjaman.create') }}" class="text-decoration-none fw-medium">
                    Lihat Semua <i class="bi bi-arrow-right-circle-fill"></i>
                </a>
            </div>
            
            <div class="row g-3">
                @forelse($alat_tersedia as $alat)
                    <div class="col-md-6 col-lg-4">
                        <div class="card h-100 border-0 shadow-sm" style="border-radius: 24px; overflow: hidden;">
                            <!-- Foto Alat dengan overlay tipis -->
                            <div style="height: 160px; background-color: #f2f9fc; position: relative;">
                                @if($alat->foto)
                                    <img src="{{ $alat->foto_url }}" class="w-100 h-100 object-fit-cover" alt="{{ $alat->nama_alat }}">
                                @else
                                    <div class="w-100 h-100 d-flex align-items-center justify-content-center">
                                        <i class="bi bi-image text-secondary opacity-50" style="font-size: 4rem;"></i>
                                    </div>
                                @endif
                                <span class="position-absolute top-0 end-0 m-2 badge bg-white text-primary border rounded-pill px-3 py-2 shadow-sm">
                                    ⭐ {{ $alat->kategori->nama_kategori ?? 'Alat' }}
                                </span>
                            </div>
                            <div class="card-body">
                                <h6 class="fw-bold text-truncate">{{ $alat->nama_alat }}</h6>
                                <div class="d-flex align-items-center text-warning mb-2 small">
                                    <i class="bi bi-tag-fill me-1"></i>
                                    <span class="text-dark fw-bold">Rp {{ number_format($alat->harga_sewa_per_hari, 0, ',', '.') }}</span>
                                    <span class="text-secondary ms-1">/hari</span>
                                </div>
                                <div class="d-flex justify-content-between align-items-center">
                                    <span class="small text-secondary"><i class="bi bi-box-seam me-1"></i>Stok {{ $alat->stok_tersedia }}</span>
                                    <a href="{{ route('user.peminjaman.create') }}" class="btn btn-sm btn-outline-primary rounded-pill px-3">
                                         Sewa
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12">
                        <div class="alert alert-info bg-opacity-10 border-0 rounded-4 py-4 text-center">
                            <i class="bi bi-exclamation-triangle fs-1 d-block mb-2"></i>
                            <p class="mb-0">Belum ada alat pancing tersedia. Cek kembali nanti ya!</p>
                        </div>
                    </div>
                @endforelse
            </div>
        </div>

        <!-- Kanan: Aktivitas Terkait Peminjaman -->
        <div class="col-xl-4">
            <div class="card border-0 shadow-sm h-100" style="border-radius: 24px;">
                <div class="card-header bg-transparent border-0 pt-4 pb-0">
                    <h5 class="fw-bold">
                        <i class="bi bi-water me-2" style="color: #1B6B8F;"></i>Aktivitas Melautmu
                    </h5>
                </div>
                <div class="card-body">
                    <ul class="list-group list-group-flush">
                        @forelse($recent_peminjaman as $p)
                            <li class="list-group-item px-0 py-3 border-0 border-bottom">
                                <div class="d-flex align-items-start">
                                    <div class="flex-grow-1">
                                        <div class="fw-semibold">{{ $p->alat->nama_alat }}</div>
                                        <div class="small text-secondary mb-2">
                                            <i class="bi bi-calendar3 me-1"></i> {{ $p->tanggal_pinjam->format('d M') }} – {{ $p->tanggal_kembali_rencana->format('d M') }}
                                        </div>
                                        <div>
                                            @if($p->status == 'pending')
                                                <span class="badge bg-warning bg-opacity-15 text-warning-emphasis rounded-pill px-3 py-2">⏳ Menunggu</span>
                                            @elseif($p->status == 'approved')
                                                <span class="badge bg-success bg-opacity-15 text-success-emphasis rounded-pill px-3 py-2">✅ Disetujui</span>
                                            @elseif($p->status == 'returned')
                                                <span class="badge bg-info bg-opacity-15 text-info-emphasis rounded-pill px-3 py-2">🏁 Selesai</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="text-end ms-2">
                                        <div class="fw-bold text-success mb-1">Rp {{ number_format($p->total_biaya, 0, ',', '.') }}</div>
                                        <a href="{{ route('user.peminjaman.index') }}" class="btn btn-sm btn-outline-secondary rounded-circle">
                                            <i class="bi bi-chevron-right"></i>
                                        </a>
                                    </div>
                                </div>
                            </li>
                        @empty
                            <li class="list-group-item border-0 text-center py-5">
                                <i class="bi bi-archive fs-1 text-secondary opacity-25"></i>
                                <p class="text-secondary mt-3">Belum ada riwayat peminjaman. Yuk sewa alat!</p>
                                <a href="{{ route('user.peminjaman.create') }}" class="btn btn-primary rounded-pill px-4 mt-2">
                                    <i class="bi bi-basket3 me-2"></i>Sewa Sekarang
                                </a>
                            </li>
                        @endforelse
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection