@extends('layouts.app')

@section('content')
<div class="p-6 max-w-2xl mx-auto space-y-6">
    <div class="flex justify-between items-center">
        <div>
            <h1 class="text-xl font-bold text-slate-800">Tambah Kategori Tiket</h1>
            <p class="text-xs text-slate-500 mt-0.5">Tentukan kapasitas awal dan harga tiket konser</p>
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
        <form method="POST" action="{{ route('tickets.store') }}" class="space-y-4">
            @csrf
            <div>
                <label class="block text-xs font-semibold text-slate-700 mb-1">Pilih Konser</label>
                <select name="concert_id" required class="w-full px-4 py-2.5 text-xs rounded-2xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-[#00bcba]">
                    <option value="">-- Pilih Konser Pop Punk --</option>
                    @foreach($concerts as $c)
                        <option value="{{ $c->id }}" {{ old('concert_id', request('concert_id')) == $c->id ? 'selected' : '' }}>
                            {{ $c->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block text-xs font-semibold text-slate-700 mb-1">Nama Kategori Tiket</label>
                <input type="text" name="name" value="{{ old('name') }}" required
                    class="w-full px-4 py-2.5 text-xs rounded-2xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-[#00bcba]"
                    placeholder="Contoh: Presale 1, Regular, VIP Soundcheck">
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-semibold text-slate-700 mb-1">Harga Tiket (Rp)</label>
                    <input type="number" name="price" value="{{ old('price') }}" min="0" required
                        class="w-full px-4 py-2.5 text-xs rounded-2xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-[#00bcba]"
                        placeholder="150000">
                </div>

                <div>
                    <label class="block text-xs font-semibold text-slate-700 mb-1">Kapasitas Awal (Lembar)</label>
                    <input type="number" name="initial_capacity" value="{{ old('initial_capacity') }}" min="1" required
                        class="w-full px-4 py-2.5 text-xs rounded-2xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-[#00bcba]"
                        placeholder="500">
                </div>
            </div>

            <div class="pt-4 flex justify-end gap-3">
                <a href="{{ route('tickets.index') }}" class="px-5 py-2.5 bg-slate-100 text-slate-700 text-xs font-semibold rounded-2xl">Batal</a>
                <button type="submit" class="px-5 py-2.5 bg-[#00bcba] hover:bg-[#00a3a1] text-white text-xs font-semibold rounded-2xl shadow-sm">
                    Simpan Kategori
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
