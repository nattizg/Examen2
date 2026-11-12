<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Iniciar sesion - Agrovalle Honduras</title>

<!-- Favicon -->
<link rel="icon" type="image/png" href="{{asset ('spark/assets/images/favicon.ico') }}">

<!-- Local Third-Party Libraries (100% Offline Compatible) -->
<link rel="stylesheet" href="{{ asset ('spark/assets/libs/bootstrap/css/bootstrap.min.css') }}">
<link rel="stylesheet" href="{{ asset ('spark/assets/libs/bootstrap-icons/bootstrap-icons.css') }}">

<!-- Main Design System & Custom Stylesheet -->
<link rel="stylesheet" href="{{ asset ('spark/assets/css/main.css') }}">
</head>
<body>

<!-- ==========================================
        START: Authentication Container & Login Card
    ========================================== -->
<div class="login-wrapper">
    
    <!-- Glowing background shapes for modern visual appearance -->
    <div class="login-bg-shape login-bg-shape-1"></div>
    <div class="login-bg-shape login-bg-shape-2"></div>
    
    <!-- Main centered login card -->
    <div class="login-card">
        
    <!-- Brand Identity -->
    <a href="'login'" class="login-brand text-decoration-none">
        <i class="bi bi-asterisk"></i>
        <span>AGROVALLE</span>
    </a>
    
    <p class="login-subtitle">Inicia sesión para acceder a tu panel de control.</p>
        
    <!-- Login Form -->
    <form action="{{ route('login') }}" method="POST" id="loginForm" class="needs-validation" novalidate>
    @csrf

    <!-- Email Input Group -->
    <div class="login-form-group mb-3">
        <label for="email" class="login-form-label">Correo electrónico</label>
        <div class="login-input-group">
            <i class="bi bi-envelope input-icon"></i>
            <input type="email" id="email" name="email" value="{{ old('email') }}" class="login-input @error('email') is-invalid @enderror" placeholder="usuario@agrovalle.hn" required>
        </div>
        @error('email')
            <div class="text-danger small mt-1">
                <i class="bi bi-exclamation-circle-fill"></i> {{ $message }}
            </div>
        @enderror
    </div>

    <!-- Password Input Group -->
    <div class="login-form-group mb-3">
        <label for="password" class="login-form-label">Contraseña</label>
        <div class="login-input-group">
            <i class="bi bi-shield-lock input-icon"></i>
            <input type="password" id="password" name="password" class="login-input login-input-password @error('password') is-invalid @enderror" placeholder="••••••••" required>
            <button type="button" class="password-toggle-btn" id="toggle-password" aria-label="Show password">
                <i class="bi bi-eye"></i>
            </button>
        </div>
        @error('password')
            <div class="text-danger small mt-1">
                <i class="bi bi-exclamation-circle-fill"></i> {{ $message }}
            </div>
        @enderror
    </div>

    <!-- Options (Remember me) -->
    <div class="login-options mb-3">
        <label class="custom-control-label">
            <input type="checkbox" class="custom-checkbox-input" id="remember" name="remember">
            <span>Recordar mi sesión</span>
        </label>
    </div>

    <!-- Submit Button -->
    <button type="submit" class="btn-login" id="btn-submit">
        <span>Ingresar</span>
        <i class="bi bi-arrow-right"></i>
    </button>
    </form>
            
            <!-- Divider -->
            <div class="login-divider">Or sign in with</div>
            
            <!-- Social Logins -->
            <div class="social-login-grid">
                <button class="btn-social" type="button" id="btn-google">
                    <i class="bi bi-google text-danger"></i>
                    <span>Google</span>
                </button>
            </div>
            
            <!-- Footer Link -->
            <p class="login-footer-text">
                Don't have an account? <a href="#" id="link-register">Register Now</a>
            </p>
            
        </div>
    </div>
    <!-- END: Authentication Container -->

    <!-- Local Bootstrap bundle -->
    <script src="{{ asset ('spark/assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    
    <!-- Custom Authentication interactions script -->
    <script src="{{ asset ('spark/assets/js/auth.js') }}"></script>
</body>
</html>
