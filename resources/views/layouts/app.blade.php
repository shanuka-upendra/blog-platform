<!DOCTYPE html>
<html class="light" lang="en">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>{{ $title ?? 'MyBlog' }}</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700;800&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
    <script>
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        "on-surface-variant": "#5b403e",
                        "surface-container-high": "#e2e8f8",
                        "background": "#f9f9ff",
                        "secondary": "#575e70",
                        "primary-container": "#da3437",
                        "surface": "#f9f9ff",
                        "surface-container": "#e7eefe",
                        "on-background": "#151c27",
                        "on-secondary": "#ffffff",
                        "secondary-container": "#d9dff5",
                        "inverse-surface": "#2a313d",
                        "surface-container-low": "#f0f3ff",
                        "on-surface": "#151c27",
                        "surface-variant": "#dce2f3",
                        "surface-container-highest": "#dce2f3",
                        "primary": "#b61722",
                        "surface-dim": "#d3daea",
                        "outline-variant": "#e4beba",
                        "surface-container-lowest": "#ffffff",
                        "error-container": "#ffdad6",
                        "tertiary": "#5a5c5e",
                        "tertiary-container": "#737577",
                        "on-error": "#ffffff",
                        "on-primary": "#ffffff",
                        "outline": "#8f6f6d",
                        "inverse-on-surface": "#ebf1ff",
                        "on-primary-fixed": "#410004",
                        "on-tertiary-container": "#fcfcfe",
                        "error": "#ba1a1a",
                        "on-secondary-container": "#5c6274",
                        "on-surface-variant": "#5b403e",
                        "on-primary-fixed-variant": "#930013",
                        "surface-tint": "#b91a24",
                        "on-secondary-fixed-variant": "#404758",
                        "secondary-fixed": "#dce2f7",
                        "on-tertiary-fixed-variant": "#444749",
                        "on-tertiary": "#ffffff",
                        "tertiary-fixed": "#e1e2e4",
                        "on-tertiary-fixed": "#191c1e",
                        "surface-bright": "#f9f9ff",
                        "primary-fixed": "#ffdad7",
                        "secondary-fixed-dim": "#c0c6db",
                        "on-secondary-fixed": "#141b2b",
                        "primary-fixed-dim": "#ffb3ad",
                        "inverse-primary": "#ffb3ad",
                        "tertiary-fixed-dim": "#c5c6c8",
                        "on-primary-container": "#fffbff",
                        "on-error-container": "#93000a",
                    },
                    borderRadius: {
                        "DEFAULT": "0.125rem",
                        "lg": "0.25rem",
                        "xl": "0.5rem",
                        "full": "0.75rem"
                    },
                    spacing: {
                        "article-max": "720px",
                        "stack-md": "1rem",
                        "stack-lg": "2rem",
                        "container-max": "1200px",
                        "stack-sm": "0.5rem",
                        "section-gap": "4rem",
                        "gutter": "1.5rem"
                    },
                    fontFamily: {
                        "article-body": ["Inter"],
                        "display-lg": ["Inter"],
                        "meta-sm": ["Inter"],
                        "interface-body": ["Inter"],
                        "headline-md": ["Inter"],
                        "display-lg-mobile": ["Inter"],
                        "label-caps": ["Inter"]
                    },
                    fontSize: {
                        "article-body": ["20px", {"lineHeight":"32px","fontWeight":"400"}],
                        "display-lg": ["48px", {"lineHeight":"56px","letterSpacing":"-0.02em","fontWeight":"800"}],
                        "meta-sm": ["14px", {"lineHeight":"20px","fontWeight":"400"}],
                        "interface-body": ["16px", {"lineHeight":"24px","fontWeight":"400"}],
                        "headline-md": ["30px", {"lineHeight":"38px","letterSpacing":"-0.01em","fontWeight":"700"}],
                        "display-lg-mobile": ["36px", {"lineHeight":"42px","letterSpacing":"-0.02em","fontWeight":"800"}],
                        "label-caps": ["12px", {"lineHeight":"16px","letterSpacing":"0.05em","fontWeight":"600"}]
                    }
                }
            }
        }
    </script>
    <style>
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        }
        .material-symbols-outlined.filled {
            font-variation-settings: 'FILL' 1, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        }
        .blurred-text {
            color: transparent;
            text-shadow: 0 0 10px rgba(21,28,39,0.5);
            user-select: none;
        }
        .premium-overlay {
            background: linear-gradient(to bottom, rgba(249,249,255,0) 0%, rgba(249,249,255,0.9) 30%, rgba(249,249,255,1) 100%);
        }
        .ambient-shadow { box-shadow: 0px 4px 20px rgba(0,0,0,0.04); }
    </style>
