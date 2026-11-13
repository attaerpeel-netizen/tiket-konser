@extends('layouts.app')

@section('content')
<div class="p-6 max-w-4xl mx-auto space-y-6">
    <div class="flex justify-between items-center">
        <div>
            <h1 class="text-xl font-bold text-slate-800">Detail Pesanan: {{ $order->order_code }}</h1>
            <p class="text-xs text-slate-500 mt-0.5">Verifikasi pembayaran dan perbarui status transaksi</p>
        </div>
        <a href="{{ route('orders.index') }}" class="px-4 py-2 bg-slate-100 hover:bg-slate-200 text-slate-700 text-xs font-semibold rounded-2xl">
            Kembali
        </a>
    </div>

    @if(session('success'))
        <div class="p-4 bg-emerald-50 border border-emerald-200 rounded-2xl text-xs text-emerald-600">
            {{ session('success') }}
        </div>
    @endif

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="md:col-span-2 bg-white p-6 rounded-3xl border border-slate-100 shadow-sm space-y-4 text-xs">
            <div class="flex justify-between items-center pb-4 border-b border-slate-100">
                <div>
                    <span class="text-slate-400 font-semibold uppercase tracking-wider text-[10px]">Kode Invoice</span>
                    <h2 class="font-mono text-base font-bold text-slate-800 mt-0.5">{{ $order->order_code }}</h2>
                </div>
                <span class="px-3 py-1 rounded-full text-xs font-semibold
                    @if($order->payment_status === 'Dibayar') bg-emerald-50 text-emerald-600 border border-emerald-200
                    @elseif($order->payment_status === 'Menunggu Pembayaran') bg-amber-50 text-amber-600 border border-amber-200
                    @else bg-rose-50 text-rose-600 border border-rose-200 @endif">
                    {{ $order->payment_status }}
                </span>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <span class="text-slate-400 font-semibold uppercase tracking-wider text-[10px]">Nama Pemesan</span>
                    <p class="text-slate-800 font-semibold mt-0.5">{{ $order->user->name ?? 'Pelanggan' }}</p>
                    <p class="text-slate-400 text-[11px]">{{ $order->user->email ?? '-' }}</p>
                </div>
                <div>
                    <span class="text-slate-400 font-semibold uppercase tracking-wider text-[10px]">Waktu Transaksi</span>
                    <p class="text-slate-800 mt-0.5">{{ \Carbon\Carbon::parse($order->created_at)->format('d F Y, H:i:s') }} WIB</p>
                </div>
            </div>

            <div class="pt-2">
                <span class="text-slate-400 font-semibold uppercase tracking-wider text-[10px]">Rincian Tiket</span>
                <div class="mt-2 p-4 bg-slate-50 rounded-2xl space-y-2">
                    <div class="flex justify-between font-semibold text-slate-800">
                        <span>{{ $order->concert->name ?? '-' }} ({{ $order->ticketCategory->name ?? '-' }})</span>
                        <span>{{ $order->quantity }} x Rp {{ number_format($order->price_per_ticket, 0, ',', '.') }}</span>
                    </div>
                    <div class="flex justify-between text-slate-500 pt-2 border-t border-slate-200">
                        <span class="font-bold text-slate-800">Total Pembayaran</span>
                        <span class="font-mono font-bold text-slate-800 text-sm">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Update Status Action Card -->
        <div class="bg-white p-6 rounded-3xl border border-slate-100 shadow-sm space-y-4">
            <h3 class="font-bold text-xs text-slate-800">Ubah Status Pembayaran</h3>
            <p class="text-[11px] text-slate-500">Perubahan status transaksi akan secara otomatis memperbarui kuota tiket dengan transaksi aman.</p>

            <form method="POST" action="{{ route('orders.update-status', $order->id) }}" class="space-y-4">
                @csrf
                @method('PATCH')

                <div>
                    <label class="block text-xs font-semibold text-slate-700 mb-1">Status Baru</label>
                    <select name="payment_status" class="w-full px-4 py-2 text-xs rounded-2xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-[#00bcba]">
                        <option value="Menunggu Pembayaran" {{ $order->payment_status === 'Menunggu Pembayaran' ? 'selected' : '' }}>Menunggu Pembayaran</option>
                        <option value="Dibayar" {{ $order->payment_status === 'Dibayar' ? 'selected' : '' }}>Dibayar</option>
                        <option value="Dibatalkan" {{ $order->payment_status === 'Dibatalkan' ? 'selected' : '' }}>Dibatalkan</option>
                    </select>
                </div>

                <div>
                    <label class="block text-xs font-semibold text-slate-700 mb-1">Catatan Admin</label>
                    <textarea name="notes" rows="2" class="w-full px-4 py-2 text-xs rounded-2xl border border-slate-200 focus:outline-none focus:ring-2 focus:ring-[#00bcba]" placeholder="Catatan bukti transfer...">{{ $order->notes }}</textarea>
                </div>

                <button type="submit" class="w-full py-2.5 bg-[#00bcba] hover:bg-[#00a3a1] text-white text-xs font-semibold rounded-2xl shadow-sm">
                    Simpan Perubahan Status
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
