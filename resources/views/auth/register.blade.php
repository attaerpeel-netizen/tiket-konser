<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Akun Baru - PunkTicket Admin</title>
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
        <div class="text-center mb-6">
            <h1 class="text-2xl font-bold text-slate-800 tracking-tight">Daftar Akun Baru</h1>
            <p class="text-xs text-slate-500 mt-1.5 leading-relaxed">Lengkapi formulir untuk membuat akun admin PunkTicket</p>
        </div>

        @if($errors->any())
            <div class="mb-4 p-3.5 rounded-2xl bg-rose-50 border border-rose-200 text-rose-600 text-xs">
                <ul class="list-disc list-inside space-y-1">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('register') }}" class="space-y-3.5">
            @csrf
            <div>
                <label class="block text-xs font-semibold text-slate-700 mb-1">Nama Lengkap</label>
                <input type="text" name="name" value="{{ old('name') }}" required
                    class="w-full px-4 py-2.5 text-xs rounded-2xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-[#00bcba] bg-slate-50/50"
                    placeholder="Nama lengkap Anda">
            </div>

            <div>
                <label class="block text-xs font-semibold text-slate-700 mb-1">Alamat Email</label>
                <input type="email" name="email" value="{{ old('email') }}" required
                    class="w-full px-4 py-2.5 text-xs rounded-2xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-[#00bcba] bg-slate-50/50"
                    placeholder="nama@email.com">
            </div>

            <div>
                <label class="block text-xs font-semibold text-slate-700 mb-1">Nomor WhatsApp / Telepon</label>
                <input type="text" name="phone" value="{{ old('phone') }}"
                    class="w-full px-4 py-2.5 text-xs rounded-2xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-[#00bcba] bg-slate-50/50"
                    placeholder="08xxxxxxxxxx">
            </div>

            <div>
                <label class="block text-xs font-semibold text-slate-700 mb-1">Kata Sandi</label>
                <input type="password" name="password" required
                    class="w-full px-4 py-2.5 text-xs rounded-2xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-[#00bcba] bg-slate-50/50"
                    placeholder="Minimal 8 karakter">
            </div>

            <div>
                <label class="block text-xs font-semibold text-slate-700 mb-1">Konfirmasi Kata Sandi</label>
                <input type="password" name="password_confirmation" required
                    class="w-full px-4 py-2.5 text-xs rounded-2xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-[#00bcba] bg-slate-50/50"
                    placeholder="Ulangi kata sandi">
            </div>

            <button type="submit"
                class="w-full py-3 bg-[#00bcba] hover:bg-[#009b99] text-white font-bold text-xs rounded-2xl shadow-md shadow-[#00bcba]/20 transition duration-150 mt-1">
                Daftar Sekarang
            </button>
        </form>

        <div class="mt-6 text-center text-xs text-slate-500 pt-4 border-t border-slate-100">
            Sudah memiliki akun? <a href="{{ route('login') }}" class="font-bold text-[#00bcba] hover:underline">Masuk di sini</a>
        </div>
    </div>
</body>
</html>
