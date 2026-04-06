@extends('layouts.app')

@section('title', 'Admin Dashboard - Pancingin')

@section('sidebar')
    @include('admin.components.sidebar')
@endsection

@section('navbar')
    @include('layouts.navigation')
@endsection

@section('content')
<div class="container-fluid px-4 py-4">
    <!-- Hero Section with Fishing Theme -->
    <div class="hero-welcome mb-5" style="background: linear-gradient(135deg, #0B4F6C 0%, #1E88E5 100%); border-radius: 24px; padding: 40px; position: relative; overflow: hidden;">
        <!-- Decorative fishing elements -->
        <div style="position: absolute; right: 50px; bottom: 20px; opacity: 0.1; font-size: 120px; color: white;">
            <i class="bi bi-fish"></i>
        </div>
        <div style="position: absolute; left: 30px; top: 20px; opacity: 0.1; font-size: 80px; color: white; transform: rotate(-15deg);">
            <i class="bi bi-water"></i>
        </div>
        
        <div class="d-flex justify-content-between align-items-center position-relative" style="z-index: 1;">
            <div>
                <h1 class="hero-title text-white">
                    Selamat Datang, Kapten! <i class="bi bi-fish"></i>
                </h1>
                <p class="hero-subtitle mb-0 text-white-50">Laut sedang tenang, siap memantau aktivitas pemancingan hari ini, {{ now()->translatedFormat('l, d F Y') }}</p>
            </div>
            <div class="d-none d-md-block">
                <a href="{{ route('admin.transaksi.index') }}" class="btn btn-light text-primary fw-bold shadow-sm" style="border-radius: 50px; padding: 12px 30px;">
                    <i class="bi bi-file-text me-2"></i> Laporan Hasil Tangkapan
                </a>
            </div>
        </div>
    </div>

    <!-- Stat Cards with Fishing Theme -->
    <div class="row g-4 mb-5">
        <div class="col-xl-3 col-md-6">
            <div class="card-premium h-100" style="border-left: 5px solid #0B4F6C;">
                <div class="card-body stat-card">
                    <div>
                        <div class="stat-icon-wrapper" style="background: linear-gradient(135deg, #0B4F6C 0%, #1E88E5 100%);">
                            <i class="bi bi-people-fill"></i>
                        </div>
                        <div class="stat-label mb-1">Anggota Pemancing</div>
                        <div class="stat-value">{{ $stats['total_users'] }}</div>
                    </div>
                    <div class="mt-3 text-muted small">
                        <i class="bi bi-arrow-up-short text-success"></i> Pemancing Aktif
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card-premium h-100" style="border-left: 5px solid #2E7D32;">
                <div class="card-body stat-card">
                    <div>
                        <div class="stat-icon-wrapper" style="background: linear-gradient(135deg, #2E7D32C0 0%, #2E7D32D2 100%);">
    <i class="bi bi-gear-wide-connected"></i>
