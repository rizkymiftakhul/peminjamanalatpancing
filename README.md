<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UKK Peminjaman Alat - Sistem Manajemen Inventaris</title>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Public+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    
    <style>
        body {
            font-family: 'Public Sans', sans-serif;
            min-height: 100vh;
            position: relative;
            overflow-x: hidden;
        }
        
        /* Background danau dengan overlay */
        body::before {
            content: '';
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-image: url('https://images.unsplash.com/photo-1501785888041-af3ef285b470?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2070&q=80');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            z-index: -2;
        }
        
        /* Overlay gelap untuk meningkatkan keterbacaan teks */
        body::after {
            content: '';
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, rgba(16, 57, 73, 0.85) 0%, rgba(12, 99, 106, 0.75) 100%);
            z-index: -1;
        }
        
        .hero-section {
            min-height: 100vh;
            display: flex;
            align-items: center;
            padding-top: 2rem;
            padding-bottom: 2rem;
        }
        
        .logo-box {
            width: 80px;
            height: 80px;
            background: linear-gradient(135deg, rgba(0, 167, 111, 0.9) 0%, rgba(0, 214, 143, 0.9) 100%);
            backdrop-filter: blur(10px);
            border-radius: 1.5rem;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 20px 60px rgba(0, 167, 111, 0.3);
            border: 1px solid rgba(255, 255, 255, 0.1);
        }
        
        .logo-box i {
            font-size: 2.5rem;
            color: white;
        }
        
        .hero-title {
            font-size: 3.5rem;
            font-weight: 800;
            color: white;
            line-height: 1.2;
            margin-bottom: 1.5rem;
            text-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
        }
        
        .hero-subtitle {
            font-size: 1.25rem;
            color: rgba(255, 255, 255, 0.85);
            font-weight: 500;
            margin-bottom: 2.5rem;
        }
        
        .btn-primary-custom {
            background: linear-gradient(135deg, rgba(0, 167, 111, 0.95) 0%, rgba(0, 214, 143, 0.95) 100%);
            border: none;
            padding: 1rem 2.5rem;
            font-size: 1.125rem;
            font-weight: 700;
            border-radius: 0.75rem;
            box-shadow: 0 8px 24px rgba(0, 167, 111, 0.4);
            transition: all 0.3s ease;
            color: white;
            backdrop-filter: blur(4px);
        }
        
        .btn-primary-custom:hover {
            transform: translateY(-3px);
            box-shadow: 0 12px 32px rgba(0, 167, 111, 0.5);
            background: linear-gradient(135deg, #00a76f 0%, #00d68f 100%);
            color: white;
        }
        
        .btn-outline-custom {
            border: 2px solid rgba(255, 255, 255, 0.7);
            color: white;
            padding: 1rem 2.5rem;
            font-size: 1.125rem;
            font-weight: 700;
            border-radius: 0.75rem;
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            transition: all 0.3s ease;
        }
        
        .btn-outline-custom:hover {
            background: rgba(255, 255, 255, 0.2);
            color: white;
            transform: translateY(-3px);
            box-shadow: 0 8px 24px rgba(255, 255, 255, 0.1);
            border-color: white;
        }
        
        .feature-card {
            background: rgba(255, 255, 255, 0.1);
            border-radius: 1.5rem;
            padding: 2rem;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
            border: 1px solid rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            color: white;
        }
        
        .feature-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 16px 48px rgba(0, 0, 0, 0.2);
            background: rgba(255, 255, 255, 0.15);
            border-color: rgba(255, 255, 255, 0.2);
        }
        
        .feature-icon {
            width: 64px;
            height: 64px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 1rem;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 1.5rem;
            backdrop-filter: blur(4px);
            border: 1px solid rgba(255, 255, 255, 0.05);
        }
        
        .feature-icon i {
            font-size: 2rem;
            color: #00d68f;
        }
        
        .stats-box {
            background: rgba(255, 255, 255, 0.1);
            border-radius: 1rem;
            padding: 1.5rem;
            text-align: center;
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.05);
            color: white;
        }
        
        .stats-number {
            font-size: 2.5rem;
            font-weight: 800;
            color: #00d68f;
            text-shadow: 0 2px 8px rgba(0, 0, 0, 0.2);
        }
        
        .stats-label {
            color: rgba(255, 255, 255, 0.8);
            font-weight: 600;
        }
        
        /* Animasi untuk gelombang air */
        .wave-effect {
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 150px;
            background: url('https://i.ibb.co/rZc2W7T/wave.png');
            background-size: 1000px 150px;
            animation: wave 20s linear infinite;
            opacity: 0.3;
            z-index: 0;
        }
        
        .wave-effect:nth-child(2) {
            animation: wave 15s linear infinite;
            opacity: 0.2;
            bottom: 10px;
        }
        
        .wave-effect:nth-child(3) {
            animation: wave 10s linear infinite;
            opacity: 0.1;
            bottom: 20px;
        }
        
        @keyframes wave {
            0% {
                background-position-x: 0;
            }
            100% {
                background-position-x: 1000px;
            }
        }
        
        /* Efek partikel untuk latar belakang */
        .particles {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -1;
        }
        
        .particle {
            position: absolute;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.1);
        }
        
        /* Responsiveness */
        @media (max-width: 768px) {
            .hero-title {
                font-size: 2.5rem;
            }
            
            .hero-subtitle {
                font-size: 1.1rem;
            }
            
            .stats-number {
                font-size: 2rem;
            }
        }
    </style>
