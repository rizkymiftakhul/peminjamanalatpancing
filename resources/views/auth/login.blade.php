@extends('layouts.guest')

@section('content')
<style>
/* Tema Pelaut - Laut & Nelayan */
.auth-split-screen {
    min-height: 100vh;
    display: flex;
    background: linear-gradient(135deg, #0B4A6F 0%, #1B6B8F 100%);
    position: relative;
    overflow: hidden;
}

/* Efek ombak di background */
.auth-split-screen::before {
    content: '';
    position: absolute;
    bottom: 0;
    left: 0;
    right: 0;
    height: 150px;
    background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"><path fill="%23ffffff" fill-opacity="0.1" d="M0,96L48,112C96,128,192,160,288,160C384,160,480,128,576,122.7C672,117,768,139,864,154.7C960,171,1056,181,1152,170.7C1248,160,1344,128,1392,112L1440,96L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path></svg>') repeat-x bottom;
    background-size: cover;
    animation: wave 8s linear infinite;
}

.auth-split-screen::after {
    content: '';
    position: absolute;
    bottom: 0;
    left: 0;
    right: 0;
    height: 100px;
    background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"><path fill="%23ffffff" fill-opacity="0.05" d="M0,224L48,213.3C96,203,192,181,288,181.3C384,181,480,203,576,208C672,213,768,203,864,186.7C960,171,1056,149,1152,149.3C1248,149,1344,171,1392,181.3L1440,192L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path></svg>') repeat-x bottom;
    background-size: cover;
    animation: wave 6s linear infinite reverse;
}

@keyframes wave {
    0% { background-position-x: 0; }
    100% { background-position-x: 1440px; }
}

.auth-left {
    flex: 1;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 3rem;
    position: relative;
    z-index: 10;
}

.auth-card {
    max-width: 450px;
    width: 100%;
    background: rgba(255, 255, 255, 0.95);
    backdrop-filter: blur(10px);
    border-radius: 30px;
    padding: 3rem;
    box-shadow: 0 20px 40px rgba(0, 20, 30, 0.3),
                inset 0 -3px 0 rgba(0, 0, 0, 0.1),
                inset 0 3px 0 rgba(255, 255, 255, 0.5);
    border: 1px solid rgba(255, 255, 255, 0.3);
    position: relative;
}

/* Hiasan tali kapal */
.auth-card::before {
    content: '⚓';
    position: absolute;
    top: -20px;
    right: -20px;
    font-size: 4rem;
    opacity: 0.1;
    transform: rotate(15deg);
}

.auth-card::after {
    content: '';
    position: absolute;
    bottom: 30px;
    left: -50px;
    width: 100px;
    height: 100px;
    background: radial-gradient(circle, rgba(255,215,0,0.1) 0%, transparent 70%);
    border-radius: 50%;
}

.bg-indigo-soft {
    background: linear-gradient(135deg, #0B4A6F, #1B6B8F);
    box-shadow: 0 5px 15px rgba(11, 74, 111, 0.3);
}

.bg-indigo-soft i {
    color: #FFD700 !important; /* Warna emas seperti jangkar */
    filter: drop-shadow(0 2px 2px rgba(0,0,0,0.2));
}

/* Style input form dengan tema laut */
.form-control-premium {
    border: 2px solid rgba(11, 74, 111, 0.1);
    border-radius: 15px;
    padding: 12px 20px;
    background: white;
    transition: all 0.3s ease;
    font-size: 0.95rem;
}

.form-control-premium:focus {
    border-color: #0B4A6F;
    box-shadow: 0 0 0 4px rgba(11, 74, 111, 0.1);
    transform: translateY(-2px);
}

.form-control-premium.is-invalid {
    border-color: #dc3545;
    background-image: none;
}

.form-label {
    color: #0B4A6F !important;
    letter-spacing: 1px;
    font-weight: 700 !important;
    display: flex;
    align-items: center;
    gap: 8px;
}

.form-label::before {
    content: '🌊';
    font-size: 1.2rem;
}

/* Checkbox custom */
.form-check-input {
    width: 20px;
    height: 20px;
    border: 2px solid #0B4A6F;
    border-radius: 5px;
    cursor: pointer;
}

.form-check-input:checked {
    background-color: #0B4A6F;
    border-color: #0B4A6F;
}

/* Tombol utama */
.btn-premium {
    background: linear-gradient(135deg, #0B4A6F, #1B6B8F);
    border: none;
    border-radius: 15px;
    color: white;
    font-weight: bold;
    letter-spacing: 1px;
    text-transform: uppercase;
    box-shadow: 0 10px 20px rgba(11, 74, 111, 0.3);
    position: relative;
    overflow: hidden;
}

.btn-premium::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255, 215, 0, 0.3), transparent);
    transition: left 0.5s ease;
}

