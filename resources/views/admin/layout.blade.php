<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Admin — {{ $title ?? 'Dashboard' }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700;800&display=swap" rel="stylesheet" />
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }

        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        }

        .filled {
            font-variation-settings: 'FILL' 1, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        }
    </style>
</head>

<body class="bg-gray-100 min-h-screen flex">

    {{-- Sidebar --}}
    <aside class="w-64 bg-gray-900 min-h-screen flex flex-col fixed left-0 top-0">
        <div class="px-6 py-5 border-b border-gray-700">
            <a href="/blog" class="text-white font-extrabold text-xl">✍️ MyBlog</a>
            <p class="text-gray-400 text-xs mt-1">Admin Panel</p>
        </div>

        <nav class="flex-1 px-4 py-6 space-y-1">
            <a href="/admin"
                class="flex items-center gap-3 px-4 py-2.5 rounded-lg text-sm font-medium transition-colors
                      {{ request()->is('admin') ? 'bg-red-600 text-white' : 'text-gray-300 hover:bg-gray-800 hover:text-white' }}">
                <span class="material-symbols-outlined text-base">dashboard</span>
                Dashboard
            </a>
            <a href="/admin/users"
                class="flex items-center gap-3 px-4 py-2.5 rounded-lg text-sm font-medium transition-colors
                      {{ request()->is('admin/users') ? 'bg-red-600 text-white' : 'text-gray-300 hover:bg-gray-800 hover:text-white' }}">
                <span class="material-symbols-outlined text-base">group</span>
                Users
            </a>
            <a href="/admin/posts"
                class="flex items-center gap-3 px-4 py-2.5 rounded-lg text-sm font-medium transition-colors
                      {{ request()->is('admin/posts') ? 'bg-red-600 text-white' : 'text-gray-300 hover:bg-gray-800 hover:text-white' }}">
                <span class="material-symbols-outlined text-base">article</span>
                Posts
            </a>
        </nav>

        <div class="px-4 py-4 border-t border-gray-700">
            <div class="flex items-center gap-3 mb-3">
                <div class="w-8 h-8 rounded-full bg-red-600 flex items-center justify-center">
                    <span class="material-symbols-outlined text-white text-sm">person</span>
                </div>
                <div>
                    <p class="text-white text-xs font-semibold">{{ Auth::user()->name }}</p>
                    <p class="text-gray-400 text-xs">Administrator</p>
                </div>
            </div>
            <a href="/blog" class="flex items-center gap-2 text-gray-400 hover:text-white text-xs transition-colors">
                <span class="material-symbols-outlined text-sm">arrow_back</span>
                Back to Blog
            </a>
        </div>
    </aside>

    {{-- Main content --}}
    <div class="ml-64 flex-1 flex flex-col min-h-screen">

        {{-- Top bar --}}
        <header class="bg-white border-b border-gray-200 px-8 py-4 flex justify-between items-center sticky top-0 z-10">
            <h1 class="text-lg font-bold text-gray-900">{{ $title ?? 'Dashboard' }}</h1>
            <div class="flex items-center gap-3">
                @if(session('success'))
                <span class="text-green-600 text-sm font-medium">✅ {{ session('success') }}</span>
                @endif
                <form method="POST" action="/logout">
                    @csrf
                    <button class="text-sm text-gray-500 hover:text-gray-800 transition-colors">Logout</button>
                </form>
            </div>
        </header>

        {{-- Page content --}}
        <main class="flex-1 px-8 py-8">
            {{ $slot }}
        </main>

    </div>

</body>

</html>