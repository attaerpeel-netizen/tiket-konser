@extends('layouts.app')

@section('content')
<div class="p-6 max-w-7xl mx-auto space-y-6">
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
        <div>
            <h1 class="text-xl font-bold text-slate-800">Kategori & Stok Tiket</h1>
            <p class="text-xs text-slate-500 mt-0.5">Kelola kuota, harga, dan persentase penjualan tiket per konser</p>
        </div>
        <a href="{{ route('tickets.create') }}" class="px-4 py-2 bg-[#00bcba] text-white text-xs font-semibold rounded-2xl hover:bg-[#00a3a1] shadow-sm">
            + Tambah Kategori Tiket
        </a>
    </div>

    <!-- Table -->
    <div class="bg-white rounded-3xl border border-slate-100 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs">
                <thead class="bg-slate-50 text-slate-500 border-b border-slate-100">
                    <tr>
                        <th class="p-4">Konser</th>
                        <th class="p-4">Kategori</th>
                        <th class="p-4">Harga Tiket</th>
                        <th class="p-4">Kapasitas Awal</th>
                        <th class="p-4">Tiket Terjual</th>
                        <th class="p-4">Sisa Stok</th>
                        <th class="p-4">Persentase Terjual</th>
                        <th class="p-4 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($tickets as $t)
                    @php 
                        $remaining = max(0, $t->initial_capacity - $t->sold_count);
                        $pct = $t->initial_capacity > 0 ? round(($t->sold_count / $t->initial_capacity) * 100) : 0;
                    @endphp
                    <tr class="hover:bg-slate-50/60">
                        <td class="p-4 font-semibold text-slate-800">{{ $t->concert->name ?? '-' }}</td>
                        <td class="p-4 font-medium text-slate-700">{{ $t->name }}</td>
                        <td class="p-4 font-mono font-medium text-slate-800">Rp {{ number_format($t->price, 0, ',', '.') }}</td>
                        <td class="p-4 text-slate-600">{{ number_format($t->initial_capacity) }}</td>
                        <td class="p-4 text-[#00bcba] font-semibold">{{ number_format($t->sold_count) }}</td>
                        <td class="p-4 font-semibold {{ $remaining < 10 ? 'text-rose-500' : 'text-emerald-600' }}">
                            {{ number_format($remaining) }}
                        </td>
                        <td class="p-4">
                            <div class="flex items-center gap-2">
                                <div class="w-24 bg-slate-100 h-2 rounded-full overflow-hidden">
                                    <div class="bg-[#00bcba] h-full" style="width: {{ $pct }}%"></div>
                                </div>
                                <span class="font-medium text-slate-600">{{ $pct }}%</span>
                            </div>
                        </td>
                        <td class="p-4 text-center">
                            <div class="flex items-center justify-center gap-2">
                                <a href="{{ route('tickets.edit', $t->id) }}" class="px-2.5 py-1 text-teal-600 bg-teal-50 hover:bg-teal-100 rounded-xl">Edit</a>
                                <form action="{{ route('tickets.destroy', $t->id) }}" method="POST" onsubmit="return confirm('Hapus kategori tiket ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="px-2.5 py-1 text-rose-600 bg-rose-50 hover:bg-rose-100 rounded-xl">Hapus</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" class="p-8 text-center text-slate-400">Belum ada kategori tiket terdaftar.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
