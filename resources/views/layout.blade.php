<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Persuratan</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 antialiased">

<div class="flex min-h-screen">

    {{-- ===== SIDEBAR ===== --}}
    <aside class="w-56 bg-white border-r border-gray-100 fixed top-0 left-0 h-full flex flex-col z-10">

        {{-- Logo --}}
        <div class="flex items-center gap-3 px-5 py-5 border-b border-gray-100">
            <div class="w-8 h-8 rounded-lg bg-blue-50 flex items-center justify-center shrink-0">
                <img src="{{ asset('images/logo.webp') }}" alt="Logo" class="w-5 h-5 object-contain">
            </div>
            <div>
                <p class="text-sm font-medium text-gray-900 leading-tight">Sistem</p>
                <p class="text-xs text-gray-400">Persuratan</p>
            </div>
        </div>

        {{-- Navigasi --}}
        <nav class="flex-1 px-3 py-4">
            <p class="text-[10px] uppercase tracking-widest text-gray-400 px-2 mb-2">Menu</p>

            <ul class="space-y-0.5">
                <li>
                    <a href="/"
                       class="flex items-center gap-2.5 px-3 py-2 rounded-lg text-sm transition-colors
                              {{ request()->is('/') ? 'bg-blue-50 text-blue-600 font-medium' : 'text-gray-500 hover:bg-gray-50 hover:text-gray-900' }}">

                        {{-- Icon Dashboard --}}
                        <svg class="w-4 h-4 shrink-0" fill="none" viewBox="0 0 16 16">
                            <rect x="1.5" y="1.5" width="5.5" height="5.5" rx="1.5"
                                  fill="currentColor" opacity="{{ request()->is('/') ? '1' : '0.5' }}"/>
                            <rect x="9" y="1.5" width="5.5" height="5.5" rx="1.5"
                                  fill="currentColor" opacity="0.4"/>
                            <rect x="1.5" y="9" width="5.5" height="5.5" rx="1.5"
                                  fill="currentColor" opacity="0.4"/>
                            <rect x="9" y="9" width="5.5" height="5.5" rx="1.5"
                                  fill="currentColor" opacity="0.4"/>
                        </svg>

                        Dashboard
                    </a>
                </li>
                <li>
                    <a href="/surat-masuk"
                       class="flex items-center gap-2.5 px-3 py-2 rounded-lg text-sm transition-colors
                              {{ request()->is('surat-masuk*') ? 'bg-blue-50 text-blue-600 font-medium' : 'text-gray-500 hover:bg-gray-50 hover:text-gray-900' }}">

                        {{-- Icon Masuk --}}
                        <svg class="w-4 h-4 shrink-0" fill="none" viewBox="0 0 16 16" stroke="currentColor" stroke-width="1.4">
                            <rect x="2" y="2" width="12" height="12" rx="2"/>
                            <path d="M5 6h6M5 8.5h6M5 11h3.5" stroke-linecap="round"/>
                            <path d="M11 1.5v3.5" stroke-linecap="round"/>
                            <circle cx="11" cy="1.5" r="0.5" fill="currentColor"/>
                        </svg>

                        Surat Masuk
                    </a>
                </li>
                <li>
                    <a href="/surat-keluar"
                       class="flex items-center gap-2.5 px-3 py-2 rounded-lg text-sm transition-colors
                              {{ request()->is('surat-keluar*') ? 'bg-blue-50 text-blue-600 font-medium' : 'text-gray-500 hover:bg-gray-50 hover:text-gray-900' }}">

                        {{-- Icon Keluar --}}
                        <svg class="w-4 h-4 shrink-0" fill="none" viewBox="0 0 16 16" stroke="currentColor" stroke-width="1.4">
                            <rect x="2" y="2" width="12" height="12" rx="2"/>
                            <path d="M5 6h6M5 8.5h6M5 11h3.5" stroke-linecap="round"/>
                            <path d="M14 4.5l-3-3" stroke-linecap="round"/>
                        </svg>

                        Surat Keluar
                    </a>
                </li>
            </ul>
        </nav>

        {{-- Footer sidebar --}}
        <div class="px-5 py-4 border-t border-gray-100">
            <p class="text-xs text-gray-300">v1.0.0</p>
        </div>

    </aside>

    {{-- ===== MAIN ===== --}}
    <div class="flex-1 ml-56 flex flex-col min-h-screen">

        {{-- Top bar --}}
        <header class="h-13 bg-white border-b border-gray-100 sticky top-0 z-10
                        flex items-center justify-between px-6 py-3.5">
            <span class="text-sm text-gray-400">
                {{ request()->is('/') ? 'Dashboard' : (request()->is('surat-masuk*') ? 'Surat Masuk' : 'Surat Keluar') }}
            </span>
            <div class="flex items-center gap-2">
                <div class="w-7 h-7 rounded-full bg-blue-50 flex items-center justify-center
                             text-xs font-medium text-blue-600">
                    A
                </div>
                <span class="text-sm text-gray-700">Admin</span>
            </div>
        </header>

        {{-- Page content --}}
        <main class="flex-1 p-6 bg-gray-50">
            @yield('content')
        </main>

    </div>

</div>

</body>
</html>