<!DOCTYPE html>
<html class="light" lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Login - MyBlog</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com" rel="preconnect">
    <link crossorigin="" href="https://fonts.gstatic.com" rel="preconnect">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700;800&amp;display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet">
    <script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    "colors": {
                        "surface-container-high": "#e2e8f8",
                        "on-tertiary": "#ffffff",
                        "on-primary-container": "#fffbff",
                        "on-tertiary-fixed-variant": "#444749",
                        "on-primary-fixed": "#410004",
                        "inverse-surface": "#2a313d",
                        "inverse-primary": "#ffb3ad",
                        "surface-container": "#e7eefe",
                        "primary-fixed-dim": "#ffb3ad",
                        "surface-container-highest": "#dce2f3",
                        "on-secondary-fixed-variant": "#404758",
                        "on-primary-fixed-variant": "#930013",
                        "on-error": "#ffffff",
                        "surface": "#f9f9ff",
                        "secondary-container": "#d9dff5",
                        "on-secondary": "#ffffff",
                        "background": "#f9f9ff",
                        "secondary-fixed": "#dce2f7",
                        "on-surface": "#151c27",
                        "inverse-on-surface": "#ebf1ff",
                        "tertiary": "#5a5c5e",
                        "surface-dim": "#d3daea",
                        "on-tertiary-container": "#fcfcfe",
                        "surface-tint": "#b91a24",
                        "on-primary": "#ffffff",
                        "surface-container-lowest": "#ffffff",
                        "secondary": "#575e70",
                        "tertiary-fixed-dim": "#c5c6c8",
                        "on-tertiary-fixed": "#191c1e",
                        "outline-variant": "#e4beba",
                        "on-secondary-container": "#5c6274",
                        "surface-variant": "#dce2f3",
                        "secondary-fixed-dim": "#c0c6db",
                        "error-container": "#ffdad6",
                        "on-background": "#151c27",
                        "primary-fixed": "#ffdad7",
                        "on-surface-variant": "#5b403e",
                        "outline": "#8f6f6d",
                        "tertiary-fixed": "#e1e2e4",
                        "surface-container-low": "#f0f3ff",
                        "on-secondary-fixed": "#141b2b",
                        "primary": "#b61722",
                        "surface-bright": "#f9f9ff",
                        "on-error-container": "#93000a",
                        "error": "#ba1a1a",
                        "tertiary-container": "#737577",
                        "primary-container": "#da3437"
                    },
                    "borderRadius": {
                        "DEFAULT": "0.125rem",
                        "lg": "0.25rem",
                        "xl": "0.5rem",
                        "full": "0.75rem"
                    },
                    "spacing": {
                        "stack-sm": "0.5rem",
                        "article-max": "720px",
                        "gutter": "1.5rem",
                        "stack-md": "1rem",
                        "section-gap": "4rem",
                        "container-max": "1200px",
                        "stack-lg": "2rem"
                    },
                    "fontFamily": {
                        "display-lg": ["Inter"],
                        "headline-md": ["Inter"],
                        "interface-body": ["Inter"],
                        "article-body": ["Inter"],
                        "meta-sm": ["Inter"],
                        "label-caps": ["Inter"],
                        "display-lg-mobile": ["Inter"]
                    },
                    "fontSize": {
                        "display-lg": ["48px", { "lineHeight": "56px", "letterSpacing": "-0.02em", "fontWeight": "800" }],
                        "headline-md": ["30px", { "lineHeight": "38px", "letterSpacing": "-0.01em", "fontWeight": "700" }],
                        "interface-body": ["16px", { "lineHeight": "24px", "letterSpacing": "0em", "fontWeight": "400" }],
                        "article-body": ["20px", { "lineHeight": "32px", "letterSpacing": "0em", "fontWeight": "400" }],
                        "meta-sm": ["14px", { "lineHeight": "20px", "fontWeight": "400" }],
                        "label-caps": ["12px", { "lineHeight": "16px", "letterSpacing": "0.05em", "fontWeight": "600" }],
                        "display-lg-mobile": ["36px", { "lineHeight": "42px", "letterSpacing": "-0.02em", "fontWeight": "800" }]
                    }
                },
            },
        }
    </script>
    <style>
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: #f9f9ff;
        }

        .login-card {
            box-shadow: 0px 4px 20px rgba(0, 0, 0, 0.04);
            border: 1px solid #e5e7eb;
        }

        /* Custom micro-interactions */
        .btn-primary:active {
            transform: scale(0.98);
            opacity: 0.9;
        }
    </style>
</head>

