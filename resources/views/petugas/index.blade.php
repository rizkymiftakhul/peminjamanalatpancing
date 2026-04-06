@extends('layouts.app')

@section('title', 'Dashboard Petugas')

@section('sidebar')
    @include('petugas.components.sidebar')
@endsection

@section('navbar')
    @include('layouts.navigation')
@endsection

@section('content')
<div class="container-fluid px-4 py-4">
    <style>
        :root {
            --ocean-primary: #0ea5e9;
            --ocean-dark: #0284c7;
            --ocean-light: #e0f2fe;
            --reef-teal: #14b8a6;
            --coral: #f97316;
            --sand: #fef3c7;
            --wave-gradient: linear-gradient(135deg, #0ea5e9 0%, #0284c7 100%);
        }

        .hero-welcome {
            background: var(--wave-gradient);
            border-radius: 30px;
            padding: 2.5rem 3rem;
            position: relative;
            overflow: hidden;
            box-shadow: 0 20px 30px -10px rgba(2, 132, 199, 0.3);
        }

        .hero-welcome::before {
            content: "⚓";
            position: absolute;
            bottom: -20px;
            right: 30px;
            font-size: 120px;
            opacity: 0.1;
            transform: rotate(15deg);
            color: white;
        }

        .hero-welcome::after {
            content: "〰️";
            position: absolute;
            top: 20px;
            left: 20px;
            font-size: 80px;
            opacity: 0.1;
            transform: rotate(-10deg);
            color: white;
        }

        .hero-title {
            font-size: 2.5rem;
            font-weight: 800;
            color: white;
            margin-bottom: 0.5rem;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.1);
        }

        .hero-subtitle {
            font-size: 1.1rem;
            color: rgba(255,255,255,0.9);
            font-weight: 500;
        }

        .card-premium {
            background: white;
            border-radius: 20px;
            border: none;
            box-shadow: 0 10px 30px rgba(0,0,0,0.05);
            transition: all 0.3s ease;
            overflow: hidden;
        }

        .card-premium:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 40px rgba(14, 165, 233, 0.15);
        }

        .stat-card {
            display: flex;
            align-items: center;
            padding: 1.5rem;
        }

        .stat-icon-wrapper {
            width: 60px;
            height: 60px;
            border-radius: 18px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 1rem;
            font-size: 28px;
        }

        .bg-ocean-soft {
            background: linear-gradient(135deg, #e0f2fe 0%, #bae6fd 100%);
            color: #0369a1;
        }

        .bg-reef-soft {
            background: linear-gradient(135deg, #ccfbf1 0%, #99f6e4 100%);
            color: #0d9488;
        }

        .bg-coral-soft {
            background: linear-gradient(135deg, #ffedd5 0%, #fed7aa 100%);
            color: #c2410c;
        }

        .stat-label {
            color: #64748b;
            font-size: 0.9rem;
            font-weight: 500;
            letter-spacing: 0.5px;
        }

        .stat-value {
            font-size: 2.2rem;
            font-weight: 800;
            color: #0f172a;
            line-height: 1.2;
        }

        .card-header {
            background: white;
            border-bottom: 2px solid #f1f5f9;
            padding: 1.25rem 1.5rem;
        }

        .card-header h5 {
            font-weight: 700;
            color: #0f172a;
            font-size: 1.2rem;
        }

        .table-modern {
            border-collapse: separate;
            border-spacing: 0 8px;
            padding: 0 8px;
        }

        .table-modern thead th {
            background: #f8fafc;
            color: #475569;
            font-weight: 600;
            font-size: 0.85rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            border: none;
            padding: 1rem;
        }

        .table-modern tbody tr {
            background: white;
            box-shadow: 0 4px 10px rgba(0,0,0,0.02);
            border-radius: 15px;
            transition: all 0.2s ease;
        }

        .table-modern tbody tr:hover {
            background: #f8fafc;
            transform: scale(1.01);
            box-shadow: 0 8px 20px rgba(14, 165, 233, 0.1);
        }

        .table-modern td {
            padding: 1rem;
            border: none;
            vertical-align: middle;
            color: #334155;
        }

        .badge-soft-warning {
            background: #fef3c7;
            color: #92400e;
            font-weight: 500;
            padding: 0.5rem 1rem;
            border-radius: 30px;
            font-size: 0.85rem;
        }

        .badge-soft-success {
            background: #d1fae5;
            color: #065f46;
            font-weight: 500;
            padding: 0.5rem 1rem;
            border-radius: 30px;
            font-size: 0.85rem;
        }

        .badge-soft-info {
            background: #e0f2fe;
            color: #0369a1;
            font-weight: 500;
            padding: 0.5rem 1rem;
            border-radius: 30px;
            font-size: 0.85rem;
        }

        .btn-primary {
            background: var(--wave-gradient);
            border: none;
            border-radius: 12px;
            padding: 0.5rem 1.2rem;
            font-weight: 500;
            font-size: 0.9rem;
            color: white;
            box-shadow: 0 4px 10px rgba(14, 165, 233, 0.3);
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(14, 165, 233, 0.4);
        }

        .btn-outline-secondary {
            border: 2px solid #e2e8f0;
            border-radius: 12px;
            padding: 0.5rem 1.2rem;
            font-weight: 500;
            color: #64748b;
            transition: all 0.3s ease;
        }

        .btn-outline-secondary:hover {
            background: #f8fafc;
            border-color: #0ea5e9;
            color: #0ea5e9;
        }

        .fw-bold {
            color: #0f172a;
        }

        .text-dark {
            color: #1e293b !important;
        }

        .table-modern td:first-child {
            border-radius: 15px 0 0 15px;
        }

        .table-modern td:last-child {
            border-radius: 0 15px 15px 0;
        }
    </style>

    <div class="hero-welcome mb-5">
        <div class="d-flex justify-content-between align-items-center position-relative" style="z-index: 1;">
            <div>
                <h1 class="hero-title">
                    Selamat Bertugas, Petugas! 
                </h1>
                <p class="hero-subtitle mb-0">{{ now()->translatedFormat('l, d F Y') }} • Siap melaut hari ini?</p>
            </div>
            <div class="d-none d-md-block">
                <span style="font-size: 60px; filter: drop-shadow(0 10px 10px rgba(0,0,0,0.2));">⚓</span>
            </div>
        </div>
    </div>

    

   
    <div class="row g-4 mb-5">
        <div class="col-md-4">
            <div class="card-premium h-100">
                <div class="card-body stat-card">
                    <div>
                        <div class="stat-icon-wrapper bg-amber-soft">
                            <i class="bi bi-hourglass-split"></i>
                        </div>
                        <div class="stat-label mb-1">Perlu Persetujuan</div>
                        <div class="stat-value">{{ \App\Models\Peminjaman::where('status', 'pending')->count() }}</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card-premium h-100">
                <div class="card-body stat-card">
                    <div>
                        <div class="stat-icon-wrapper bg-emerald-soft">
                            <i class="bi bi-check-circle"></i>
                        </div>
                        <div class="stat-label mb-1">Sedang Dipinjam</div>
                        <div class="stat-value">{{ \App\Models\Peminjaman::where('status', 'approved')->count() }}</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card-premium h-100">
                <div class="card-body stat-card">
                    <div>
                        <div class="stat-icon-wrapper bg-indigo-soft">
                            <i class="bi bi-arrow-counterclockwise"></i>
                        </div>
                        <div class="stat-label mb-1">Sudah Dikembalikan</div>
                        <div class="stat-value">{{ \App\Models\Peminjaman::where('status', 'returned')->count() }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card-premium">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Permintaan Peminjaman Terbaru</h5>
            <a href="{{ route('petugas.peminjaman.index') }}" class="btn btn-sm btn-outline-secondary">Kelola Semua</a>
        </div>
        <div class="table-responsive">
            <table class="table table-modern align-middle mb-0">
                <thead>
                    <tr>
                        <th class="ps-4">Peminjam</th>
                        <th>Alat</th>
                        <th>Tanggal Pinjam</th>
                        <th>Status</th>
                        <th class="text-end pe-4">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $pending = \App\Models\Peminjaman::with(['user', 'alat'])
                            ->where('status', 'pending')
                            ->orderBy('created_at', 'desc')
                            ->limit(5)
                            ->get();
                    @endphp
                    @forelse($pending as $p)
                        <tr>
                            <td class="ps-4">
                                <div class="fw-bold text-dark">{{ $p->user->name }}</div>
                            </td>
                            <td>{{ $p->alat->nama_alat }}</td>
                            <td>{{ $p->tanggal_pinjam->format('d M Y') }}</td>
                            <td><span class="badge badge-soft-warning">Menunggu</span></td>
                            <td class="text-end pe-4">
                                <a href="{{ route('petugas.peminjaman.show', $p) }}" class="btn btn-sm btn-primary">
                                    Proses
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center py-5 text-muted">Belum ada permintaan baru.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
