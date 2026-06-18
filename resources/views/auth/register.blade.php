<!DOCTYPE html>
<html class="light" lang="en">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>MyBlog - Create Your Account</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&amp;display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet" />
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
                }
            },
        }
    </script>
    <style>
        body {
            background-color: #f9f9ff;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
        }

        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
            vertical-align: middle;
        }

        .form-input-focus:focus {
            outline: none;
            border-color: #b61722;
            box-shadow: 0 0 0 1px #b61722;
        }

        .card-shadow {
            box-shadow: 0px 4px 20px rgba(0, 0, 0, 0.04);
            opacity: 0;
            transform: translateY(20px);
        }
    </style>
</head>

<body class="min-h-screen flex flex-col font-interface-body text-on-surface">

    {{-- TopNavBar Module --}}
    <header class="bg-surface sticky top-0 z-50 border-b border-outline-variant">
        <div class="flex justify-between items-center w-full px-gutter max-w-container-max mx-auto h-16">
            <a href="/blog" class="font-display-lg-mobile text-display-lg-mobile font-extrabold text-primary">
                ✍️ MyBlog
            </a>
            <div class="flex items-center gap-stack-md">
                <a class="font-label-caps text-label-caps text-secondary hover:text-primary transition-colors duration-200" href="{{ route('login') }}">Login</a>
            </div>
        </div>
    </header>

    <main class="flex-grow flex items-center justify-center py-section-gap px-gutter">
        <div class="w-full max-w-[440px] bg-surface-container-lowest border border-outline-variant p-stack-lg md:p-12 card-shadow rounded-lg">
            
            <div class="text-center mb-stack-lg">
                <span class="inline-block font-display-lg text-primary mb-stack-sm">✍️</span>
                <h1 class="font-headline-md text-headline-md text-on-surface mb-2">Create Your Account</h1>
                <p class="font-meta-sm text-meta-sm text-secondary">Join our community of thoughtful writers and readers.</p>
            </div>

            <form method="POST" action="{{ route('register') }}" class="space-y-stack-md" id="registerForm">
                @csrf

                <div>
                    <label class="block font-label-caps text-label-caps text-on-surface mb-1 uppercase" for="name">Full Name</label>
                    <input class="w-full h-12 px-4 bg-surface border border-outline-variant rounded-DEFAULT font-interface-body text-interface-body form-input-focus transition-all outline-none" 
                           id="name" 
                           name="name" 
                           value="{{ old('name') }}" 
                           placeholder="Enter your full name" 
                           required 
                           autofocus 
                           type="text" 
                           autocomplete="name" />
                    <x-input-error :messages="$errors->get('name')" class="mt-1 font-meta-sm text-meta-sm text-error" />
                </div>

                <div>
                    <label class="block font-label-caps text-label-caps text-on-surface mb-1 uppercase" for="email">Email Address</label>
                    <input class="w-full h-12 px-4 bg-surface border border-outline-variant rounded-DEFAULT font-interface-body text-interface-body form-input-focus transition-all outline-none" 
                           id="email" 
                           name="email" 
                           value="{{ old('email') }}" 
                           placeholder="you@example.com" 
                           required 
                           type="email" 
                           autocomplete="username" />
                    <x-input-error :messages="$errors->get('email')" class="mt-1 font-meta-sm text-meta-sm text-error" />
                </div>

                <div>
                    <label class="block font-label-caps text-label-caps text-on-surface mb-1 uppercase" for="password">Password</label>
                    <input class="w-full h-12 px-4 bg-surface border border-outline-variant rounded-DEFAULT font-interface-body text-interface-body form-input-focus transition-all outline-none" 
                           id="password" 
                           name="password" 
                           placeholder="••••••••" 
                           required 
                           type="password" 
                           autocomplete="new-password" />
                    <x-input-error :messages="$errors->get('password')" class="mt-1 font-meta-sm text-meta-sm text-error" />
                </div>

                <div>
                    <label class="block font-label-caps text-label-caps text-on-surface mb-1 uppercase" for="password_confirmation">Confirm Password</label>
                    <input class="w-full h-12 px-4 bg-surface border border-outline-variant rounded-DEFAULT font-interface-body text-interface-body form-input-focus transition-all outline-none" 
                           id="password_confirmation" 
                           name="password_confirmation" 
                           placeholder="••••••••" 
                           required 
                           type="password" 
                           autocomplete="new-password" />
                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-1 font-meta-sm text-meta-sm text-error" />
                </div>

                <div class="flex items-start gap-3 py-2">
                    <input class="mt-1 h-4 w-4 rounded-DEFAULT border-outline-variant text-primary focus:ring-primary focus:ring-offset-0" id="terms" name="terms" required type="checkbox" />
                    <label class="font-meta-sm text-meta-sm text-secondary leading-tight select-none cursor-pointer" for="terms">
                        I agree to the <a class="text-primary hover:underline" href="#">Terms of Service</a> and <a class="text-primary hover:underline" href="#">Privacy Policy</a>.
                    </label>
                </div>

                <button id="submitBtn" class="w-full h-12 bg-primary text-on-primary font-label-caps text-label-caps uppercase font-bold rounded-DEFAULT active:scale-[0.98] transition-all shadow-sm hover:opacity-90 mt-4 flex items-center justify-center gap-2" type="submit">
                    Sign Up
                </button>
            </form>

            <div class="mt-stack-lg pt-stack-lg border-t border-outline-variant text-center">
                <p class="font-interface-body text-interface-body text-secondary">
                    Already have an account? 
                    <a class="text-primary font-semibold hover:underline" href="{{ route('login') }}">Login</a>
                </p>
            </div>
        </div>
    </main>

    {{-- Decorative Side Quote for Desktop UI depth Layout --}}
    <div class="hidden lg:block fixed left-12 bottom-12 max-w-xs select-none pointer-events-none opacity-40">
        <div class="font-meta-sm text-meta-sm text-secondary uppercase tracking-widest border-l-2 border-primary pl-4">
            "The art of writing is the art of discovering what you believe."
            <br />
            <span class="font-bold">— Gustave Flaubert</span>
        </div>
    </div>

    {{-- Universal App Core Footer --}}
    <footer class="bg-surface-container-low border-t border-outline-variant mt-auto">
        <div class="w-full py-stack-lg px-gutter flex flex-col md:flex-row justify-between items-center gap-stack-md max-w-container-max mx-auto">
            <div class="font-headline-md text-headline-md text-on-surface">✍️ MyBlog</div>
            <div class="flex gap-stack-lg">
                <a class="font-meta-sm text-meta-sm text-secondary hover:text-primary underline transition-all duration-300" href="#">About</a>
                <a class="font-meta-sm text-meta-sm text-secondary hover:text-primary underline transition-all duration-300" href="#">Terms</a>
                <a class="font-meta-sm text-meta-sm text-secondary hover:text-primary underline transition-all duration-300" href="#">Privacy</a>
            </div>
            <div class="font-meta-sm text-meta-sm text-secondary">
                © {{ date('Y') }} MyBlog. All rights reserved.
            </div>
        </div>
    </footer>

    {{-- Animated Form Orchestration Script --}}
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const form = document.getElementById('registerForm');
            const button = document.getElementById('submitBtn');
            const card = document.querySelector('.card-shadow');

            // Processing load state transform selector
            form.addEventListener('submit', () => {
                if(form.checkValidity()) {
                    button.disabled = true;
                    button.innerHTML = '<span class="material-symbols-outlined animate-spin text-[18px]">progress_activity</span> Creating Account...';
                }
            });

            // Smooth cubic transition layout reveal execution
            card.style.transition = 'all 0.6s cubic-bezier(0.16, 1, 0.3, 1)';
            setTimeout(() => {
                card.style.opacity = '1';
                card.style.transform = 'translateY(0)';
            }, 100);
        });
    </script>
</body>

</html>