<body class="bg-surface text-on-surface min-h-screen flex flex-col justify-center items-center px-gutter">
    <main class="w-full max-w-[420px] mx-auto py-section-gap">
        <div class="text-center mb-stack-lg">
            <h1 class="font-display-lg-mobile text-display-lg-mobile md:font-display-lg md:text-display-lg text-primary tracking-tight">
                ✍️ MyBlog
            </h1>
        </div>
        
        <div class="login-card bg-surface-container-lowest p-stack-lg md:p-10 rounded-lg">
            <header class="mb-stack-lg">
                <h2 class="font-headline-md text-headline-md text-on-surface mb-2">Welcome Back</h2>
                <p class="font-interface-body text-interface-body text-secondary">Please enter your details to sign in.</p>
            </header>

            <x-auth-session-status class="mb-4 font-meta-sm text-meta-sm p-3.5 bg-[#f0fdf4] text-[#166534] rounded-lg border border-[#bbf7d0]" :status="session('status')" />

            <form action="{{ route('login') }}" class="space-y-stack-md" method="POST" id="laravelLoginForm">
                @csrf

                <div class="flex flex-col gap-1">
                    <label class="font-label-caps text-label-caps text-on-surface-variant transition-colors duration-200" for="email">Email Address</label>
                    <div class="relative">
                        <input class="w-full h-12 px-4 bg-transparent border border-outline rounded-lg font-interface-body text-interface-body focus:ring-1 focus:ring-primary focus:border-primary transition-all placeholder:text-outline-variant outline-none" 
                               id="email" 
                               name="email" 
                               value="{{ old('email') }}" 
                               placeholder="yourname@domain.com" 
                               required 
                               autofocus 
                               type="email" 
                               autocomplete="username">
                    </div>
                    <x-input-error :messages="$errors->get('email')" class="mt-1 font-meta-sm text-meta-sm text-error" />
                </div>

                <div class="flex flex-col gap-1">
                    <div class="flex justify-between items-center">
                        <label class="font-label-caps text-label-caps text-on-surface-variant transition-colors duration-200" for="password">Password</label>
                        @if (Route::has('password.request'))
                            <a class="font-meta-sm text-meta-sm text-primary hover:underline transition-all" href="{{ route('password.request') }}">Forgot Password?</a>
                        @endif
                    </div>
                    <div class="relative">
                        <input class="w-full h-12 px-4 bg-transparent border border-outline rounded-lg font-interface-body text-interface-body focus:ring-1 focus:ring-primary focus:border-primary transition-all placeholder:text-outline-variant outline-none" 
                               id="password" 
                               name="password" 
                               placeholder="••••••••" 
                               required 
                               type="password" 
                               autocomplete="current-password">
                    </div>
                    <x-input-error :messages="$errors->get('password')" class="mt-1 font-meta-sm text-meta-sm text-error" />
                </div>

                <div class="block mt-2">
                    <label for="remember_me" class="inline-flex items-center cursor-pointer group">
                        <input id="remember_me" type="checkbox" class="rounded border-outline-variant text-primary shadow-sm focus:ring-primary focus:ring-offset-0 focus:ring-1 w-4 h-4 transition-colors cursor-pointer" name="remember">
                        <span class="ms-2 font-meta-sm text-meta-sm text-secondary group-hover:text-on-surface transition-colors select-none">{{ __('Remember me') }}</span>
                    </label>
                </div>

                <button id="submitBtn" class="btn-primary w-full h-14 mt-stack-md bg-primary text-on-primary font-label-caps text-label-caps rounded-lg hover:opacity-90 transition-all duration-300 flex justify-center items-center gap-2" type="submit">
                    Login
                    <span class="material-symbols-outlined text-[20px]">login</span>
                </button>
            </form>

            <div class="mt-stack-lg border-t border-outline-variant pt-stack-lg">
                <p class="font-meta-sm text-meta-sm text-secondary text-center mb-stack-md">Or continue with</p>
                <div class="grid grid-cols-2 gap-stack-md">
                    <button class="flex items-center justify-center gap-2 h-14 border border-outline-variant rounded-lg hover:bg-surface-container-low transition-colors text-on-surface-variant">
                        <span class="material-symbols-outlined text-[20px]">google</span>
                        <span class="font-label-caps text-label-caps">Google</span>
                    </button>
                    <button class="flex items-center justify-center gap-2 h-14 border border-outline-variant rounded-lg hover:bg-surface-container-low transition-colors text-on-surface-variant">
                        <span class="material-symbols-outlined text-[20px]">brand_awareness</span>
                        <span class="font-label-caps text-label-caps">GitHub</span>
                    </button>
                </div>
            </div>
        </div>

        <div class="mt-stack-lg text-center">
            <p class="font-interface-body text-interface-body text-secondary">
                Don't have an account?
                <a class="text-primary font-semibold hover:underline" href="{{ route('register') }}">Register</a>
            </p>
        </div>
    </main>

    <div class="fixed inset-0 -z-10 overflow-hidden pointer-events-none">
        <div class="absolute top-[-10%] left-[-10%] w-[40%] h-[40%] bg-primary/5 blur-[120px] rounded-full"></div>
        <div class="absolute bottom-[-10%] right-[-10%] w-[30%] h-[30%] bg-secondary-container/10 blur-[100px] rounded-full"></div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const form = document.getElementById('laravelLoginForm');
            const button = document.getElementById('submitBtn');

            form.addEventListener('submit', () => {
                button.disabled = true;
                button.innerHTML = '<span class="material-symbols-outlined animate-spin text-[20px]">progress_activity</span> Authenticating...';
            });

            // Focus interaction styling toggles for input fields
            const inputs = document.querySelectorAll('input[type="email"], input[type="password"]');
            inputs.forEach(input => {
                input.addEventListener('focus', () => {
                    const label = input.closest('.flex-col').querySelector('label');
                    if (label) label.classList.add('text-primary');
                });
                input.addEventListener('blur', () => {
                    const label = input.closest('.flex-col').querySelector('label');
                    if (label) label.classList.remove('text-primary');
                });
            });
        });
    </script>
</body>

</html>