</div>
                        <div class="stat-label mb-1">Total Peralatan</div>
                        <div class="stat-value">{{ $stats['total_alat'] }}</div>
                    </div>
                    <div class="mt-3 text-muted small">
                        <span class="text-success fw-bold">{{ \App\Models\Alat::sum('stok_tersedia') }}</span> Unit Siap Pakai
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card-premium h-100" style="border-left: 5px solid #ED6A02;">
                <div class="card-body stat-card">
                    <div>
                        <div class="stat-icon-wrapper" style="background: linear-gradient(135deg, #ED6A02 0%, #FF9800 100%);">
                            <i class="bi bi-hourglass-split"></i>
                        </div>
                        <div class="stat-label mb-1">Antrian Peminjaman</div>
                        <div class="stat-value">{{ $stats['peminjaman_pending'] }}</div>
                    </div>
                    @if($stats['peminjaman_pending'] > 0)
                        <div class="mt-3">
                            <a href="{{ route('admin.peminjaman.index', ['status' => 'pending']) }}" class="text-decoration-none text-warning small fw-bold">
                                Cek Antrian <i class="bi bi-arrow-right"></i>
                            </a>
                        </div>
                    @else
                        <div class="mt-3 text-muted small">
                            <i class="bi bi-check-circle text-success"></i> Semua Lancar
                        </div>
                    @endif
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card-premium h-100" style="border-left: 5px solid #C2185B;">
                <div class="card-body stat-card">
                    <div>
                        <div class="stat-icon-wrapper" style="background: linear-gradient(135deg, #C2185B 0%, #E91E63 100%);">
                            <i class="bi bi-check2-circle"></i>
                        </div>
                        <div class="stat-label mb-1">Sedang Melaut</div>
                        <div class="stat-value">{{ $stats['peminjaman_approved'] }}</div>
                    </div>
                    <div class="mt-3 text-muted small">
                        Alat Sedang Dipinjam
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-4">
        <!-- Recent Fishing Gear Loans -->
        <div class="col-xl-8">
            <div class="card-premium h-100">
                <div class="card-header d-flex justify-content-between align-items-center" style="background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);">
                    <h5 class="mb-0">
                        <i class="bi bi-fish me-2" style="color: #0B4F6C;"></i>
                        Aktivitas Peminjaman Terbaru
                    </h5>
                    <a href="{{ route('admin.peminjaman.index') }}" class="btn btn-sm" style="background: #0B4F6C; color: white; border-radius: 20px; padding: 5px 15px;">
                        Lihat Semua
                    </a>
                </div>
                <div class="table-responsive">
                    <table class="table table-modern align-middle">
                        <thead style="background: #f1f5f9;">
                            <tr>
                                <th>Pemancing</th>
                                <th>Alat Pancing</th>
                                <th>Durasi Melaut</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($recent_peminjaman as $p)
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="avatar-circle me-3" style="background: linear-gradient(135deg, #0B4F6C, #1E88E5); color: white; border-radius: 50%; width: 40px; height: 40px; display: flex; align-items: center; justify-content: center; font-weight: bold;">
                                                {{ strtoupper(substr($p->user->name, 0, 1)) }}
                                            </div>
                                            <div>
                                                <div class="fw-bold text-dark">{{ $p->user->name }}</div>
                                                <div class="text-muted small">ID: #{{ $p->id }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="fw-medium">
                                            <i class="bi bi-fish me-1" style="color: #0B4F6C;"></i>
                                            {{ $p->alat->nama_alat }}
                                        </span>
                                    </td>
                                    <td>
                                        <div class="small text-muted">
                                            {{ $p->tanggal_pinjam->format('d/m') }} - {{ $p->tanggal_kembali_rencana->format('d/m') }}
                                        </div>
                                        <div class="small fw-bold" style="color: #0B4F6C;">{{ $p->durasi_hari }} Hari Melaut</div>
                                    </td>
                                    <td>
                                        @if($p->status == 'pending')
                                            <span class="badge" style="background: #FFF3E0; color: #ED6A02; padding: 8px 12px; border-radius: 20px;">⏳ Menunggu Antrian</span>
                                        @elseif($p->status == 'approved')
                                            <span class="badge" style="background: #E8F5E9; color: #2E7D32; padding: 8px 12px; border-radius: 20px;">🎣 Sedang Melaut</span>
                                        @elseif($p->status == 'returned')
                                            <span class="badge" style="background: #E3F2FD; color: #0B4F6C; padding: 8px 12px; border-radius: 20px;">✅ Selesai Melaut</span>
                                        @else
                                            <span class="badge" style="background: #FFEBEE; color: #C2185B; padding: 8px 12px; border-radius: 20px;">❌ Dibatalkan</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.peminjaman.show', $p) }}" class="btn btn-sm" style="background: #e9ecef; color: #0B4F6C; border-radius: 50%; width: 35px; height: 35px; display: flex; align-items: center; justify-content: center;">
                                            <i class="bi bi-eye"></i>
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center py-5">
                                        <i class="bi bi-fish" style="font-size: 60px; color: #ccc;"></i>
                                        <p class="text-muted mt-2">Belum ada aktivitas pemancingan hari ini.</p>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Quick Actions & Inventory Summary with Fishing Theme -->
        <div class="col-xl-4">
            <div class="card-premium mb-4">
                <div class="card-header" style="background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);">
                    <h5 class="mb-0">
                        <i class="bi bi-gear-fill me-2" style="color: #0B4F6C;"></i>
                        Aksi Cepat
                    </h5>
                </div>
                <div class="card-body">
                    <div class="d-grid gap-3">
                        <a href="{{ route('admin.alat.create') }}" class="btn d-flex align-items-center justify-content-center" style="background: linear-gradient(135deg, #0B4F6C 0%, #1E88E5 100%); color: white; border: none; padding: 12px; border-radius: 50px;">
                            <i class="bi bi-plus-lg me-2"></i> Tambah Alat Pancing Baru
                        </a>
                        <a href="{{ route('admin.kategori.create') }}" class="btn d-flex align-items-center justify-content-center" style="background: white; color: #0B4F6C; border: 2px solid #0B4F6C; padding: 12px; border-radius: 50px; font-weight: 600;">
                            <i class="bi bi-folder-plus me-2"></i> Tambah Kategori Alat
                        </a>
                        <!-- Link bermasalah telah dihapus -->
                    </div>
                </div>
            </div>

            <div class="card-premium">
                <div class="card-header" style="background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);">
                    <h5 class="mb-0">
                        <i class="bi bi-box-seam me-2" style="color: #0B4F6C;"></i>
                        Ringkasan Peralatan
                    </h5>
                </div>
                <div class="card-body">
                    <!-- Fishing Gear Categories -->
                    <div class="mb-4">
                        <div class="d-flex justify-content-between mb-2">
                            <span class="fw-medium">
                                <i class="bi bi-fish me-2" style="color: #0B4F6C;"></i>
                                Joran & Reel
                            </span>
                            <span class="fw-bold">{{ \App\Models\Alat::where('kategori_id', 1)->count() }}</span>
                        </div>
                        <div class="progress" style="height: 8px; border-radius: 10px;">
                            <div class="progress-bar" style="width: 60%; background: linear-gradient(90deg, #0B4F6C, #1E88E5);"></div>
                        </div>
                    </div>
                    
                    <div class="mb-4">
                        <div class="d-flex justify-content-between mb-2">
                            <span class="fw-medium">
                                <i class="bi bi-fish me-2" style="color: #2E7D32;"></i>
                                Umpan & Senar
                            </span>
                            <span class="fw-bold">{{ \App\Models\Alat::where('kategori_id', 2)->count() }}</span>
                        </div>
                        <div class="progress" style="height: 8px; border-radius: 10px;">
                            <div class="progress-bar" style="width: 45%; background: linear-gradient(90deg, #2E7D32, #4CAF50);"></div>
                        </div>
                    </div>
                    
                    <div class="mb-4">
                        <div class="d-flex justify-content-between mb-2">
                            <span class="fw-medium">
                                <i class="bi bi-fish me-2" style="color: #ED6A02;"></i>
                                Aksesoris
                            </span>
                            <span class="fw-bold">{{ \App\Models\Alat::where('kategori_id', 3)->count() }}</span>
                        </div>
                        <div class="progress" style="height: 8px; border-radius: 10px;">
                            <div class="progress-bar" style="width: 30%; background: linear-gradient(90deg, #ED6A02, #FF9800);"></div>
                        </div>
                    </div>

                    <hr class="my-4">

                    <!-- Equipment Condition Summary -->
                    <div class="mb-3">
                        <div class="d-flex justify-content-between mb-2">
                            <span class="fw-medium">
                                <i class="bi bi-check-circle-fill text-success me-2"></i>
                                Kondisi Prima
                            </span>
                            <span class="fw-bold text-success">{{ \App\Models\Alat::where('kondisi', 'baik')->count() }}</span>
                        </div>
                        <div class="progress" style="height: 8px; border-radius: 10px;">
                            <div class="progress-bar bg-success" style="width: 85%"></div>
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <div class="d-flex justify-content-between mb-2">
                            <span class="fw-medium">
                                <i class="bi bi-exclamation-triangle-fill text-warning me-2"></i>
                                Perlu Perawatan
                            </span>
                            <span class="fw-bold text-warning">{{ \App\Models\Alat::where('kondisi', 'rusak')->count() }}</span>
                        </div>
                        <div class="progress" style="height: 8px; border-radius: 10px;">
                            <div class="progress-bar bg-warning" style="width: 15%"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Custom CSS for Fishing Theme -->
