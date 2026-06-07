<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Investdu - Log In</title>
    <meta name="description" content="Login ke akun Investdu dan lanjutkan petualangan investasimu!">

    {{-- Google Fonts: Inter (same as home) --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        /* ===== Reset & Base — matching home.blade.php ===== */
        *, *::before, *::after { margin: 0; padding: 0; box-sizing: border-box; }

        html {
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
        }

        body {
            font-family: 'Inter', system-ui, -apple-system, sans-serif;
            min-height: 100vh;
            background-color: #0F172A;
            color: #F8FAFC;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            overflow-x: hidden;
            position: relative;
        }

        ::selection {
            background-color: rgba(37, 99, 235, 0.35);
            color: #F8FAFC;
        }

        a { text-decoration: none; color: inherit; }
        button { font-family: inherit; cursor: pointer; }

        /* ===== AMBIENT BACKGROUND — same hero blobs style ===== */
        .bg-ambient {
            position: fixed;
            inset: 0;
            z-index: 0;
            pointer-events: none;
            overflow: hidden;
        }

        .bg-blob {
            position: absolute;
            border-radius: 50%;
            filter: blur(90px);
        }

        .bg-blob-1 {
            width: 450px; height: 450px;
            background: rgba(37, 99, 235, 0.07);
            top: -15%; right: 5%;
            animation: blobPulse 10s ease-in-out infinite;
        }

        .bg-blob-2 {
            width: 350px; height: 350px;
            background: rgba(212, 175, 55, 0.05);
            bottom: -10%; left: 10%;
            animation: blobPulse 12s ease-in-out infinite 3s;
        }

        .bg-blob-3 {
            width: 280px; height: 280px;
            background: rgba(37, 99, 235, 0.04);
            top: 40%; left: -5%;
            animation: blobPulse 14s ease-in-out infinite 6s;
        }

        @keyframes blobPulse {
            0%, 100% { transform: scale(1); opacity: 0.6; }
            50% { transform: scale(1.2); opacity: 1; }
        }

        /* Subtle grid pattern overlay */
        .bg-grid {
            position: fixed;
            inset: 0;
            z-index: 0;
            pointer-events: none;
            background-image:
                linear-gradient(rgba(71, 85, 105, 0.04) 1px, transparent 1px),
                linear-gradient(90deg, rgba(71, 85, 105, 0.04) 1px, transparent 1px);
            background-size: 60px 60px;
        }

        /* ===== LAYOUT ===== */
        .auth-wrapper {
            position: relative;
            z-index: 10;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            padding: 2.5rem 1rem;
            width: 100%;
        }

        /* ===== LOGO — matching navbar .logo from home ===== */
        .auth-logo {
            display: flex;
            align-items: center;
            gap: 0.625rem;
            font-size: 1.375rem;
            font-weight: 800;
            letter-spacing: -0.03em;
            color: #F8FAFC;
            text-decoration: none;
            margin-bottom: 2rem;
            transition: opacity 0.3s ease;
            opacity: 0;
            animation: revealUp 0.6s ease forwards 0.1s;
        }

        .auth-logo:hover { opacity: 0.85; }

        .auth-logo .gold { color: #D4AF37; }

        .auth-logo svg {
            width: 34px;
            height: 34px;
            border-radius: 10px;
            flex-shrink: 0;
        }

        /* ===== FORM CARD — glassmorphism like navbar/cards ===== */
        .form-card {
            width: 100%;
            max-width: 440px;
            background-color: #1E293B;
            border: 1px solid rgba(71, 85, 105, 0.28);
            border-radius: 1.25rem;
            padding: 2.5rem 2.25rem 2rem;
            box-shadow:
                0 8px 32px rgba(0, 0, 0, 0.3),
                0 0 0 1px rgba(71, 85, 105, 0.1);
            opacity: 0;
            animation: revealScale 0.6s ease forwards 0.2s;
        }

        /* ===== HEADING ===== */
        .form-heading {
            text-align: center;
            margin-bottom: 1.75rem;
        }

        .form-heading h1 {
            font-size: 1.5rem;
            font-weight: 800;
            color: #F8FAFC;
            letter-spacing: -0.03em;
            margin-bottom: 0.4rem;
        }

        .form-heading p {
            font-size: 0.875rem;
            color: #94A3B8;
            font-weight: 400;
        }

        /* ===== FORM INPUTS ===== */
        .form-group {
            margin-bottom: 1.15rem;
        }

        .label-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 0.45rem;
        }

        .form-label {
            font-size: 0.8125rem;
            font-weight: 600;
            color: #CBD5E1;
            letter-spacing: 0.01em;
        }

        .forgot-link {
            font-size: 0.8125rem;
            font-weight: 600;
            color: #3B82F6;
            text-decoration: none;
            transition: color 0.2s;
        }

        .forgot-link:hover {
            color: #60A5FA;
        }

        .form-input {
            width: 100%;
            font-family: 'Inter', system-ui, sans-serif;
            font-size: 0.9375rem;
            color: #F8FAFC;
            background-color: rgba(30, 41, 59, 0.5);
            border: 1px solid rgba(71, 85, 105, 0.40);
            border-radius: 0.75rem;
            padding: 0.8125rem 1rem;
            outline: none;
            transition: all 0.3s ease;
        }

        .form-input::placeholder {
            color: #64748B;
            font-weight: 400;
        }

        .form-input:focus {
            border-color: #2563EB;
            background-color: rgba(30, 41, 59, 0.75);
            box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.12);
        }

        .form-input.input-error {
            border-color: #EF4444;
            box-shadow: 0 0 0 3px rgba(239, 68, 68, 0.12);
        }

        /* Password wrapper */
        .password-wrapper {
            position: relative;
        }

        .password-wrapper .form-input {
            padding-right: 3rem;
        }

        .password-toggle {
            position: absolute;
            right: 12px;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            cursor: pointer;
            color: #64748B;
            padding: 4px;
            transition: color 0.2s;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .password-toggle:hover { color: #CBD5E1; }

        .password-toggle svg {
            width: 20px;
            height: 20px;
        }

        /* Error text */
        .error-text {
            font-size: 0.75rem;
            color: #EF4444;
            margin-top: 0.35rem;
            font-weight: 500;
        }

        /* ===== REMEMBER ME ===== */
        .checkbox-row {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            margin-bottom: 1.25rem;
        }

        .checkbox-row input[type="checkbox"] {
            width: 16px;
            height: 16px;
            accent-color: #2563EB;
            cursor: pointer;
            border-radius: 4px;
        }

        .checkbox-row label {
            font-size: 0.8125rem;
            color: #94A3B8;
            cursor: pointer;
            user-select: none;
            font-weight: 500;
        }

        /* ===== SUBMIT BUTTON — matching .btn-login / .cta-btn ===== */
        .btn-submit {
            width: 100%;
            font-family: 'Inter', system-ui, sans-serif;
            font-size: 0.9375rem;
            font-weight: 700;
            color: #ffffff;
            background-color: #2563EB;
            border: none;
            border-radius: 0.75rem;
            padding: 0.8125rem 1rem;
            cursor: pointer;
            letter-spacing: 0.02em;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(37, 99, 235, 0.35);
            position: relative;
            overflow: hidden;
        }

        .btn-submit:hover {
            background-color: #3B82F6;
            transform: translateY(-1px);
            box-shadow: 0 8px 25px rgba(37, 99, 235, 0.45);
        }

        .btn-submit:active {
            transform: translateY(0);
            box-shadow: 0 2px 10px rgba(37, 99, 235, 0.3);
        }

        /* ===== DIVIDER ===== */
        .divider {
            display: flex;
            align-items: center;
            gap: 1rem;
            margin: 1.5rem 0;
        }

        .divider-line {
            flex: 1;
            height: 1px;
            background: rgba(71, 85, 105, 0.3);
        }

        .divider-text {
            font-size: 0.8125rem;
            color: #64748B;
            font-weight: 500;
            white-space: nowrap;
        }

        /* ===== GOOGLE BUTTON — matching .btn-social style ===== */
        .btn-google {
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.65rem;
            font-family: 'Inter', system-ui, sans-serif;
            font-size: 0.875rem;
            font-weight: 600;
            color: #CBD5E1;
            background-color: rgba(30, 41, 59, 0.45);
            border: 1px solid rgba(71, 85, 105, 0.35);
            border-radius: 0.75rem;
            padding: 0.8125rem 1rem;
            cursor: pointer;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .btn-google:hover {
            border-color: rgba(37, 99, 235, 0.5);
            color: #F8FAFC;
            background-color: rgba(37, 99, 235, 0.12);
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(37, 99, 235, 0.15);
        }

        .btn-google:active {
            transform: translateY(0);
        }

        .btn-google svg {
            width: 20px;
            height: 20px;
            flex-shrink: 0;
        }

        /* ===== FOOTER ===== */
        .auth-footer {
            text-align: center;
            margin-top: 1.75rem;
            font-size: 0.875rem;
            color: #64748B;
            font-weight: 500;
            opacity: 0;
            animation: revealUp 0.5s ease forwards 0.5s;
        }

        .auth-footer a {
            color: #3B82F6;
            text-decoration: none;
            font-weight: 600;
            transition: color 0.2s;
        }

        .auth-footer a:hover {
            color: #60A5FA;
        }

        /* ===== FLASH SUCCESS ===== */
        .flash-success {
            width: 100%;
            max-width: 440px;
            background-color: rgba(16, 185, 129, 0.08);
            border: 1px solid rgba(16, 185, 129, 0.25);
            border-radius: 0.75rem;
            padding: 0.75rem 1rem;
            margin-bottom: 1rem;
            font-size: 0.8125rem;
            font-weight: 500;
            color: #10B981;
            text-align: center;
            opacity: 0;
            animation: revealUp 0.4s ease forwards 0.1s;
        }

        /* ===== ANIMATIONS — matching home.blade.php ===== */
        @keyframes revealUp {
            0% { opacity: 0; transform: translateY(16px); }
            100% { opacity: 1; transform: translateY(0); }
        }

        @keyframes revealScale {
            0% { opacity: 0; transform: scale(0.96) translateY(10px); }
            100% { opacity: 1; transform: scale(1) translateY(0); }
        }

        /* ===== RESPONSIVE ===== */
        @media (max-width: 520px) {
            .auth-wrapper { padding: 1.5rem 1rem; }
            .form-card {
                padding: 2rem 1.5rem 1.75rem;
                border-radius: 1rem;
            }
            .form-heading h1 { font-size: 1.3rem; }
            .auth-logo { font-size: 1.2rem; }
        }

        /* ===== SCROLLBAR ===== */
        ::-webkit-scrollbar { width: 6px; }
        ::-webkit-scrollbar-track { background: #0F172A; }
        ::-webkit-scrollbar-thumb { background: #1E293B; border-radius: 3px; }
        ::-webkit-scrollbar-thumb:hover { background: #334155; }
    </style>
</head>
<body>

    {{-- ===== AMBIENT BACKGROUND ===== --}}
    <div class="bg-ambient">
        <div class="bg-blob bg-blob-1"></div>
        <div class="bg-blob bg-blob-2"></div>
        <div class="bg-blob bg-blob-3"></div>
    </div>
    <div class="bg-grid"></div>

    {{-- ===== MAIN CONTENT ===== --}}
    <main class="auth-wrapper">

        {{-- Logo — same SVG as home navbar --}}
        <a href="/" class="auth-logo" id="logoLink">
            <svg viewBox="0 0 34 34" fill="none">
                <rect width="34" height="34" rx="9" fill="#2563EB"/>
                <path d="M9 24L14 12L18 19L23 10L25 15" stroke="#fff" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"/>
                <circle cx="25" cy="15" r="2.2" fill="#D4AF37"/>
            </svg>
            INVEST<span class="gold">DU</span>
        </a>

        {{-- Flash success --}}
        @if(session('success'))
            <div class="flash-success">✅ {{ session('success') }}</div>
        @endif

        {{-- Form Card --}}
        <div class="form-card">

            {{-- Heading --}}
            <div class="form-heading">
                <h1>Log in to your account</h1>
                <p>Welcome back, enter your credentials to continue.</p>
            </div>

            {{-- Login Form --}}
            <form action="{{ route('login') }}" method="POST" id="loginForm">
                @csrf

                {{-- Email / Username --}}
                <div class="form-group">
                    <div class="label-row">
                        <label for="login" class="form-label">Email or Username</label>
                    </div>
                    <input
                        type="text"
                        name="login"
                        id="login"
                        class="form-input @error('login') input-error @enderror"
                        placeholder="Enter your email or username"
                        value="{{ old('login') }}"
                        required
                        autocomplete="username"
                    >
                    @error('login')
                        <p class="error-text">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Password --}}
                <div class="form-group">
                    <div class="label-row">
                        <label for="loginPassword" class="form-label">Password</label>
                        <a href="#" class="forgot-link">Forgot password?</a>
                    </div>
                    <div class="password-wrapper">
                        <input
                            type="password"
                            name="password"
                            id="loginPassword"
                            class="form-input @error('password') input-error @enderror"
                            placeholder="Enter your password"
                            required
                            autocomplete="current-password"
                        >
                        <button type="button" class="password-toggle" onclick="togglePassword('loginPassword', this)" aria-label="Toggle password visibility">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                            </svg>
                        </button>
                    </div>
                    @error('password')
                        <p class="error-text">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Remember Me --}}
                <div class="checkbox-row">
                    <input type="checkbox" name="remember" id="remember" value="1">
                    <label for="remember">Remember Me</label>
                </div>

                {{-- Submit --}}
                <button type="submit" class="btn-submit" id="btnLoginSubmit">
                    Sign in
                </button>
            </form>

            {{-- Divider --}}
            <div class="divider">
                <div class="divider-line"></div>
                <span class="divider-text">Or continue with</span>
                <div class="divider-line"></div>
            </div>

            {{-- Google Only --}}
            <a href="/auth/google" class="btn-google" id="btnGoogleLogin">
                <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92a5.06 5.06 0 0 1-2.2 3.32v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.1z" fill="#4285F4"/>
                    <path d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z" fill="#34A853"/>
                    <path d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z" fill="#FBBC05"/>
                    <path d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z" fill="#EA4335"/>
                </svg>
                Continue with Google
            </a>
        </div>

        {{-- Footer --}}
        <div class="auth-footer">
            Don't have an account? <a href="/register">Sign up for free</a>
        </div>

    </main>

    {{-- ===== JAVASCRIPT ===== --}}
    <script>
        function togglePassword(inputId, btn) {
            const input = document.getElementById(inputId);
            if (input.type === 'password') {
                input.type = 'text';
                btn.innerHTML = `<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M3.98 8.223A10.477 10.477 0 0 0 1.934 12C3.226 16.338 7.244 19.5 12 19.5c1.716 0 3.338-.407 4.773-1.13M6.228 6.228A10.451 10.451 0 0 1 12 4.5c4.756 0 8.773 3.162 10.065 7.498a10.522 10.522 0 0 1-4.293 5.774M6.228 6.228 3 3m3.228 3.228 3.65 3.65m7.894 7.894L21 21m-3.228-3.228-3.65-3.65m0 0a3 3 0 1 0-4.243-4.243m4.242 4.242L9.88 9.88" /></svg>`;
            } else {
                input.type = 'password';
                btn.innerHTML = `<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" /><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" /></svg>`;
            }
        }
    </script>
</body>
</html>