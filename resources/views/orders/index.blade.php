@extends('layouts.app')

@section('content')
<div class="p-6 max-w-7xl mx-auto space-y-6">
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
        <div>
            <h1 class="text-xl font-bold text-slate-800">Manajemen Pesanan Tiket</h1>
            <p class="text-xs text-slate-500 mt-0.5">Pantau status transaksi, bukti pembayaran, dan alokasi stok tiket</p>
        </div>
    </div>

    <!-- Filter & Search -->
    <div class="bg-white p-4 rounded-3xl border border-slate-100 flex flex-wrap gap-3 items-center justify-between">
        <form method="GET" action="{{ route('orders.index') }}" class="flex flex-wrap gap-3 w-full sm:w-auto">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari kode pesanan / pelanggan..."
                class="px-4 py-2 text-xs rounded-2xl border border-slate-200 bg-slate-50 focus:outline-none focus:ring-2 focus:ring-[#00bcba] w-64">
            
            <select name="status" class="px-4 py-2 text-xs rounded-2xl border border-slate-200 bg-slate-50 focus:outline-none focus:ring-2 focus:ring-[#00bcba]">
                <option value="">Semua Status</option>
                <option value="Menunggu Pembayaran" {{ request('status') === 'Menunggu Pembayaran' ? 'selected' : '' }}>Menunggu Pembayaran</option>
                <option value="Dibayar" {{ request('status') === 'Dibayar' ? 'selected' : '' }}>Dibayar</option>
                <option value="Dibatalkan" {{ request('status') === 'Dibatalkan' ? 'selected' : '' }}>Dibatalkan</option>
            </select>

            <button type="submit" class="px-4 py-2 bg-slate-800 text-white text-xs rounded-2xl font-medium">Filter</button>
        </form>
    </div>

    <!-- Table -->
    <div class="bg-white rounded-3xl border border-slate-100 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs">
                <thead class="bg-slate-50 text-slate-500 border-b border-slate-100">
                    <tr>
                        <th class="p-4">Kode Pesanan</th>
                        <th class="p-4">Pelanggan</th>
                        <th class="p-4">Konser & Kategori</th>
                        <th class="p-4">Jumlah</th>
                        <th class="p-4">Total Bayar</th>
                        <th class="p-4">Status</th>
                        <th class="p-4">Waktu Order</th>
                        <th class="p-4 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($orders as $o)
                    <tr class="hover:bg-slate-50/60">
                        <td class="p-4 font-mono font-bold text-slate-800">{{ $o->order_code }}</td>
                        <td class="p-4">
                            <span class="font-semibold text-slate-800 block">{{ $o->user->name ?? 'Pelanggan' }}</span>
                            <span class="text-slate-400 text-[10px]">{{ $o->user->email ?? '-' }}</span>
                        </td>
                        <td class="p-4">
                            <span class="font-medium text-slate-800 block">{{ $o->concert->name ?? '-' }}</span>
                            <span class="text-slate-500 text-[10px]">{{ $o->ticketCategory->name ?? '-' }}</span>
                        </td>
                        <td class="p-4 font-medium">{{ $o->quantity }} tiket</td>
                        <td class="p-4 font-mono font-bold text-slate-800">Rp {{ number_format($o->total_amount, 0, ',', '.') }}</td>
                        <td class="p-4">
                            <span class="px-3 py-1 rounded-full text-[11px] font-semibold
                                @if($o->payment_status === 'Dibayar') bg-emerald-50 text-emerald-600 border border-emerald-200
                                @elseif($o->payment_status === 'Menunggu Pembayaran') bg-amber-50 text-amber-600 border border-amber-200
                                @else bg-rose-50 text-rose-600 border border-rose-200 @endif">
                                {{ $o->payment_status }}
                            </span>
                        </td>
                        <td class="p-4 text-slate-500">{{ \Carbon\Carbon::parse($o->created_at)->format('d M Y, H:i') }}</td>
                        <td class="p-4 text-center">
                            <a href="{{ route('orders.show', $o->id) }}" class="px-3 py-1.5 text-teal-600 bg-teal-50 hover:bg-teal-100 rounded-xl font-semibold">
                                Detail
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" class="p-8 text-center text-slate-400">Belum ada transaksi pesanan yang sesuai.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if(method_exists($orders, 'links'))
        <div class="p-4 border-t border-slate-100">
            {{ $orders->links() }}
        </div>
        @endif
    </div>
</div>
@endsection
