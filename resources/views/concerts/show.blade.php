@extends('layouts.app')

@section('content')
<div class="p-6 max-w-5xl mx-auto space-y-6">
    <div class="flex justify-between items-center">
        <div>
            <h1 class="text-xl font-bold text-slate-800">{{ $concert->name }}</h1>
            <p class="text-xs text-slate-500 mt-0.5">Detail informasi konser dan kategori tiket aktif</p>
        </div>
        <div class="flex gap-2">
            <a href="{{ route('concerts.edit', $concert->id) }}" class="px-4 py-2 bg-teal-50 text-[#00bcba] text-xs font-semibold rounded-2xl hover:bg-teal-100">
                Edit Konser
            </a>
            <a href="{{ route('concerts.index') }}" class="px-4 py-2 bg-slate-100 hover:bg-slate-200 text-slate-700 text-xs font-semibold rounded-2xl">
                Kembali
            </a>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="bg-white p-4 rounded-3xl border border-slate-100 shadow-sm text-center">
            <!-- Perbaikan path poster menggunakan asset('storage/...') -->
            @if($concert->poster_url)
                <img src="{{ asset('storage/' . $concert->poster_url) }}" class="w-full h-64 object-cover rounded-2xl" alt="{{ $concert->name }}">
            @else
                <div class="w-full h-64 bg-slate-100 flex items-center justify-center text-xs text-slate-400 rounded-2xl">
                    Tidak Ada Poster
                </div>
            @endif
            <div class="mt-4">
                <span class="px-3 py-1 rounded-full text-xs font-semibold bg-teal-50 text-[#00bcba] border border-teal-200">
                    {{ $concert->status }}
                </span>
            </div>
        </div>

        <div class="md:col-span-2 bg-white p-6 rounded-3xl border border-slate-100 shadow-sm space-y-4 text-xs">
            <div>
                <span class="text-slate-400 font-semibold uppercase tracking-wider text-[10px]">Lineup Artis</span>
                <p class="text-slate-800 font-semibold text-sm mt-0.5">{{ is_array($concert->lineup) ? implode(', ', $concert->lineup) : $concert->lineup }}</p>
            </div>
            <div>
                <span class="text-slate-400 font-semibold uppercase tracking-wider text-[10px]">Tanggal & Waktu</span>
                <p class="text-slate-800 mt-0.5">{{ \Carbon\Carbon::parse($concert->date_time)->translatedFormat('l, d F Y - H:i') }} WIB</p>
            </div>
            <div>
                <span class="text-slate-400 font-semibold uppercase tracking-wider text-[10px]">Lokasi</span>
                <p class="text-slate-800 mt-0.5">{{ $concert->location }}</p>
            </div>
            <div>
                <span class="text-slate-400 font-semibold uppercase tracking-wider text-[10px]">Deskripsi</span>
                <p class="text-slate-600 mt-0.5 whitespace-pre-line leading-relaxed">{{ $concert->description }}</p>
            </div>
        </div>
    </div>

    <!-- Ticket Categories for this concert -->
    <div class="bg-white p-6 rounded-3xl border border-slate-100 shadow-sm space-y-4">
        <div class="flex justify-between items-center">
            <h2 class="text-sm font-bold text-slate-800">Kategori Tiket Konser Ini</h2>
            <a href="{{ route('tickets.create') }}?concert_id={{ $concert->id }}" class="px-3 py-1.5 bg-[#00bcba] text-white text-xs font-semibold rounded-xl">
                + Tambah Kategori
            </a>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs">
                <thead class="bg-slate-50 text-slate-500">
                    <tr>
                        <th class="p-3">Kategori</th>
                        <th class="p-3">Harga</th>
                        <th class="p-3">Kapasitas</th>
                        <th class="p-3">Terjual</th>
                        <th class="p-3">Sisa Stok</th>
                        <th class="p-3">Persentase</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($concert->ticketCategories ?? [] as $tc)
                    <tr>
                        <td class="p-3 font-semibold text-slate-800">{{ $tc->name }}</td>
                        <td class="p-3">Rp {{ number_format($tc->price, 0, ',', '.') }}</td>
                        <td class="p-3">{{ $tc->initial_capacity }}</td>
                        <td class="p-3 text-teal-600 font-semibold">{{ $tc->sold_count }}</td>
                        <td class="p-3 text-emerald-600 font-semibold">{{ $tc->initial_capacity - $tc->sold_count }}</td>
                        <td class="p-3">
                            @php $pct = $tc->initial_capacity > 0 ? round(($tc->sold_count / $tc->initial_capacity) * 100) : 0; @endphp
                            <div class="flex items-center gap-2">
                                <div class="w-20 bg-slate-100 h-2 rounded-full overflow-hidden">
                                    <div class="bg-[#00bcba] h-full" style="width: {{ $pct }}%"></div>
                                </div>
                                <span>{{ $pct }}%</span>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="p-4 text-center text-slate-400">Belum ada kategori tiket untuk konser ini.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
