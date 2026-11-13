@extends('layouts.app')

@section('content')
<div class="p-6 max-w-7xl mx-auto space-y-6">
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
        <div>
            <h1 class="text-xl font-bold text-slate-800">Pengelolaan Pengguna & Pelanggan</h1>
            <p class="text-xs text-slate-500 mt-0.5">Kelola akun admin penyelenggara dan data pelanggan terdaftar</p>
        </div>
        <a href="{{ route('users.create') }}" class="px-4 py-2 bg-[#00bcba] text-white text-xs font-semibold rounded-2xl hover:bg-[#00a3a1] shadow-sm">
            + Tambah Pengguna
        </a>
    </div>

    <!-- Table -->
    <div class="bg-white rounded-3xl border border-slate-100 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs">
                <thead class="bg-slate-50 text-slate-500 border-b border-slate-100">
                    <tr>
                        <th class="p-4">ID</th>
                        <th class="p-4">Nama Lengkap</th>
                        <th class="p-4">Email</th>
                        <th class="p-4">No. Telepon</th>
                        <th class="p-4">Peran (Role)</th>
                        <th class="p-4">Status</th>
                        <th class="p-4">Tgl Registrasi</th>
                        <th class="p-4 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($users as $u)
                    <tr class="hover:bg-slate-50/60">
                        <td class="p-4 font-mono text-slate-400">#{{ $u->id }}</td>
                        <td class="p-4 font-semibold text-slate-800">{{ $u->name }}</td>
                        <td class="p-4 text-slate-600">{{ $u->email }}</td>
                        <td class="p-4 text-slate-600">{{ $u->phone ?? '-' }}</td>
                        <td class="p-4">
                            <span class="px-2.5 py-1 rounded-full text-[10px] font-semibold {{ $u->role === 'admin' ? 'bg-amber-50 text-amber-600 border border-amber-200' : 'bg-slate-100 text-slate-600' }}">
                                {{ ucfirst($u->role) }}
                            </span>
                        </td>
                        <td class="p-4">
                            <span class="px-2.5 py-1 rounded-full text-[10px] font-semibold {{ $u->status === 'Aktif' ? 'bg-emerald-50 text-emerald-600' : 'bg-rose-50 text-rose-600' }}">
                                {{ $u->status }}
                            </span>
                        </td>
                        <td class="p-4 text-slate-500">{{ \Carbon\Carbon::parse($u->created_at)->format('d M Y') }}</td>
                        <td class="p-4 text-center">
                            <div class="flex items-center justify-center gap-2">
                                <a href="{{ route('users.edit', $u->id) }}" class="px-2.5 py-1 text-teal-600 bg-teal-50 hover:bg-teal-100 rounded-xl">Edit</a>
                                @if($u->role !== 'admin' || auth()->id() !== $u->id)
                                <form action="{{ route('users.destroy', $u->id) }}" method="POST" onsubmit="return confirm('Hapus pengguna ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="px-2.5 py-1 text-rose-600 bg-rose-50 hover:bg-rose-100 rounded-xl">Hapus</button>
                                </form>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" class="p-8 text-center text-slate-400">Belum ada pengguna terdaftar.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