.btn-premium:hover::before {
    left: 100%;
}

.btn-premium:hover {
    transform: translateY(-3px);
    box-shadow: 0 15px 30px rgba(11, 74, 111, 0.4);
}

.auth-right {
    flex: 1;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 3rem;
    background: rgba(11, 74, 111, 0.3);
    backdrop-filter: blur(5px);
    position: relative;
    z-index: 10;
    border-left: 3px solid rgba(255, 215, 0, 0.3);
}

/* Dekorasi laut di sisi kanan */
.auth-right .position-relative {
    background: rgba(255, 255, 255, 0.1);
    backdrop-filter: blur(10px);
    border-radius: 50px;
    padding: 3rem;
    border: 2px solid rgba(255, 215, 0, 0.2);
}

.auth-right h2 {
    color: white;
    text-shadow: 2px 2px 4px rgba(0,0,0,0.3);
    position: relative;
    display: inline-block;
}

.auth-right h2::after {
    content: '⚓';
    margin-left: 10px;
    font-size: 2rem;
    opacity: 0.8;
}

.auth-right .lead {
    color: rgba(255, 255, 255, 0.9);
    font-style: italic;
}

/* Animasi kapal */
@keyframes sail {
    0%, 100% { transform: translateX(0) rotate(0deg); }
    25% { transform: translateX(5px) rotate(2deg); }
    75% { transform: translateX(-5px) rotate(-2deg); }
}

.img-fluid {
    animation: sail 6s ease-in-out infinite;
    filter: drop-shadow(0 10px 20px rgba(0,0,0,0.3)) brightness(1.1) !important;
}

/* Style link lupa password */
.animate-forgot-password {
    color: #0B4A6F !important;
    font-weight: 700 !important;
    position: relative;
    padding-bottom: 2px;
}

.animate-forgot-password::after {
    background-color: #FFD700 !important;
    height: 3px;
    bottom: -2px;
}