</head>
<body class="bg-background text-on-background font-interface-body min-h-screen flex flex-col antialiased">

{{-- NAVBAR --}}
<header class="bg-surface top-0 sticky border-b border-outline-variant z-50">
    <div class="flex justify-between items-center w-full px-gutter max-w-container-max mx-auto h-16">

        <a href="/blog" class="font-display-lg-mobile text-display-lg-mobile font-extrabold text-primary">
            ✍️ MyBlog
        </a>

        <nav class="hidden md:flex items-center gap-6 h-full">
            @auth
                <a href="/posts/create"
                   class="h-full flex items-center font-label-caps text-label-caps text-secondary hover:text-primary transition-colors">
                    New Post
                </a>
                <a href="/my-posts"
                   class="h-full flex items-center font-label-caps text-label-caps text-secondary hover:text-primary transition-colors">
                    My Posts
                </a>
            @endauth
        </nav>

        <div class="flex items-center gap-4">
            @auth
                <form method="POST" action="/logout" class="inline">
                    @csrf
                    <button class="bg-primary text-on-primary font-label-caps text-label-caps px-4 py-2 rounded-DEFAULT hover:opacity-90 transition-all">
                        Logout
                    </button>
                </form>
            @else
                <a href="/login"
                   class="hidden md:block font-label-caps text-label-caps text-secondary hover:text-primary transition-colors">
                    Login
                </a>
                <a href="/register"
                   class="bg-primary text-on-primary font-label-caps text-label-caps px-4 py-2 rounded-DEFAULT hover:opacity-90 transition-all">
                    Register
                </a>
            @endauth
        </div>

    </div>
</header>

{{-- FLASH MESSAGE --}}
@if(session('success'))
    <div class="bg-[#f0fdf4] border-b border-[#bbf7d0] text-[#166534] px-gutter py-3 text-center font-meta-sm text-meta-sm">
        ✅ {{ session('success') }}
    </div>
@endif

{{-- PAGE CONTENT --}}
<main class="flex-grow w-full">
    {{ $slot }}
</main>

{{-- FOOTER --}}
<footer class="bg-surface-container-low border-t border-outline-variant mt-auto">
    <div class="w-full py-stack-lg px-gutter flex flex-col md:flex-row justify-between items-center gap-stack-md max-w-container-max mx-auto">
        <div class="flex flex-col items-center md:items-start gap-2">
            <span class="font-headline-md text-headline-md text-on-surface">✍️ MyBlog</span>
            <span class="font-meta-sm text-meta-sm text-secondary">© {{ date('Y') }} MyBlog. All rights reserved.</span>
        </div>
        <nav class="flex gap-6">
            <a href="#" class="font-meta-sm text-meta-sm text-secondary hover:text-primary underline transition-all">About</a>
            <a href="#" class="font-meta-sm text-meta-sm text-secondary hover:text-primary underline transition-all">Terms</a>
            <a href="#" class="font-meta-sm text-meta-sm text-secondary hover:text-primary underline transition-all">Privacy</a>
        </nav>
    </div>
</footer>

</body>
</html>