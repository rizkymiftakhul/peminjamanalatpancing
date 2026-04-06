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
    max-width: 500px;
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

/* Hiasan jangkar */
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
    color: #FFD700 !important;
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
    margin-bottom: 15px;
}

.form-label::before {
    content: '🌊';
    font-size: 1.2rem;
}

/* Label khusus untuk section berbeda */
.mb-4:first-of-type .form-label::before {
    content: '';
}

.mb-4:last-of-type .form-label::before {
    content: '';
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
    transition: all 0.3s ease;
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

.btn-premium i {
    margin-right: 8px;
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
    content: '🎣';
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

/* Style untuk link login */
.text-center a {
    color: #FFD700 !important;
    font-weight: 700 !important;
    position: relative;
    padding: 5px 15px;
    border-radius: 25px;
    background: rgba(11, 74, 111, 0.1);
    transition: all 0.3s ease;
    margin-left: 8px;
}

.text-center a:hover {
    background: #0B4A6F;
    color: white !important;
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(0,0,0,0.2);
}

.text-center a::before {
    content: '⛵';
    margin-right: 5px;
    opacity: 0;
    transition: all 0.3s ease;
}

.text-center a:hover::before {
    opacity: 1;
}

/* Hiasan tambahan */
.mb-5 .d-flex {
    position: relative;
}

.mb-5 .d-flex::before {
    content: '⚓';
    position: absolute;
    top: -30px;
    left: -30px;
    font-size: 3rem;
    opacity: 0.1;
    transform: rotate(-10deg);
}

/* Strength meter untuk password (opsional) */
.password-strength {
    height: 5px;
    border-radius: 10px;
    background: #e0e0e0;
    margin-top: 8px;
    overflow: hidden;
}

.password-strength-bar {
    height: 100%;
    width: 0;
    transition: all 0.3s ease;
}

/* Tooltip style */
.invalid-feedback {
    background: rgba(220, 53, 69, 0.1);
    padding: 5px 10px;
    border-radius: 8px;
    margin-top: 5px;
    border-left: 3px solid #dc3545;
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
    
    .auth-right .position-relative {
        padding: 2rem;
    }
}

/* Efek bubbles */
@keyframes bubble {
    0% { transform: translateY(0) scale(1); opacity: 0; }
    50% { opacity: 0.5; }
    100% { transform: translateY(-100px) scale(1.5); opacity: 0; }
}

.auth-left::after {
    content: '💧';
    position: absolute;
    bottom: 20px;
    left: 20%;
    font-size: 1rem;
    animation: bubble 3s ease-in-out infinite;
    opacity: 0;
}

.auth-left::before {
    content: '💧';
    position: absolute;
    bottom: 50px;
    left: 80%;
    font-size: 1.2rem;
    animation: bubble 4s ease-in-out infinite 1s;
    opacity: 0;
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
                <h2 class="fw-bold mb-2 text-dark">Buat Akun Baru</h2>
                <p class="text-muted">Mulai perjalanan memancing Anda hari ini</p>
            </div>

            <form method="POST" action="{{ route('register') }}">
                @csrf

                <div class="mb-4">
                    <label class="form-label fw-semibold small text-muted text-uppercase">
                        <i class="bi bi-person-badge me-2"></i>Informasi Pribadi
                    </label>
                    <div class="mb-3">
                        <input type="text" class="form-control form-control-premium @error('name') is-invalid @enderror" 
                               name="name" value="{{ old('name') }}" placeholder="Nama Lengkap" required autofocus>
                        @error('name') 
                            <div class="invalid-feedback">
                                <i class="bi bi-exclamation-triangle-fill me-1"></i>
                                {{ $message }}
                            </div> 
                        @enderror
                    </div>
                    <div class="mb-3">
                        <input type="email" class="form-control form-control-premium @error('email') is-invalid @enderror" 
                               name="email" value="{{ old('email') }}" placeholder="Email Address" required>
                        @error('email') 
                            <div class="invalid-feedback">
                                <i class="bi bi-exclamation-triangle-fill me-1"></i>
                                {{ $message }}
                            </div> 
                        @enderror
                    </div>
                </div>

                <div class="mb-4">
                    <label class="form-label fw-semibold small text-muted text-uppercase">
                        <i class="bi bi-shield-lock me-2"></i>Keamanan
                    </label>
                    <div class="mb-3">
                        <input type="password" class="form-control form-control-premium @error('password') is-invalid @enderror" 
                               name="password" placeholder="Password (Min. 8 karakter)" required>
                        @error('password') 
                            <div class="invalid-feedback">
                                <i class="bi bi-exclamation-triangle-fill me-1"></i>
                                {{ $message }}
                            </div> 
                        @enderror
                    </div>
                    <div class="mb-3">
                        <input type="password" class="form-control form-control-premium" 
                               name="password_confirmation" placeholder="Ulangi Password" required>
                    </div>
                    
                    <!-- Password strength indicator (opsional) -->
                    <div class="password-strength">
                        <div class="password-strength-bar" id="passwordStrength" style="width: 0%; background: #dc3545;"></div>
                    </div>
                    <small class="text-muted" id="strengthText">Kekuatan password: Belum dimasukkan</small>
                </div>

                <button type="submit" class="btn btn-premium w-100 py-3 mb-4">
                    <i class="bi bi-ship me-2"></i> Daftar Sekarang
                </button>

                <p class="text-center text-muted">
                    <i class="bi bi-anchor me-1"></i>
                    Sudah punya akun? 
                    <a href="{{ route('login') }}" class="text-decoration-none">
                        <i class="bi bi-box-arrow-in-right me-1"></i>Masuk
                    </a>
                </p>
            </form>
        </div>
    </div>

    <div class="auth-right d-none d-lg-flex" style="background: linear-gradient(rgba(0, 40, 80, 0.8), rgba(0, 20, 50, 0.9)), url('https://images.unsplash.com/photo-1501785888041-af3ef285b470?ixlib=rb-4.0.3&auto=format&fit=crop&w=2070&q=80') center/cover no-repeat; min-height: 100vh; position: relative;">
    <div class="text-center position-relative" style="z-index: 2; padding: 3rem;">
        
        <h2 class="fw-bold mb-3 text-white" style="text-shadow: 2px 2px 4px rgba(0,0,0,0.5);">Sewa Alat Pancing Terbaik</h2>
        <p class="lead opacity-90 text-white" style="text-shadow: 1px 1px 3px rgba(0,0,0,0.5);">Akses ratusan alat pancing premium dengan harga terjangkau.<br>Mudah, Cepat, dan Terpercaya.</p>
        
        <!-- Badge kepercayaan dengan efek glow -->
        <div class="d-flex justify-content-center gap-3 mt-4">
            <span class="badge" style="background: rgba(255,215,0,0.2); color: white; padding: 8px 20px; border-radius: 50px; border: 2px solid #FFD700; backdrop-filter: blur(5px); box-shadow: 0 0 20px rgba(255,215,0,0.3);">
                <i class="bi bi-star-fill me-2" style="color: #FFD700;"></i>+500 Alat
            </span>
            <span class="badge" style="background: rgba(255,215,0,0.2); color: white; padding: 8px 20px; border-radius: 50px; border: 2px solid #FFD700; backdrop-filter: blur(5px); box-shadow: 0 0 20px rgba(255,215,0,0.3);">
                <i class="bi bi-people-fill me-2" style="color: #FFD700;"></i>+1000 Nelayan
            </span>
        </div>

        <!-- Elemen dekoratif danau -->
        <div class="mt-5 pt-4">
            <div class="d-flex justify-content-center align-items-center gap-2 text-white-50">
                <i class="bi bi-water" style="font-size: 1.2rem;"></i>
                <span style="opacity: 0.7;">Danau Toba • Waduk Jatiluhur • Danau Singkarak</span>
                <i class="bi bi-water" style="font-size: 1.2rem;"></i>
            </div>
        </div>
    </div>
</div>

<!-- Efek air danau (animasi ombak) -->
<style>
.auth-right::before {
    content: '';
    position: absolute;
    bottom: 0;
    left: 0;
    right: 0;
    height: 100px;
    background: linear-gradient(transparent, rgba(255,255,255,0.1));
    pointer-events: none;
    z-index: 1;
}

.auth-right::after {
    content: '';
    position: absolute;
    bottom: 20px;
    left: 0;
    right: 0;
    height: 3px;
    background: linear-gradient(90deg, transparent, rgba(255,255,255,0.5), transparent);
    animation: wave 3s ease-in-out infinite;
    z-index: 1;
}

@keyframes wave {
    0%, 100% { transform: translateY(0); opacity: 0.3; }
    50% { transform: translateY(-10px); opacity: 0.6; }
}

/* Efek shimmer pada air */
.water-reflection {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: radial-gradient(circle at 30% 50%, rgba(255,255,255,0.1) 0%, transparent 50%);
    pointer-events: none;
    animation: shimmer 8s infinite;
    z-index: 1;
}

@keyframes shimmer {
    0% { opacity: 0.3; transform: translateX(-100%); }
    50% { opacity: 0.6; transform: translateX(100%); }
    100% { opacity: 0.3; transform: translateX(200%); }
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