/* Style tombol daftar dengan tema pelaut */
.dual-btn {
    background: linear-gradient(135deg, #0B4A6F 50%, #FFD700 50%);
    background-size: 250% 100%;
    padding: 8px 28px;
    border-radius: 30px;
    box-shadow: 0 5px 15px rgba(11, 74, 111, 0.3);
    position: relative;
    overflow: hidden;
}

.dual-btn span {
    color: white;
    font-weight: bold;
    text-shadow: 1px 1px 2px rgba(0,0,0,0.2);
}

.dual-btn:hover {
    background-position: left bottom;
    transform: scale(1.05) rotate(0deg);
    box-shadow: 0 8px 25px rgba(255, 215, 0, 0.4);
}

/* Efek bintang laut */
.text-muted strong {
    color: #0B4A6F;
    font-size: 1.1rem;
}

/* Hiasan tambahan */
.mb-5 .d-flex {
    position: relative;
}

.mb-5 .d-flex::before {
    content: '⛵';
    position: absolute;
    top: -30px;
    left: -30px;
    font-size: 3rem;
    opacity: 0.1;
    transform: rotate(-10deg);
}

/* Responsive */
@media (max-width: 768px) {
    .auth-card {
        padding: 2rem;
    }
    
    .auth-card::before {
        font-size: 3rem;
        top: -10px;
        right: -10px;
    }
}
</style>

<div class="auth-split-screen">
    <div class="auth-left">
        <div class="auth-card">
            <div class="mb-5">
                <div class="d-flex align-items-center gap-2 mb-2">
                    <div class="bg-indigo-soft p-2 rounded">
                        <i class="bi bi-ship-fill text-primary fs-4"></i>
                    </div>
                    <span class="fw-bold fs-4 text-dark">Gentong.id</span>
                </div>
                <h2 class="fw-bold mb-2 text-dark">Selamat Datang Kembali</h2>
                <p class="text-muted">Masuk untuk mengelola peminjaman alat pancing</p>
            </div>

            @if (session('status'))
                <div class="alert alert-success d-flex align-items-center mb-4" role="alert" style="background: rgba(11, 74, 111, 0.1); border: 2px solid #0B4A6F; border-radius: 15px;">
                    <i class="bi bi-check-circle-fill me-2" style="color: #0B4A6F;"></i>
                    <div>{{ session('status') }}</div>
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="mb-4">
                    <label class="form-label fw-semibold small text-muted text-uppercase">Akun Nelayan</label>
                    <div class="mb-3">
                        <input type="email" class="form-control form-control-premium @error('email') is-invalid @enderror" 
                               name="email" value="{{ old('email') }}" placeholder="Email Address" required autofocus>
                        @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="mb-3">
                        <input type="password" class="form-control form-control-premium @error('password') is-invalid @enderror" 
                               name="password" placeholder="Password" required>
                        @error('password') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>

                <div class="d-flex justify-content-between align-items-center mb-4">
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" id="remember_me" name="remember">
                        <label class="form-check-label text-muted" for="remember_me">Ingat saya</label>
                    </div>
                    @if (Route::has('password.request'))
                       <a href="{{ route('password.request') }}" class="text-primary small fw-bold text-decoration-none animate-forgot-password">
    Lupa Password?
</a>
                    @endif
                </div>

                <button type="submit" class="btn btn-premium w-100 py-3 mb-4">
                    <i class="bi bi-ship me-2"></i> Masuk Sekarang
                </button>

                <p class="text-center text-muted">
    <strong>Belum punya akun?</strong> 
    <a href="{{ route('register') }}" class="dual-btn">
        <span class="dua">D</span>
        <span class="f">a</span>
        <span class="t">f</span>
        <span class="a">t</span>
        <span class="r">a</span>
        <span class="akhir">r</span>
    </a>
</p>
            </form>
        </div>
    </div>

   <div class="auth-right d-none d-lg-flex" style="background: linear-gradient(135deg, rgba(0, 60, 100, 0.85), rgba(0, 30, 60, 0.95)), url('https://images.unsplash.com/photo-1504851149312-7a075b496cc7?ixlib=rb-4.0.3&auto=format&fit=crop&w=1605&q=80') center/cover no-repeat; min-height: 100vh; position: relative;">
    
    <!-- Elemen dekoratif air danau -->
    <div class="water-overlay"></div>
    <div class="water-reflection"></div>
    
    <div class="text-center position-relative" style="z-index: 3; padding: 4rem 2rem;">
        
        <!-- Ilustrasi nelayan dengan efek bayangan air -->
        
        
        <!-- Judul dengan efek teks -->
        <h2 class="fw-bold mb-3 text-glow">Kelola Peminjaman Lebih Mudah</h2>
        
        <!-- Deskripsi -->
        <p class="lead opacity-90 text-white mb-4" style="text-shadow: 2px 2px 4px rgba(0,0,0,0.5); font-size: 1.25rem;">
            System manajemen inventaris alat pancing<br>modern untuk para pelaut Indonesia.
        </p>
        
        <!-- Badge kepercayaan dengan efek premium -->
        <div style="margin-top: 40px;">
            <span class="badge trust-badge">
                <i class="bi bi-star-fill me-2" style="color: #FFD700;"></i>
                Terpercaya di 34 pelabuhan
                <i class="bi bi-star-fill ms-2" style="color: #FFD700;"></i>
            </span>
        </div>
        
        <!-- Info tambahan danau -->
        <div class="lake-info mt-5 pt-4">
            <div class="d-flex justify-content-center align-items-center gap-4">
                <div class="location-badge">
                    <i class="bi bi-geo-alt-fill text-warning me-1"></i>
                    Danau Toba
                </div>
                <div class="location-badge">
                    <i class="bi bi-geo-alt-fill text-warning me-1"></i>
                    Waduk Jatiluhur
                </div>
                <div class="location-badge">
                    <i class="bi bi-geo-alt-fill text-warning me-1"></i>
                    Danau Singkarak
                </div>
            </div>
            <div class="mt-3">
                <span class="text-white-50 small">
                    <i class="bi bi-water me-1"></i>
                    Didukung 15+ spot pemancingan terbaik
                    <i class="bi bi-water ms-1"></i>
                </span>
            </div>
        </div>
    </div>
</div>

<!-- CSS Kustom -->
<style>
/* Background dengan efek danau */
.auth-right {
    position: relative;
    overflow: hidden;
}

/* Overlay gelombang air */
.water-overlay {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: repeating-linear-gradient(
        transparent 0px,
        transparent 20px,
        rgba(255, 255, 255, 0.03) 20px,
        rgba(255, 255, 255, 0.03) 40px
    );
    pointer-events: none;
    z-index: 1;
    animation: waterFlow 15s linear infinite;
}

/* Efek refleksi cahaya di air */
.water-reflection {
    position: absolute;
    top: -50%;
    left: -50%;
    right: -50%;
    bottom: -50%;
    background: radial-gradient(circle at 30% 50%, rgba(255, 255, 255, 0.15) 0%, transparent 60%);
    animation: shimmer 10s ease-in-out infinite;
    pointer-events: none;
    z-index: 1;
}

/* Animasi ilutrasi nelayan */
.floating-illustration {
    animation: float 4s ease-in-out infinite;
}

/* Refleksi ilustrasi di air */
.water-reflection-illustration {
    width: 100%;
    height: 40px;
    background: linear-gradient(180deg, rgba(255,255,255,0.2) 0%, transparent 100%);
    filter: blur(8px);
    transform: scaleY(-1) translateY(-20px);
    opacity: 0.4;
    margin-top: -30px;
}

/* Efek teks bersinar */
.text-glow {
    color: white;
    font-size: 2.5rem;
    text-shadow: 
        0 0 10px rgba(255,215,0,0.3),
        2px 2px 4px rgba(0,0,0,0.5),
        -1px -1px 0 rgba(255,255,255,0.1);
    letter-spacing: 1px;
}

/* Badge kepercayaan premium */
.trust-badge {
    background: rgba(255, 215, 0, 0.15);
    color: white;
    padding: 12px 30px;
    border-radius: 50px;
    border: 2px solid rgba(255, 215, 0, 0.5);
    backdrop-filter: blur(10px);
    font-size: 1.1rem;
    font-weight: 500;
    box-shadow: 
        0 0 30px rgba(255,215,0,0.2),
        inset 0 0 20px rgba(255,255,255,0.1);
    animation: badgePulse 3s infinite;
}

/* Location badge */
.location-badge {
    background: rgba(0, 0, 0, 0.3);
    color: white;
    padding: 6px 15px;
    border-radius: 30px;
    border: 1px solid rgba(255, 215, 0, 0.3);
    backdrop-filter: blur(5px);
    font-size: 0.9rem;
    transition: all 0.3s ease;
}

.location-badge:hover {
    background: rgba(255, 215, 0, 0.2);
    border-color: #FFD700;
    transform: translateY(-2px);
}

/* Animasi */
@keyframes float {
    0%, 100% { transform: translateY(0); }
    50% { transform: translateY(-15px); }
}

@keyframes waterFlow {
    0% { background-position: 0 0; }
    100% { background-position: 0 100px; }
}

@keyframes shimmer {
    0%, 100% { transform: translate(0, 0) rotate(0deg); opacity: 0.3; }
    33% { transform: translate(10%, 5%) rotate(5deg); opacity: 0.5; }
    66% { transform: translate(-5%, 10%) rotate(-3deg); opacity: 0.4; }
}

@keyframes badgePulse {
    0%, 100% { box-shadow: 0 0 30px rgba(255,215,0,0.2); }
    50% { box-shadow: 0 0 50px rgba(255,215,0,0.4); }
}

/* Responsive adjustments */
@media (max-width: 1200px) {
    .text-glow {
        font-size: 2rem;
    }
    
    .floating-illustration {
        max-width: 300px;
    }
    
    .lake-info .d-flex {
        flex-wrap: wrap;
        gap: 10px !important;
    }
}
</style>

<!-- Script untuk password strength (opsional) -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    const passwordInput = document.querySelector('input[name="password"]');
    const strengthBar = document.getElementById('passwordStrength');
    const strengthText = document.getElementById('strengthText');
    
    if (passwordInput) {
        passwordInput.addEventListener('input', function() {
            const password = this.value;
            let strength = 0;
            let color = '#dc3545';
            let text = 'Lemah';
            
            if (password.length >= 8) strength += 25;
            if (password.match(/[a-z]+/)) strength += 25;
            if (password.match(/[A-Z]+/)) strength += 25;
            if (password.match(/[0-9]+/)) strength += 25;
            
            if (strength >= 75) {
                color = '#28a745';
                text = 'Kuat';
            } else if (strength >= 50) {
                color = '#ffc107';
                text = 'Sedang';
            } else if (strength >= 25) {
                color = '#fd7e14';
                text = 'Cukup';
            }
            
            if (password.length === 0) {
                strength = 0;
                text = 'Belum dimasukkan';
                color = '#dc3545';
            }
            
            strengthBar.style.width = strength + '%';
            strengthBar.style.background = color;
            strengthText.textContent = 'Kekuatan password: ' + text;
        });
    }
});
</script>
@endsection