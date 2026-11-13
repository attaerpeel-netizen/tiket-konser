@extends('layouts.app')

@section('content')
<div class="p-6 max-w-2xl mx-auto space-y-6">
    <div class="flex justify-between items-center">
        <div>
            <h1 class="text-xl font-bold text-slate-800">Edit Kategori Tiket</h1>
            <p class="text-xs text-slate-500 mt-0.5">{{ $ticketCategory->concert->name ?? '' }} - {{ $ticketCategory->name }}</p>
        </div>
        <a href="{{ route('tickets.index') }}" class="px-4 py-2 bg-slate-100 hover:bg-slate-200 text-slate-700 text-xs font-semibold rounded-2xl">
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
    <form method="POST" action="{{ url('/tickets/' . $ticketCategory->id) }}" class="space-y-4">
            @csrf
            @method('PUT')

            <div>
                <label class="block text-xs font-semibold text-slate-700 mb-1">Nama Kategori Tiket</label>
                <input type="text" name="name" value="{{ old('name', $ticketCategory->name) }}" required
                    class="w-full px-4 py-2.5 text-xs rounded-2xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-[#00bcba]">
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-semibold text-slate-700 mb-1">Harga Tiket (Rp)</label>
                    <input type="number" name="price" value="{{ old('price', $ticketCategory->price) }}" min="0" required
                        class="w-full px-4 py-2.5 text-xs rounded-2xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-[#00bcba]">
                </div>

                <div>
                    <label class="block text-xs font-semibold text-slate-700 mb-1">Kapasitas Awal (Minimal: {{ $ticketCategory->sold_count }})</label>
                    <input type="number" name="initial_capacity" value="{{ old('initial_capacity', $ticketCategory->initial_capacity) }}" min="{{ $ticketCategory->sold_count }}" required
                        class="w-full px-4 py-2.5 text-xs rounded-2xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-[#00bcba]">
                    <p class="text-[10px] text-amber-600 mt-1">*Kapasitas tidak boleh lebih kecil dari {{ $ticketCategory->sold_count }} tiket yang sudah terjual.</p>
                </div>
            </div>

            <div class="pt-4 flex justify-end gap-3">
                <a href="{{ route('tickets.index') }}" class="px-5 py-2.5 bg-slate-100 text-slate-700 text-xs font-semibold rounded-2xl">Batal</a>
                <button type="submit" class="px-5 py-2.5 bg-[#00bcba] hover:bg-[#00a3a1] text-white text-xs font-semibold rounded-2xl shadow-sm">
                    Perbarui Kategori
                </button>
            </div>
        </form>
    </div>
</div>
@endsection