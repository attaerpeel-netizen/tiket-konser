@extends('layouts.app')

@section('content')
<div class="p-6 max-w-2xl mx-auto space-y-6">
    <div class="flex justify-between items-center">
        <div>
            <h1 class="text-xl font-bold text-slate-800">Edit Pengguna: {{ $user->name }}</h1>
            <p class="text-xs text-slate-500 mt-0.5">Perbarui profil dan status akses pengguna</p>
        </div>
        <a href="{{ route('users.index') }}" class="px-4 py-2 bg-slate-100 hover:bg-slate-200 text-slate-700 text-xs font-semibold rounded-2xl">
            Kembali
        </a>
    </div>  

    @if($errors->any())
        <div class="p-4 bg-rose-50 border border-rose-200 rounded-2xl text-xs text-rose-600">
            <ul class="list-disc list-inside">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="bg-white p-6 rounded-3xl border border-slate-100 shadow-sm">
        <form method="POST" action="{{ route('users.update', $user->id) }}" class="space-y-4">
            @csrf
            @method('PUT')

            <div>
                <label class="block text-xs font-semibold text-slate-700 mb-1">Nama Lengkap</label>
                <input type="text" name="name" value="{{ old('name', $user->name) }}" required
                    class="w-full px-4 py-2.5 text-xs rounded-2xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-[#00bcba]">
            </div>

            <div>
                <label class="block text-xs font-semibold text-slate-700 mb-1">Alamat Email</label>
                <input type="email" name="email" value="{{ old('email', $user->email) }}" required
                    class="w-full px-4 py-2.5 text-xs rounded-2xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-[#00bcba]">
            </div>

            <div>
                <label class="block text-xs font-semibold text-slate-700 mb-1">Nomor Telepon / WhatsApp</label>
                <input type="text" name="phone" value="{{ old('phone', $user->phone) }}"
                    class="w-full px-4 py-2.5 text-xs rounded-2xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-[#00bcba]">
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-semibold text-slate-700 mb-1">Peran (Role)</label>
                    <select name="role" required class="w-full px-4 py-2.5 text-xs rounded-2xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-[#00bcba]">
                        <option value="customer" {{ $user->role === 'customer' ? 'selected' : '' }}>Customer (Pelanggan)</option>
                        <option value="admin" {{ $user->role === 'admin' ? 'selected' : '' }}>Administrator</option>
                    </select>
                </div>

                <div>
                    <label class="block text-xs font-semibold text-slate-700 mb-1">Status Akun</label>
                    <select name="status" required class="w-full px-4 py-2.5 text-xs rounded-2xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-[#00bcba]">
                        <option value="Aktif" {{ $user->status === 'Aktif' ? 'selected' : '' }}>Aktif</option>
                        <option value="Nonaktif" {{ $user->status === 'Nonaktif' ? 'selected' : '' }}>Nonaktif</option>
                    </select>
                </div>
            </div>

            <div>
                <label class="block text-xs font-semibold text-slate-700 mb-1">Kata Sandi Baru (Kosongkan jika tidak diganti)</label>
                <input type="password" name="password"
                    class="w-full px-4 py-2.5 text-xs rounded-2xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-[#00bcba]"
                    placeholder="Kosongkan jika tidak diubah">
            </div>

            <div class="pt-4 flex justify-end gap-3">
                <a href="{{ route('users.index') }}" class="px-5 py-2.5 bg-slate-100 text-slate-700 text-xs font-semibold rounded-2xl">Batal</a>
                <button type="submit" class="px-5 py-2.5 bg-[#00bcba] hover:bg-[#00a3a1] text-white text-xs font-semibold rounded-2xl shadow-sm">
                    Perbarui Pengguna
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
