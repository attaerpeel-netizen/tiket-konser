@extends('layouts.app')

@section('content')
<div class="p-6 max-w-7xl mx-auto space-y-6">
    <div class="flex justify-between items-center">
        <div>
            <h1 class="text-2xl font-bold text-slate-800">Daftar Konser Punk Rock</h1>
            <p class="text-xs text-slate-500 mt-0.5">Kelola jadwal konser, lineup band, dan poster acara</p>
        </div>
        <a href="{{ route('concerts.create') }}" class="px-4 py-2.5 bg-[#00bcba] hover:bg-[#00a3a1] text-white text-xs font-semibold rounded-2xl shadow-sm">
            + Tambah Konser Baru
        </a>
    </div>

    <!-- Filter & Search -->
    <form method="GET" action="{{ route('concerts.index') }}" class="flex flex-col sm:flex-row gap-3">
        <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama konser atau lokasi..." 
            class="flex-1 px-4 py-2.5 text-xs rounded-2xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-[#00bcba]">
        <select name="status" class="px-4 py-2.5 text-xs rounded-2xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-[#00bcba]">
            <option value="all">Semua Status</option>
            <option value="Akan Datang" {{ request('status') == 'Akan Datang' ? 'selected' : '' }}>Akan Datang</option>
            <option value="Berlangsung" {{ request('status') == 'Berlangsung' ? 'selected' : '' }}>Berlangsung</option>
            <option value="Selesai" {{ request('status') == 'Selesai' ? 'selected' : '' }}>Selesai</option>
        </select>
        <button type="submit" class="px-5 py-2.5 bg-slate-800 hover:bg-slate-900 text-white text-xs font-semibold rounded-2xl">
            Filter
        </button>
    </form>

    <!-- Grid Daftar Konser -->
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
        @forelse($concerts as $concert)
            <div class="bg-white rounded-3xl border border-slate-100 shadow-sm overflow-hidden flex flex-col justify-between">
                <div>
                    <!-- Poster Konser (Menggunakan poster_url) -->
                    <div class="h-48 w-full bg-slate-100 relative">
                        @if($concert->poster_url)
                            <img src="{{ asset('storage/' . $concert->poster_url) }}" alt="{{ $concert->name }}" class="w-full h-full object-cover">
                        @else
                            <div class="w-full h-full flex items-center justify-center text-xs text-slate-400">
                                Tidak Ada Poster
                            </div>
                        @endif
                        <span class="absolute top-3 right-3 px-3 py-1 bg-white/90 backdrop-blur-md text-[10px] font-semibold text-slate-700 rounded-full shadow-sm">
                            {{ $concert->status }}
                        </span>
                    </div>

                    <div class="p-5 space-y-2">
                        <h2 class="text-sm font-bold text-slate-800 line-clamp-1">{{ $concert->name }}</h2>
                        <p class="text-xs text-slate-500 line-clamp-1">📍 {{ $concert->location }}</p>
                        <p class="text-[11px] text-slate-600 font-medium">🎸 {{ implode(', ', $concert->lineup ?? []) }}</p>
                    </div>
                </div>

                <div class="p-5 pt-0 flex items-center justify-between gap-2">
                    <a href="{{ route('concerts.show', $concert->id) }}" class="flex-1 px-3 py-2 bg-slate-100 hover:bg-slate-200 text-slate-700 text-center text-xs font-semibold rounded-xl">
                        Detail
                    </a>
                    <a href="{{ route('concerts.edit', $concert->id) }}" class="px-3 py-2 bg-teal-50 hover:bg-teal-100 text-[#00bcba] text-xs font-semibold rounded-xl">
                        Edit
                    </a>
                </div>
            </div>
        @empty
            <div class="col-span-full py-12 text-center text-slate-400 text-xs">
                Belum ada data konser yang tersedia.
            </div>
        @endforelse
    </div>

    <!-- Pagination -->
    <div class="mt-4">
        {{ $concerts->links() }}
    </div>
</div>
@endsection