</head>
<body>
    <!-- Efek partikel latar belakang -->
    <div class="particles" id="particles"></div>
    
    <!-- Efek gelombang air -->
    <div class="wave-effect"></div>
    <div class="wave-effect"></div>
    <div class="wave-effect"></div>
    
    <div class="hero-section">
        <div class="container">
            <div class="row align-items-center">
    <div class="col-lg-6 mb-5 mb-lg-0">
        <div class="d-flex align-items-center gap-3 mb-4">
            <div class="logo-box">
             <i class="bi bi-upc-scan"></i> <!-- Mirip bentuk reel/joran -->
            </div>
                        <h3 class="mb-0 fw-bold" style="color: white;">UKK Peminjaman</h3>
                    </div>
                    
                    <h1 class="hero-title">
                       Sistem Peminjaman <br>
                        <span style="background: linear-gradient(135deg, #00d68f 0%, #a7f3d0 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent;"> Alat Pancing</span>
                    </h1>
                    
                    <p class="hero-subtitle">
                        Kelola inventaris dan peminjaman alat dengan mudah, cepat, dan efisien. 
                        Platform modern untuk optimasi workflow Anda dengan latar alam yang menenangkan.
                    </p>
                    
                    <div class="d-flex gap-3 flex-wrap">
                        <a href="{{ route('login') }}" class="btn btn-primary-custom">
                            <i class="bi bi-box-arrow-in-right me-2"></i>Masuk Sekarang
                        </a>
                        <a href="{{ route('register') }}" class="btn btn-outline-custom">
                            <i class="bi bi-person-plus me-2"></i>Daftar Gratis
                        </a>
                    </div>
                    
                    <div class="row mt-5 g-3">
                        <div class="col-4">
                            <div class="stats-box">
                                <div class="stats-number">150+</div>
                                <div class="stats-label">Alat</div>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="stats-box">
                                <div class="stats-number">2,500+</div>
                                <div class="stats-label">Pengguna</div>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="stats-box">
                                <div class="stats-number">5,200+</div>
                                <div class="stats-label">Transaksi</div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-6">
                    <div class="row g-4">
                        <div class="col-12">
                            <div class="feature-card">
                                <div class="feature-icon">
                                    <i class="bi bi-lightning-charge-fill"></i>
                                </div>
                                <h4 class="fw-bold mb-2">Proses Cepat</h4>
                                <p class="mb-0" style="color: rgba(255, 255, 255, 0.8);">
                                    Pengajuan dan approval peminjaman dalam hitungan detik. Sistem otomatis untuk efisiensi maksimal.
                                </p>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="feature-card">
                                <div class="feature-icon">
                                    <i class="bi bi-shield-check"></i>
                                </div>
                                <h4 class="fw-bold mb-2">Aman & Terpercaya</h4>
                                <p class="mb-0" style="color: rgba(255, 255, 255, 0.8);">
                                    Sistem keamanan berlapis dengan log aktivitas lengkap. Data Anda dijamin aman.
                                </p>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="feature-card">
                                <div class="feature-icon">
                                    <i class="bi bi-graph-up"></i>
                                </div>
                                <h4 class="fw-bold mb-2">Laporan Real-time</h4>
                                <p class="mb-0" style="color: rgba(255, 255, 255, 0.8);">
                                    Dashboard analytics dan laporan lengkap untuk monitoring inventaris Anda.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        // Script untuk efek partikel bergerak
        document.addEventListener('DOMContentLoaded', function() {
            const particlesContainer = document.getElementById('particles');
            const particleCount = 30;
            
            for (let i = 0; i < particleCount; i++) {
                const particle = document.createElement('div');
                particle.classList.add('particle');
                
                // Ukuran acak
                const size = Math.random() * 20 + 5;
                particle.style.width = `${size}px`;
                particle.style.height = `${size}px`;
                
                // Posisi acak
                particle.style.left = `${Math.random() * 100}%`;
                particle.style.top = `${Math.random() * 100}%`;
                
                // Opasitas acak
                particle.style.opacity = Math.random() * 0.3 + 0.1;
                
                // Animasi bergerak
                const duration = Math.random() * 20 + 10;
                particle.style.animation = `float ${duration}s infinite ease-in-out`;
                
                // Tambahkan ke container
                particlesContainer.appendChild(particle);
            }
            
            // Tambahkan CSS untuk animasi partikel
            const style = document.createElement('style');
            style.textContent = `
                @keyframes float {
                    0%, 100% {
                        transform: translate(0, 0) rotate(0deg);
                    }
                    25% {
                        transform: translate(${Math.random() * 50 - 25}px, ${Math.random() * 50 - 25}px) rotate(${Math.random() * 180}deg);
                    }
                    50% {
                        transform: translate(${Math.random() * 50 - 25}px, ${Math.random() * 50 - 25}px) rotate(${Math.random() * 180}deg);
                    }
                    75% {
                        transform: translate(${Math.random() * 50 - 25}px, ${Math.random() * 50 - 25}px) rotate(${Math.random() * 180}deg);
                    }
                }
            `;
            document.head.appendChild(style);
        });
    </script>
</body>
</html>
