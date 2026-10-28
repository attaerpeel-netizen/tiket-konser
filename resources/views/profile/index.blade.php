@extends('layouts.app')

@section('content')
<div class="p-6 max-w-2xl mx-auto space-y-6">
    <div>
        <h1 class="text-xl font-bold text-slate-800">Profil Administrator</h1>
        <p class="text-xs text-slate-500 mt-0.5">Kelola identitas akun dan keamanan kata sandi Anda</p>
    </div>

    @if(session('success'))
        <div class="p-4 bg-emerald-50 border border-emerald-200 rounded-2xl text-xs text-emerald-600">
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-white p-6 rounded-3xl border border-slate-100 shadow-sm">
        <form method="POST" action="{{ route('profile.update') }}" class="space-y-4">
            @csrf
            @method('PUT')

            <div>
                <label class="block text-xs font-semibold text-slate-700 mb-1">Nama Administrator</label>
                <input type="text" name="name" value="{{ old('name', auth()->user()->name) }}" required
                    class="w-full px-4 py-2.5 text-xs rounded-2xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-[#00bcba]">
            </div>

            <div>
                <label class="block text-xs font-semibold text-slate-700 mb-1">Alamat Email</label>
                <input type="email" name="email" value="{{ old('email', auth()->user()->email) }}" required
                    class="w-full px-4 py-2.5 text-xs rounded-2xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-[#00bcba]">
            </div>

            <div>
                <label class="block text-xs font-semibold text-slate-700 mb-1">Kata Sandi Baru (Kosongkan jika tetap)</label>
                <input type="password" name="password"
                    class="w-full px-4 py-2.5 text-xs rounded-2xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-[#00bcba]"
                    placeholder="Minimal 8 karakter">
            </div>

            <div>
                <label class="block text-xs font-semibold text-slate-700 mb-1">Konfirmasi Kata Sandi Baru</label>
                <input type="password" name="password_confirmation"
                    class="w-full px-4 py-2.5 text-xs rounded-2xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-[#00bcba]"
                    placeholder="Ulangi kata sandi baru">
            </div>

            <div class="pt-4 flex justify-end">
                <button type="submit" class="px-5 py-2.5 bg-[#00bcba] hover:bg-[#00a3a1] text-white text-xs font-semibold rounded-2xl shadow-sm">
                    Simpan Perubahan Profil
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
