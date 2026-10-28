<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard') - PunkTicket Admin</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <!-- Tailwind CSS CDN for quick Blade rendering -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Lucide Icons -->
    <script src="https://unpkg.com/lucide@latest"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        tealBrand: '#00bcba',
                        tealDark: '#009b99',
                        mintBg: '#e8f7f8',
                        warmYellow: '#fbbd23',
                    },
                    fontFamily: {
                        sans: ['"Plus Jakarta Sans"', 'sans-serif'],
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-[#e8f7f8] text-slate-800 min-h-screen flex antialiased selection:bg-[#00bcba] selection:text-white font-sans">

    <!-- Mobile Backdrop -->
    <div id="mobileOverlay" class="fixed inset-0 bg-slate-900/40 backdrop-blur-xs z-30 hidden lg:hidden" onclick="toggleSidebar()"></div>

    <!-- Sidebar Navigation (Matching exact turquoise theme) -->
    <aside id="sidebar" class="fixed lg:static top-0 bottom-0 left-0 w-64 bg-[#00bcba] text-white flex flex-col z-40 transition-transform -translate-x-full lg:translate-x-0 shadow-lg lg:shadow-none">
        <!-- Top User Profile Header (Matching round avatar with yellow badge) -->
        <div class="p-5 border-b border-white/15 flex items-center justify-between">
            <div class="flex items-center space-x-3 min-w-0">
                <div class="relative">
                    <div class="w-11 h-11 rounded-full bg-white shadow-sm flex items-center justify-center text-[#f59e0b] font-bold text-base border-2 border-white">
                        <span>PK</span>
                    </div>
                    <span class="absolute -bottom-0.5 -right-0.5 w-3.5 h-3.5 rounded-full bg-[#fbbd23] border-2 border-[#00bcba]"></span>
                </div>
                <div class="min-w-0">
                    <h1 class="font-bold text-sm text-white tracking-tight leading-tight truncate">
                        PunkTicket
                    </h1>
                    <p class="text-[11px] text-white/80 truncate">
                        {{ auth()->user()->name ?? 'Atta Alfarizi' }}
                    </p>
                </div>
            </div>

            <button onclick="toggleSidebar()" aria-label="Tutup menu navigasi" class="lg:hidden text-white/80 hover:text-white p-1 rounded">
                <i data-lucide="x" class="w-5 h-5"></i>
            </button>
        </div>

        <!-- Navigation Items (Clean rounded tabs matching reference) -->
        <nav class="flex-1 px-3.5 py-6 space-y-1.5 overflow-y-auto">
            <div class="px-3 pb-2 text-[10px] font-bold uppercase tracking-wider text-white/70">
                Menu Navigasi
            </div>

            <a href="{{ route('dashboard') }}" class="w-full flex items-center px-3.5 py-3 rounded-xl text-xs font-semibold transition duration-150 {{ request()->routeIs('dashboard') ? 'bg-white text-[#009b99] shadow-sm font-bold' : 'text-white/90 hover:bg-white/15 hover:text-white' }}">
                <div class="w-7 h-7 rounded-lg flex items-center justify-center mr-3 transition {{ request()->routeIs('dashboard') ? 'bg-[#e6f7f8] text-[#00bcba]' : 'bg-white/10 text-white' }}">
                    <i data-lucide="layout-dashboard" class="w-4 h-4"></i>
                </div>
                <span class="truncate">Dashboard</span>
            </a>

            <a href="{{ route('concerts.index') }}" class="w-full flex items-center px-3.5 py-3 rounded-xl text-xs font-semibold transition duration-150 {{ request()->routeIs('concerts.*') ? 'bg-white text-[#009b99] shadow-sm font-bold' : 'text-white/90 hover:bg-white/15 hover:text-white' }}">
                <div class="w-7 h-7 rounded-lg flex items-center justify-center mr-3 transition {{ request()->routeIs('concerts.*') ? 'bg-[#e6f7f8] text-[#00bcba]' : 'bg-white/10 text-white' }}">
                    <i data-lucide="calendar" class="w-4 h-4"></i>
                </div>
                <span class="truncate">Konser</span>
            </a>

            <a href="{{ route('tickets.index') }}" class="w-full flex items-center px-3.5 py-3 rounded-xl text-xs font-semibold transition duration-150 {{ request()->routeIs('tickets.*') ? 'bg-white text-[#009b99] shadow-sm font-bold' : 'text-white/90 hover:bg-white/15 hover:text-white' }}">
                <div class="w-7 h-7 rounded-lg flex items-center justify-center mr-3 transition {{ request()->routeIs('tickets.*') ? 'bg-[#e6f7f8] text-[#00bcba]' : 'bg-white/10 text-white' }}">
                    <i data-lucide="ticket" class="w-4 h-4"></i>
                </div>
                <span class="truncate">Kategori & Stok</span>
            </a>

            <a href="{{ route('orders.index') }}" class="w-full flex items-center px-3.5 py-3 rounded-xl text-xs font-semibold transition duration-150 {{ request()->routeIs('orders.*') ? 'bg-white text-[#009b99] shadow-sm font-bold' : 'text-white/90 hover:bg-white/15 hover:text-white' }}">
                <div class="w-7 h-7 rounded-lg flex items-center justify-center mr-3 transition {{ request()->routeIs('orders.*') ? 'bg-[#e6f7f8] text-[#00bcba]' : 'bg-white/10 text-white' }}">
                    <i data-lucide="shopping-cart" class="w-4 h-4"></i>
                </div>
                <span class="truncate">Pesanan Tiket</span>
            </a>

            <a href="{{ route('users.index') }}" class="w-full flex items-center px-3.5 py-3 rounded-xl text-xs font-semibold transition duration-150 {{ request()->routeIs('users.*') ? 'bg-white text-[#009b99] shadow-sm font-bold' : 'text-white/90 hover:bg-white/15 hover:text-white' }}">
                <div class="w-7 h-7 rounded-lg flex items-center justify-center mr-3 transition {{ request()->routeIs('users.*') ? 'bg-[#e6f7f8] text-[#00bcba]' : 'bg-white/10 text-white' }}">
                    <i data-lucide="users" class="w-4 h-4"></i>
                </div>
                <span class="truncate">Pengguna</span>
            </a>

            <a href="{{ route('profile.index') }}" class="w-full flex items-center px-3.5 py-3 rounded-xl text-xs font-semibold transition duration-150 {{ request()->routeIs('profile.*') ? 'bg-white text-[#009b99] shadow-sm font-bold' : 'text-white/90 hover:bg-white/15 hover:text-white' }}">
                <div class="w-7 h-7 rounded-lg flex items-center justify-center mr-3 transition {{ request()->routeIs('profile.*') ? 'bg-[#e6f7f8] text-[#00bcba]' : 'bg-white/10 text-white' }}">
                    <i data-lucide="user-check" class="w-4 h-4"></i>
                </div>
                <span class="truncate">Profil Admin</span>
            </a>
        </nav>

        <!-- Bottom User Status & Logout -->
        <div class="p-4 border-t border-white/15 bg-[#00a8a6]">
            <div class="flex items-center justify-between mb-3 text-xs">
                <span class="text-[11px] text-white/80 font-medium">Status Admin</span>
                <span class="px-2 py-0.5 rounded-full text-[10px] font-bold bg-[#fbbd23] text-slate-900 shadow-xs">
                    Online
                </span>
            </div>

            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="w-full py-2.5 px-3 text-xs font-semibold rounded-xl bg-white/15 hover:bg-white hover:text-[#009b99] text-white transition flex items-center justify-center space-x-2">
                    <i data-lucide="log-out" class="w-4 h-4"></i>
                    <span>Keluar (Logout)</span>
                </button>
            </form>
        </div>
    </aside>

    <!-- Main Content Area -->
    <div class="flex-1 flex flex-col min-w-0">
        <!-- Topbar -->
        <header class="h-16 bg-white/80 backdrop-blur-md border-b border-[#d8eef0] px-4 sm:px-8 flex items-center justify-between sticky top-0 z-20 shadow-xs">
            <div class="flex items-center space-x-3">
                <button onclick="toggleSidebar()" aria-label="Buka menu navigasi" class="lg:hidden p-2 rounded-xl bg-white text-slate-700 hover:text-[#00bcba] border border-[#d8eef0] shadow-xs">
                    <i data-lucide="menu" class="w-5 h-5"></i>
                </button>

                <div class="flex items-center space-x-2 text-xs">
                    <span class="hidden sm:inline-block px-2.5 py-1 bg-[#e0f7f7] text-[#009b99] font-bold text-[10px] uppercase rounded-full border border-[#b2ebeb] tracking-wider">
                        Pop Punk Indonesia
                    </span>
                    <span class="hidden sm:inline text-slate-300">/</span>
                    <span class="text-slate-800 font-bold tracking-tight text-sm">
                        @yield('title', 'Ringkasan Dashboard')
                    </span>
                </div>
            </div>

            <div class="flex items-center space-x-3">
                <!-- Search pill -->
                <div class="relative hidden md:flex items-center">
                    <input type="text" placeholder="Search..." class="bg-white border border-[#d8eef0] rounded-full pl-4 pr-11 py-1.5 text-xs text-slate-700 placeholder-slate-400 focus:outline-none focus:border-[#00bcba] shadow-xs w-48 lg:w-64">
                    <div class="absolute right-1 w-7 h-7 rounded-full bg-[#00bcba] text-white flex items-center justify-center shadow-xs cursor-pointer hover:bg-[#00a8a6] transition">
                        <i data-lucide="search" class="w-3.5 h-3.5"></i>
                    </div>
                </div>

                <!-- Admin Avatar pill -->
                <div class="flex items-center space-x-2 bg-white px-3 py-1.5 rounded-full border border-[#d8eef0] text-xs shadow-xs">
                    <div class="w-6 h-6 rounded-full bg-[#fbbd23] text-slate-900 font-bold text-[10px] flex items-center justify-center">
                        {{ strtoupper(substr(auth()->user()->name ?? 'A', 0, 1)) }}
                    </div>
                    <span class="text-slate-500 hidden sm:inline text-[11px]">Admin:</span>
                    <strong class="text-slate-800 font-semibold text-xs">
                        {{ auth()->user()->name ?? 'Atta Alfarizi' }}
                    </strong>
                </div>
            </div>
        </header>

        <!-- Flash Messages & Main View Area -->
        <main class="flex-1 p-4 sm:p-7 overflow-y-auto">
            @if(session('success'))
                <div class="mb-5 p-4 rounded-2xl bg-white border border-emerald-300 text-slate-800 shadow-md flex items-start space-x-3">
                    <i data-lucide="check-circle-2" class="w-5 h-5 text-[#00bcba] shrink-0 mt-0.5"></i>
                    <div class="text-xs">
                        <p class="font-bold text-slate-900">Berhasil</p>
                        <p class="mt-0.5 text-slate-600 leading-relaxed">{{ session('success') }}</p>
                    </div>
                </div>
            @endif

            @if(session('error'))
                <div class="mb-5 p-4 rounded-2xl bg-white border border-rose-300 text-slate-800 shadow-md flex items-start space-x-3">
                    <i data-lucide="alert-circle" class="w-5 h-5 text-rose-500 shrink-0 mt-0.5"></i>
                    <div class="text-xs">
                        <p class="font-bold text-slate-900">Peringatan</p>
                        <p class="mt-0.5 text-slate-600 leading-relaxed">{{ session('error') }}</p>
                    </div>
                </div>
            @endif

            @if($errors->any())
                <div class="mb-5 p-4 rounded-2xl bg-white border border-rose-300 text-slate-800 shadow-md">
                    <p class="text-xs font-bold text-rose-600 mb-2">Harap periksa kesalahan pengisian formulir:</p>
                    <ul class="list-disc list-inside text-xs text-slate-600 space-y-1">
                        @foreach($errors->all() as $err)
                            <li>{{ $err }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @yield('content')
        </main>
    </div>

    <script>
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('mobileOverlay');
            sidebar.classList.toggle('-translate-x-full');
            overlay.classList.toggle('hidden');
        }

        document.addEventListener('DOMContentLoaded', function() {
            if (window.lucide) {
                lucide.createIcons();
            }
        });
    </script>
</body>
</html>
