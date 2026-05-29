<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Investdu - Log In</title>
    <meta name="description" content="Login ke akun Investdu dan lanjutkan petualangan investasimu!">

    {{-- Google Fonts: Press Start 2P (pixel) + Space Mono --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Press+Start+2P&family=Space+Mono:wght@400;700&display=swap" rel="stylesheet">

    {{-- Vite compiled assets (Tailwind CSS + JS) --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        /* ===== BASE ===== */
        *, *::before, *::after { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: 'Space Mono', monospace;
            min-height: 100vh;
            background-color: #0a1628;
            background-image: url('/assets/images/pixel-stars-bg.png');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            image-rendering: pixelated;
            display: flex;
            flex-direction: column;
            align-items: center;
            overflow-x: hidden;
        }

        .font-pixel { font-family: 'Press Start 2P', monospace; }
        .font-mono  { font-family: 'Space Mono', monospace; }

        /* ===== NAVBAR ===== */
        .navbar {
            position: fixed;
            top: 0; left: 0; right: 0;
            z-index: 100;
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: rgba(10, 22, 40, 0.92);
            backdrop-filter: blur(12px);
            padding: 0 2rem;
            height: 58px;
            border-bottom: 2px solid rgba(255, 255, 255, 0.06);
        }

        .navbar-logo {
            font-family: 'Press Start 2P', monospace;
            font-size: 1rem;
            color: #FFD000;
            text-decoration: none;
            letter-spacing: 2px;
            text-shadow: 2px 2px 0px #b38f00;
            transition: all 0.2s;
        }

        .navbar-logo:hover {
            text-shadow: 2px 2px 0px #b38f00, 0 0 20px rgba(255, 208, 0, 0.4);
        }

        .navbar-logo .logo-icon {
            display: inline-block;
            margin-right: 6px;
            animation: bounce-coin 2s ease-in-out infinite;
        }

        @keyframes bounce-coin {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-3px); }
        }

        .nav-links {
            display: flex;
            gap: 0.5rem;
            align-items: center;
            list-style: none;
        }

        .nav-links a {
            font-family: 'Space Mono', monospace;
            font-size: 0.8rem;
            font-weight: 700;
            color: #8b949e;
            text-decoration: none;
            padding: 0.5rem 0.8rem;
            border-radius: 6px;
            transition: all 0.2s;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .nav-links a:hover { color: #ffffff; background-color: rgba(255,255,255,0.06); }

        .btn-signup-nav {
            font-family: 'Space Mono', monospace;
            font-size: 0.75rem; font-weight: 700;
            color: #0a1628;
            background-color: #FFD000;
            border: 3px solid #0a1628;
            padding: 0.4rem 1rem;
            border-radius: 6px;
            text-decoration: none;
            text-transform: uppercase;
            letter-spacing: 1px;
            cursor: pointer;
            transition: all 0.15s;
            box-shadow: 0 3px 0 #b38f00;
        }

        .btn-signup-nav:hover { transform: translateY(1px); box-shadow: 0 2px 0 #b38f00; }
        .btn-signup-nav:active { transform: translateY(3px); box-shadow: 0 0px 0 #b38f00; }

        /* ===== TWINKLING STARS (CSS) ===== */
        .stars-container {
            position: fixed;
            inset: 0;
            z-index: 0;
            pointer-events: none;
            overflow: hidden;
        }

        .star {
            position: absolute;
            background-color: #ffffff;
            border-radius: 0;
            animation: twinkle-star ease-in-out infinite alternate;
        }

        .star--cyan { background-color: #4dd9f7; }
        .star--gold { background-color: #FFD000; }

        .star:nth-child(1)  { width: 2px; height: 2px; top: 8%;  left: 15%; animation-duration: 2.5s; }
        .star:nth-child(2)  { width: 3px; height: 3px; top: 12%; left: 45%; animation-duration: 3.2s; animation-delay: 0.5s; }
        .star:nth-child(3)  { width: 2px; height: 2px; top: 20%; left: 75%; animation-duration: 2.8s; animation-delay: 1s; }
        .star:nth-child(4)  { width: 4px; height: 4px; top: 5%;  left: 88%; animation-duration: 4s; animation-delay: 0.3s; }
        .star:nth-child(5)  { width: 2px; height: 2px; top: 35%; left: 5%;  animation-duration: 3s; animation-delay: 1.5s; }
        .star:nth-child(6)  { width: 3px; height: 3px; top: 45%; left: 92%; animation-duration: 2.6s; animation-delay: 0.8s; }
        .star:nth-child(7)  { width: 2px; height: 2px; top: 55%; left: 30%; animation-duration: 3.5s; animation-delay: 2s; }
        .star:nth-child(8)  { width: 3px; height: 3px; top: 65%; left: 60%; animation-duration: 2.2s; }
        .star:nth-child(9)  { width: 2px; height: 2px; top: 78%; left: 12%; animation-duration: 3.8s; animation-delay: 0.7s; }
        .star:nth-child(10) { width: 4px; height: 4px; top: 82%; left: 50%; animation-duration: 3.1s; animation-delay: 1.2s; }
        .star:nth-child(11) { width: 2px; height: 2px; top: 15%; left: 55%; animation-duration: 2.4s; animation-delay: 1.8s; }
        .star:nth-child(12) { width: 3px; height: 3px; top: 90%; left: 80%; animation-duration: 3.6s; animation-delay: 0.4s; }

        /* Cross-shaped bright stars */
        .star-cross {
            position: absolute;
            z-index: 1;
            animation: twinkle-star ease-in-out infinite alternate;
        }

        .star-cross::before,
        .star-cross::after {
            content: '';
            position: absolute;
            background-color: #4dd9f7;
        }

        .star-cross::before { width: 2px; height: 10px; top: -4px; left: 0; }
        .star-cross::after  { width: 10px; height: 2px; top: 0; left: -4px; }

        .star-cross:nth-child(13) { top: 10%; left: 25%; animation-duration: 4s; }
        .star-cross:nth-child(14) { top: 30%; left: 85%; animation-duration: 3.5s; animation-delay: 1s; }
        .star-cross:nth-child(15) { top: 70%; left: 40%; animation-duration: 4.2s; animation-delay: 2s; }

        @keyframes twinkle-star {
            0%   { opacity: 0.2; transform: scale(0.8); }
            100% { opacity: 1; transform: scale(1.2); }
        }

        /* ===== PAGE CONTENT WRAPPER ===== */
        .auth-page {
            position: relative;
            z-index: 10;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            padding: 80px 1rem 2rem;
            width: 100%;
            max-width: 480px;
        }

        /* ===== MASCOT + SPEECH BUBBLE ===== */
        .mascot-section {
            display: flex;
            align-items: flex-end;
            gap: 0.5rem;
            margin-bottom: 1rem;
            opacity: 0;
            animation: fadeSlideDown 0.6s ease-out 0.2s forwards;
        }

        .mascot-img {
            width: 80px;
            height: 80px;
            image-rendering: pixelated;
            filter: drop-shadow(2px 3px 4px rgba(0,0,0,0.5));
            animation: mascot-bounce 3s ease-in-out infinite;
        }

        @keyframes mascot-bounce {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-5px); }
        }

        .speech-bubble {
            position: relative;
            background-color: #ffffff;
            color: #1a1a2e;
            font-family: 'Press Start 2P', monospace;
            font-size: 0.6rem;
            line-height: 1.8;
            padding: 12px 16px;
            border: 3px solid #1a1a2e;
            border-radius: 4px;
            max-width: 280px;
            box-shadow: 4px 4px 0px #1a1a2e;
        }

        /* Speech bubble tail */
        .speech-bubble::before {
            content: '';
            position: absolute;
            left: -12px;
            bottom: 14px;
            width: 0; height: 0;
            border-top: 8px solid transparent;
            border-bottom: 8px solid transparent;
            border-right: 12px solid #1a1a2e;
        }

        .speech-bubble::after {
            content: '';
            position: absolute;
            left: -7px;
            bottom: 16px;
            width: 0; height: 0;
            border-top: 6px solid transparent;
            border-bottom: 6px solid transparent;
            border-right: 10px solid #ffffff;
        }

        /* ===== FORM CONTAINER ===== */
        .form-card {
            width: 100%;
            background-color: #ffffff;
            border: 4px solid #1a1a2e;
            border-radius: 6px;
            padding: 2rem 1.75rem;
            box-shadow: 6px 6px 0px #1a1a2e;
            opacity: 0;
            animation: fadeScaleIn 0.6s ease-out 0.4s forwards;
        }

        /* ===== SOCIAL LOGIN BUTTONS ===== */
        .social-buttons {
            display: flex;
            gap: 0.75rem;
            margin-bottom: 1.25rem;
        }

        .btn-social {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            font-family: 'Space Mono', monospace;
            font-size: 0.85rem;
            font-weight: 700;
            color: #1a1a2e;
            background-color: #ffffff;
            border: 3px solid #1a1a2e;
            border-radius: 4px;
            padding: 0.7rem 1rem;
            cursor: pointer;
            text-decoration: none;
            transition: all 0.1s ease;
            box-shadow: 0 4px 0 #1a1a2e;
        }

        .btn-social:hover {
            transform: translateY(2px);
            box-shadow: 0 2px 0 #1a1a2e;
        }

        .btn-social:active {
            transform: translateY(4px);
            box-shadow: 0 0px 0 #1a1a2e;
        }

        .btn-social svg {
            width: 20px;
            height: 20px;
            flex-shrink: 0;
        }

        /* ===== DIVIDER ===== */
        .divider {
            display: flex;
            align-items: center;
            gap: 1rem;
            margin-bottom: 1.25rem;
        }

        .divider-line {
            flex: 1;
            height: 2px;
            background-color: #e0e0e0;
        }

        .divider-text {
            font-family: 'Space Mono', monospace;
            font-size: 0.7rem;
            font-weight: 700;
            color: #999;
            text-transform: uppercase;
            letter-spacing: 2px;
        }

        /* ===== FORM INPUTS ===== */
        .form-group {
            margin-bottom: 1rem;
        }

        .form-label {
            display: block;
            font-family: 'Press Start 2P', monospace;
            font-size: 0.55rem;
            color: #555;
            margin-bottom: 0.4rem;
            letter-spacing: 1px;
        }

        .form-input {
            width: 100%;
            font-family: 'Space Mono', monospace;
            font-size: 0.9rem;
            color: #1a1a2e;
            background-color: #ffffff;
            border: 3px solid #d0d0d0;
            border-radius: 4px;
            padding: 0.7rem 0.9rem;
            outline: none;
            transition: border-color 0.2s, box-shadow 0.2s;
        }

        .form-input::placeholder {
            color: #aaa;
            font-size: 0.85rem;
        }

        .form-input:focus {
            border-color: #1a1a2e;
            box-shadow: 0 0 0 2px rgba(26, 26, 46, 0.1);
        }

        .form-input.input-error {
            border-color: #e53e3e;
            box-shadow: 0 0 0 2px rgba(229, 62, 62, 0.15);
        }

        /* Validation error text */
        .error-text {
            font-family: 'Press Start 2P', monospace;
            font-size: 0.45rem;
            color: #e53e3e;
            margin-top: 0.35rem;
            line-height: 1.6;
            display: flex;
            align-items: center;
            gap: 4px;
        }

        .error-text::before {
            content: '⚠';
            font-size: 0.5rem;
        }

        /* Password visibility toggle */
        .password-wrapper {
            position: relative;
        }

        .password-toggle {
            position: absolute;
            right: 12px;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            cursor: pointer;
            color: #999;
            font-size: 1.1rem;
            padding: 2px;
            transition: color 0.2s;
        }

        .password-toggle:hover { color: #1a1a2e; }

        /* Checkbox custom */
        .checkbox-wrapper {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            margin-top: 0.25rem;
            margin-bottom: 0.25rem;
        }

        .checkbox-wrapper input[type="checkbox"] {
            width: 16px;
            height: 16px;
            accent-color: #2196F3;
            cursor: pointer;
        }

        .checkbox-wrapper label {
            font-family: 'Space Mono', monospace;
            font-size: 0.75rem;
            color: #666;
            cursor: pointer;
            user-select: none;
        }

        /* ===== SUBMIT BUTTON ===== */
        .btn-submit {
            width: 100%;
            font-family: 'Press Start 2P', monospace;
            font-size: 0.7rem;
            color: #ffffff;
            background-color: #2196F3;
            border: 3px solid #1a1a2e;
            border-radius: 4px;
            padding: 0.9rem 1rem;
            cursor: pointer;
            text-transform: uppercase;
            letter-spacing: 2px;
            transition: all 0.1s ease;
            box-shadow: 0 4px 0 #1565C0;
            margin-top: 0.5rem;
        }

        .btn-submit:hover {
            background-color: #42A5F5;
            transform: translateY(2px);
            box-shadow: 0 2px 0 #1565C0;
        }

        .btn-submit:active {
            transform: translateY(4px);
            box-shadow: 0 0px 0 #1565C0;
        }

        /* ===== BOTTOM LINK ===== */
        .auth-footer {
            text-align: center;
            margin-top: 1.5rem;
            font-family: 'Space Mono', monospace;
            font-size: 0.8rem;
            color: #8b949e;
            opacity: 0;
            animation: fadeSlideUp 0.6s ease-out 0.6s forwards;
        }

        .auth-footer a {
            color: #FFD000;
            text-decoration: none;
            font-weight: 700;
            transition: color 0.2s;
        }

        .auth-footer a:hover {
            color: #ffe04a;
            text-decoration: underline;
        }

        /* ===== FLASH SUCCESS MESSAGE ===== */
        .flash-success {
            width: 100%;
            background-color: rgba(52, 211, 153, 0.15);
            border: 2px solid #34D399;
            border-radius: 4px;
            padding: 0.7rem 1rem;
            margin-bottom: 1rem;
            font-family: 'Press Start 2P', monospace;
            font-size: 0.5rem;
            color: #34D399;
            text-align: center;
            line-height: 1.8;
            opacity: 0;
            animation: fadeSlideDown 0.5s ease-out 0.1s forwards;
        }

        /* ===== ANIMATIONS ===== */
        @keyframes fadeSlideDown {
            0% { opacity: 0; transform: translateY(-15px); }
            100% { opacity: 1; transform: translateY(0); }
        }

        @keyframes fadeScaleIn {
            0% { opacity: 0; transform: scale(0.95); }
            100% { opacity: 1; transform: scale(1); }
        }

        @keyframes fadeSlideUp {
            0% { opacity: 0; transform: translateY(15px); }
            100% { opacity: 1; transform: translateY(0); }
        }

        /* ===== RESPONSIVE ===== */
        @media (max-width: 520px) {
            .auth-page { padding: 70px 0.75rem 1.5rem; max-width: 100%; }
            .form-card { padding: 1.5rem 1.25rem; border-width: 3px; box-shadow: 4px 4px 0px #1a1a2e; }
            .speech-bubble { font-size: 0.5rem; padding: 10px 12px; }
            .mascot-img { width: 60px; height: 60px; }
            .social-buttons { flex-direction: column; }
            .btn-submit { font-size: 0.6rem; }
            .navbar { padding: 0 1rem; }
            .navbar-logo { font-size: 0.85rem; }
            .nav-links { display: none; }
        }

        /* ===== SCROLLBAR ===== */
        ::-webkit-scrollbar { width: 6px; }
        ::-webkit-scrollbar-track { background: #0a1628; }
        ::-webkit-scrollbar-thumb { background: #1e2530; border-radius: 3px; }
        ::-webkit-scrollbar-thumb:hover { background: #2d3540; }
    </style>
</head>
<body>

    {{-- ===== NAVBAR ===== --}}
    <nav class="navbar">
        <a href="/" class="navbar-logo">
            <span class="logo-icon">💰</span>INVESTDU
        </a>
        <ul class="nav-links">
            <li><a href="/">Home</a></li>
            <li><a href="/game">Game</a></li>
        </ul>
        <div>
            <a href="/login" class="btn-signup-nav" style="background-color: transparent; color: #FFD000; border-color: #FFD000; box-shadow: none; margin-right: 8px;">Log in</a>
            <a href="/register" class="btn-signup-nav">Sign up</a>
        </div>
    </nav>

    {{-- ===== TWINKLING STARS ===== --}}
    <div class="stars-container">
        <div class="star"></div>
        <div class="star star--cyan"></div>
        <div class="star"></div>
        <div class="star star--gold"></div>
        <div class="star"></div>
        <div class="star star--cyan"></div>
        <div class="star"></div>
        <div class="star"></div>
        <div class="star star--gold"></div>
        <div class="star star--cyan"></div>
        <div class="star"></div>
        <div class="star"></div>
        {{-- Cross-shaped stars --}}
        <div class="star-cross"></div>
        <div class="star-cross"></div>
        <div class="star-cross"></div>
    </div>

    {{-- ===== MAIN CONTENT ===== --}}
    <main class="auth-page">

        {{-- Flash success message (e.g. after registration) --}}
        @if(session('success'))
            <div class="flash-success">✅ {{ session('success') }}</div>
        @endif

        {{-- Speech Bubble --}}
        <div class="mascot-section">
            <div class="speech-bubble" style="margin-left: 0;">
                Welcome back, adventurer! Ready to continue? :)
            </div>
        </div>

        {{-- Form Card --}}
        <div class="form-card">

            {{-- Social Login --}}
            <div class="social-buttons">
                <a href="/auth/google" class="btn-social" id="btnGoogleLogin">
                    {{-- Google SVG Icon --}}
                    <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92a5.06 5.06 0 0 1-2.2 3.32v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.1z" fill="#4285F4"/>
                        <path d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z" fill="#34A853"/>
                        <path d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z" fill="#FBBC05"/>
                        <path d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z" fill="#EA4335"/>
                    </svg>
                    Google
                </a>
            </div>

            {{-- Divider --}}
            <div class="divider">
                <div class="divider-line"></div>
                <span class="divider-text">or</span>
                <div class="divider-line"></div>
            </div>

            {{-- Login Form --}}
            <form action="{{ route('login') }}" method="POST" id="loginForm">
                @csrf

                {{-- Email or Username --}}
                <div class="form-group">
                    <label for="login" class="form-label">Email or Username</label>
                    <input
                        type="text"
                        name="login"
                        id="login"
                        class="form-input @error('login') input-error @enderror"
                        placeholder="Enter email or username"
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
                    <label for="password" class="form-label">Password</label>
                    <div class="password-wrapper">
                        <input
                            type="password"
                            name="password"
                            id="loginPassword"
                            class="form-input @error('password') input-error @enderror"
                            placeholder="Enter your password"
                            required
                            autocomplete="current-password"
                            style="padding-right: 2.5rem;"
                        >
                        <button type="button" class="password-toggle" onclick="togglePassword('loginPassword', this)" aria-label="Toggle password visibility">
                            👁
                        </button>
                    </div>
                    @error('password')
                        <p class="error-text">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Remember me --}}
                <div class="checkbox-wrapper">
                    <input type="checkbox" name="remember" id="remember" value="1">
                    <label for="remember">Remember me</label>
                </div>

                {{-- Submit Button --}}
                <button type="submit" class="btn-submit" id="btnLoginSubmit">
                    Log in
                </button>
            </form>
        </div>

        {{-- Footer Link --}}
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
                btn.textContent = '🙈';
            } else {
                input.type = 'password';
                btn.textContent = '👁';
            }
        }
    </script>
</body>
</html>