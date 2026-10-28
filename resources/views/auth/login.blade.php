<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masuk Admin - PunkTicket</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/lucide@latest"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['"Plus Jakarta Sans"', 'sans-serif'],
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-[#e8f7f8] text-slate-800 min-h-screen flex items-center justify-center p-4 font-sans selection:bg-[#00bcba] selection:text-white">
    <div class="w-full max-w-md bg-white border border-[#d8eef0] rounded-3xl shadow-xl shadow-teal-900/5 p-8 sm:p-9">
        <div class="text-center mb-7">
            <h1 class="text-2xl font-bold text-slate-800 tracking-tight">Masuk PunkTicket Admin</h1>
            <p class="text-xs text-slate-500 mt-1.5 leading-relaxed">Dashboard Pengelolaan Tiket Konser Musik Pop Punk</p>
        </div>

        @if($errors->any())
            <div class="mb-5 p-3.5 rounded-2xl bg-rose-50 border border-rose-200 text-rose-600 text-xs flex items-start space-x-2">
                <i data-lucide="alert-circle" class="w-4 h-4 shrink-0 mt-0.5"></i>
                <span>{{ $errors->first() }}</span>
            </div>
        @endif

        <form action="{{ route('login.post') }}" method="POST" class="space-y-4">
            @csrf
            <div>
                <label for="email" class="block text-xs font-semibold text-slate-700 mb-1.5">Email Administrator</label>
                <input type="email" name="email" id="email" value="{{ old('email') }}" required autofocus
                    class="w-full bg-slate-50/60 border border-slate-200 rounded-2xl px-4 py-2.5 text-xs text-slate-800 placeholder-slate-400 focus:outline-none focus:border-[#00bcba] focus:ring-2 focus:ring-[#00bcba]/20 transition"
                    placeholder="nama@email.com">
            </div>

            <div>
                <label for="password" class="block text-xs font-semibold text-slate-700 mb-1.5">Kata Sandi</label>
                <input type="password" name="password" id="password" required
                    class="w-full bg-slate-50/60 border border-slate-200 rounded-2xl px-4 py-2.5 text-xs text-slate-800 placeholder-slate-400 focus:outline-none focus:border-[#00bcba] focus:ring-2 focus:ring-[#00bcba]/20 transition"
                    placeholder="••••••••">
            </div>

            <div class="flex items-center justify-between text-xs pt-1">
                <label class="flex items-center space-x-2 text-slate-600 cursor-pointer">
                    <input type="checkbox" name="remember" class="rounded border-slate-300 text-[#00bcba] focus:ring-[#00bcba]">
                    <span class="text-[11px]">Ingat Sesi Saya</span>
                </label>
            </div>

            <button type="submit" class="w-full py-3 rounded-2xl bg-[#00bcba] hover:bg-[#009b99] font-bold text-xs text-white shadow-md shadow-[#00bcba]/20 transition duration-150 mt-2">
                Masuk ke Dashboard
            </button>
        </form>

        <div class="mt-6 text-center text-xs text-slate-500 pt-4 border-t border-slate-100">
            Belum memiliki akun? <a href="{{ route('register') }}" class="font-bold text-[#00bcba] hover:underline">Daftar Akun Baru</a>
        </div>

        <div class="mt-6 pt-4 text-center text-[11px] text-slate-400">
            <p>Pengembang: <strong class="text-slate-600">Atta Alfarizi</strong></p>
            <p>Email: attaerpeel@gmail.com</p>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            if (window.lucide) lucide.createIcons();
        });
    </script>
</body>
</html>