<style>
    .card-premium {
        border: none;
        border-radius: 20px;
        box-shadow: 0 10px 30px rgba(11, 79, 108, 0.1);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        overflow: hidden;
    }
    
    .card-premium:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 40px rgba(11, 79, 108, 0.15);
    }
    
    .stat-icon-wrapper {
        width: 60px;
        height: 60px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 20px;
        color: white;
        font-size: 24px;
    }
    
    .stat-value {
        font-size: 32px;
        font-weight: 700;
        color: #1e293b;
        line-height: 1.2;
    }
    
    .stat-label {
        font-size: 14px;
        color: #64748b;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    
    .badge {
        font-weight: 500;
        padding: 6px 12px;
    }
    
    .hero-welcome {
        background: linear-gradient(135deg, #0B4F6C 0%, #1E88E5 100%);
        border-radius: 24px;
        padding: 40px;
        position: relative;
        overflow: hidden;
    }
    
    .hero-title {
        font-size: 36px;
        font-weight: 700;
        margin-bottom: 10px;
    }
    
    .hero-subtitle {
        font-size: 16px;
        opacity: 0.9;
    }
    
    .table-modern tbody tr {
        transition: background-color 0.2s ease;
    }
    
    .table-modern tbody tr:hover {
        background-color: #f8fafc;
    }
</style>
@endsection