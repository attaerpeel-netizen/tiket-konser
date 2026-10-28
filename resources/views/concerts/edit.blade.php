@extends('layouts.app')

@section('content')
<div class="p-6 max-w-4xl mx-auto space-y-6">
    <div class="flex justify-between items-center">
        <div>
            <h1 class="text-xl font-bold text-slate-800">Edit Konser: {{ $concert->name }}</h1>
            <p class="text-xs text-slate-500 mt-0.5">Perbarui informasi jadwal, lineup, dan detail konser</p>
        </div>
        <a href="{{ route('concerts.index') }}" class="px-4 py-2 bg-slate-100 hover:bg-slate-200 text-slate-700 text-xs font-semibold rounded-2xl">
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
        <form method="POST" action="{{ route('concerts.update', $concert->id) }}" enctype="multipart/form-data" class="space-y-4">
            @csrf
            @method('PUT')

            <div>
                <label class="block text-xs font-semibold text-slate-700 mb-1">Nama Konser</label>
                <input type="text" name="name" value="{{ old('name', $concert->name) }}" required
                    class="w-full px-4 py-2.5 text-xs rounded-2xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-[#00bcba]">
            </div>

            <div>
                <label class="block text-xs font-semibold text-slate-700 mb-1">Lineup Artis / Band</label>
                <input type="text" name="lineup" value="{{ old('lineup', is_array($concert->lineup) ? implode(', ', $concert->lineup) : $concert->lineup) }}" required
                    class="w-full px-4 py-2.5 text-xs rounded-2xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-[#00bcba]">
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-semibold text-slate-700 mb-1">Tanggal & Waktu</label>
                    <input type="datetime-local" name="date_time" value="{{ old('date_time', \Carbon\Carbon::parse($concert->date_time)->format('Y-m-d\TH:i')) }}" required
                        class="w-full px-4 py-2.5 text-xs rounded-2xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-[#00bcba]">
                </div>

                <div>
                    <label class="block text-xs font-semibold text-slate-700 mb-1">Status Konser</label>
                    <select name="status" required class="w-full px-4 py-2.5 text-xs rounded-2xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-[#00bcba]">
                        <option value="Draft" {{ $concert->status === 'Draft' ? 'selected' : '' }}>Draft</option>
                        <option value="Akan Datang" {{ $concert->status === 'Akan Datang' ? 'selected' : '' }}>Akan Datang</option>
                        <option value="Berlangsung" {{ $concert->status === 'Berlangsung' ? 'selected' : '' }}>Berlangsung</option>
                        <option value="Selesai" {{ $concert->status === 'Selesai' ? 'selected' : '' }}>Selesai</option>
                    </select>
                </div>
            </div>

            <div>
                <label class="block text-xs font-semibold text-slate-700 mb-1">Lokasi Venue & Kota</label>
                <input type="text" name="location" value="{{ old('location', $concert->location) }}" required
                    class="w-full px-4 py-2.5 text-xs rounded-2xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-[#00bcba]">
            </div>

            <div>
                <label class="block text-xs font-semibold text-slate-700 mb-1">Deskripsi Konser</label>
                <textarea name="description" rows="4" required
                    class="w-full px-4 py-2.5 text-xs rounded-2xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-[#00bcba]">{{ old('description', $concert->description) }}</textarea>
            </div>

            <div>
                <label class="block text-xs font-semibold text-slate-700 mb-1">Ganti Poster (Biarkan kosong jika tidak diubah)</label>
                <input type="file" name="poster" accept="image/*"
                    class="w-full px-4 py-2 text-xs rounded-2xl border border-slate-200 file:mr-4 file:py-1.5 file:px-3 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-teal-50 file:text-[#00bcba]">
            </div>

            <div class="pt-4 flex justify-end gap-3">
                <a href="{{ route('concerts.index') }}" class="px-5 py-2.5 bg-slate-100 text-slate-700 text-xs font-semibold rounded-2xl">Batal</a>
                <button type="submit" class="px-5 py-2.5 bg-[#00bcba] hover:bg-[#00a3a1] text-white text-xs font-semibold rounded-2xl shadow-sm">
                    Perbarui Konser
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
