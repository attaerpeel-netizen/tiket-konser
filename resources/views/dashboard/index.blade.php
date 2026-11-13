@extends('layouts.app')

@section('title', 'Ringkasan Dashboard')

@section('content')
<div class="space-y-6">
    <!-- TOP WIDGETS ROW (Exact composition matching preview and reference image) -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-12 gap-5">
        
        <!-- Widget 1: Tiket Terjual + Purple Wave Curve -->
        <div class="lg:col-span-3 bg-white border border-[#d8eef0] p-5 rounded-3xl shadow-xs flex flex-col justify-between">
            <div>
                <div class="flex items-center justify-between">
                    <div>
                        <h3 class="font-bold text-sm text-slate-800">Tiket Terjual</h3>
                        <p class="text-[11px] text-slate-400">Akumulasi konser aktif</p>
                    </div>
                    <span class="px-2 py-0.5 rounded-full text-[11px] font-bold bg-[#fbbd23] text-slate-900 shadow-xs">
                        +{{ number_format($totalSoldTickets, 0, ',', '.') }}
                    </span>
                </div>
            </div>

            <!-- SVG Smooth Wave curve (Purple) -->
            <div class="my-4 py-2">
                <svg viewBox="0 0 200 65" class="w-full h-16 overflow-visible">
                    <path d="M 5,45 Q 35,5 65,35 T 125,50 T 175,15" fill="none" stroke="#6366f1" stroke-width="3.5" stroke-linecap="round" />
                    <circle cx="175" cy="15" r="4.5" fill="#6366f1" />
                    <line x1="5" y1="52" x2="195" y2="52" stroke="#e2e8f0" stroke-dasharray="3 3" />
                </svg>
            </div>

            <div class="flex items-center justify-between text-xs pt-1 border-t border-slate-100">
                <span class="text-slate-400 text-[11px]">Kapasitas Total</span>
                <span class="font-bold text-slate-700">{{ number_format($totalAvailableStock + $totalSoldTickets, 0, ',', '.') }} Lembar</span>
            </div>
        </div>

        <!-- Widget 2: Tren Penjualan Mingguan + Connected Dot Chart -->
        <div class="lg:col-span-3 bg-white border border-[#d8eef0] p-5 rounded-3xl shadow-xs flex flex-col justify-between">
            <div class="flex items-center justify-between">
                <div>
                    <h3 class="font-bold text-sm text-slate-800">Aktivitas Penjualan</h3>
                    <p class="text-[11px] text-slate-400">Pola transaksi mingguan</p>
                </div>
                <span class="px-2.5 py-0.5 rounded-full text-[10px] font-semibold bg-[#f1f9f9] text-[#009b99] border border-[#d2eff2]">
                    Minggu Ini
                </span>
            </div>

            <div class="my-3 py-1">
                <svg viewBox="0 0 200 70" class="w-full h-16 overflow-visible">
                    <polyline points="15,40 45,25 75,50 105,15 135,38 165,30 190,20" fill="none" stroke="#fbbd23" stroke-width="2.5" stroke-linecap="round" />
                    <circle cx="15" cy="40" r="3.5" fill="#6366f1" />
                    <circle cx="45" cy="25" r="3.5" fill="#fbbd23" />
                    <circle cx="75" cy="50" r="3.5" fill="#00bcba" />
                    <circle cx="105" cy="15" r="3.5" fill="#6366f1" />
                    <circle cx="135" cy="38" r="3.5" fill="#00bcba" />
                    <circle cx="165" cy="30" r="3.5" fill="#fbbd23" />
                    <circle cx="190" cy="20" r="3.5" fill="#fbbd23" />
                </svg>
                <div class="flex justify-between text-[9px] text-slate-400 px-1 font-mono">
                    <span>Sen</span>
                    <span>Sel</span>
                    <span>Rab</span>
                    <span>Kam</span>
                    <span>Jum</span>
                    <span>Sab</span>
                    <span>Min</span>
                </div>
            </div>

            <div class="flex items-center justify-between text-xs pt-1 border-t border-slate-100">
                <span class="text-slate-400 text-[11px]">Rata-rata Harian</span>
                <span class="font-bold text-[#00bcba]">140+ Transaksi</span>
            </div>
        </div>

        <!-- Widget 3: Mini Calendar Widget -->
        <div class="lg:col-span-3 bg-white border border-[#d8eef0] p-4 sm:p-5 rounded-3xl shadow-xs">
            <div class="flex items-center justify-between mb-2">
                <span class="text-[#00bcba] p-0.5 cursor-pointer font-bold">‹</span>
                <span class="font-bold text-xs text-slate-700">November 2026</span>
                <span class="text-[#00bcba] p-0.5 cursor-pointer font-bold">›</span>
            </div>

            <div class="grid grid-cols-7 text-center text-[10px] text-slate-400 font-semibold mb-1">
                <span>min</span>
                <span>sen</span>
                <span>sel</span>
                <span>rab</span>
                <span>kam</span>
                <span>jum</span>
                <span>sab</span>
            </div>

            <div class="grid grid-cols-7 gap-y-1 text-center text-[10px] text-slate-600 font-medium">
                <span class="text-slate-300">1</span>
                <span class="text-slate-300">2</span>
                <span>3</span>
                <span>4</span>
                <span>5</span>
                <span>6</span>
                <span>7</span>
                <span>8</span>
                <span>9</span>
                <span>10</span>
                <span>11</span>
                <span>12</span>
                <span>13</span>
                <span class="relative flex items-center justify-center">
                    <span class="w-5 h-5 rounded-full border border-[#00bcba] text-[#00bcba] font-bold flex items-center justify-center">15</span>
                </span>
                <span>16</span>
                <span>17</span>
                <span>18</span>
                <span>19</span>
                <span>20</span>
                <span>21</span>
                <span>22</span>
                <span>23</span>
                <span>24</span>
                <span>25</span>
                <span>26</span>
                <span>27</span>
                <span class="relative flex items-center justify-center">
                    <span class="w-5 h-5 rounded-full bg-[#fbbd23] text-slate-900 font-bold flex items-center justify-center">28</span>
                </span>
                <span>29</span>
                <span>30</span>
            </div>
            <div class="mt-2 pt-2 border-t border-slate-100 flex items-center justify-between text-[10px]">
                <span class="flex items-center gap-1 text-[#009b99] font-medium">
                    <span class="w-2 h-2 rounded-full bg-[#00bcba] inline-block"></span> Rebellion
                </span>
                <span class="flex items-center gap-1 text-amber-700 font-medium">
                    <span class="w-2 h-2 rounded-full bg-[#fbbd23] inline-block"></span> Never Die
                </span>
            </div>
        </div>

        <!-- Widget 4: Target Kuota Dual Circular Radial Gauges -->
        @php
            $totalCap = $totalAvailableStock + $totalSoldTickets;
            $occupancyPct = $totalCap > 0 ? round(($totalSoldTickets / $totalCap) * 100) : 0;
        @endphp
        <div class="lg:col-span-3 bg-white border border-[#d8eef0] p-5 rounded-3xl shadow-xs flex flex-col justify-between">
            <div class="flex items-center justify-between">
                <h3 class="font-bold text-sm text-slate-800">Target Kuota</h3>
                <span class="text-[10px] text-slate-400">Total Alokasi</span>
            </div>

            <div class="flex items-center justify-around my-2">
                <div class="text-center">
                    <div class="relative w-16 h-16 flex items-center justify-center">
                        <svg class="w-16 h-16 -rotate-90">
                            <circle cx="32" cy="32" r="26" stroke="#e6f7f8" stroke-width="5" fill="none" />
                            <circle cx="32" cy="32" r="26" stroke="#fbbd23" stroke-width="5" stroke-dasharray="163" stroke-dashoffset="45" stroke-linecap="round" fill="none" />
                        </svg>
                        <span class="absolute font-bold text-xs text-slate-800">{{ round($totalCap / 1000) }}K</span>
                    </div>
                    <p class="text-[10px] font-bold text-slate-700 mt-1">Kapasitas</p>
                    <p class="text-[9px] text-slate-400">Seluruh venue</p>
                </div>

                <div class="text-center">
                    <div class="relative w-16 h-16 flex items-center justify-center">
                        <svg class="w-16 h-16 -rotate-90">
                            <circle cx="32" cy="32" r="26" stroke="#e6f7f8" stroke-width="5" fill="none" />
                            <circle cx="32" cy="32" r="26" stroke="#6366f1" stroke-width="5" stroke-dasharray="163" stroke-dashoffset="{{ 163 - (163 * $occupancyPct) / 100 }}" stroke-linecap="round" fill="none" />
                        </svg>
                        <span class="absolute font-bold text-xs text-slate-800">{{ $occupancyPct }}%</span>
                    </div>
                    <p class="text-[10px] font-bold text-slate-700 mt-1">Okupansi</p>
                    <p class="text-[9px] text-slate-400">Target promotor</p>
                </div>
            </div>

            <div class="text-[11px] text-center text-slate-500 pt-1 border-t border-slate-100">
                Pendapatan: <strong class="text-[#00bcba] font-bold">Rp {{ number_format($totalRevenue, 0, ',', '.') }}</strong>
            </div>
        </div>
    </div>

    <!-- MIDDLE WIDGETS ROW -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-12 gap-5">
        <!-- Widget 5: Kuota Tersedia & Total Pesanan Split Numbers -->
        <div class="lg:col-span-3 bg-white border border-[#d8eef0] p-5 rounded-3xl shadow-xs flex flex-col justify-between">
            <div>
                <h3 class="font-bold text-sm text-slate-800">Ringkasan Kuota</h3>
                <p class="text-[11px] text-slate-400">Sisa stok vs pesanan masuk</p>
            </div>

            <div class="grid grid-cols-2 gap-4 my-3">
                <div>
                    <p class="text-2xl font-black text-slate-800 tracking-tight">
                        {{ number_format($totalAvailableStock, 0, ',', '.') }}
                    </p>
                    <p class="text-[10px] text-slate-400 font-medium">Tiket Tersedia</p>
                    <svg viewBox="0 0 80 25" class="w-full h-6 mt-1">
                        <path d="M 0,15 Q 20,5 40,18 T 80,8" fill="none" stroke="#fbbd23" stroke-width="2" />
                    </svg>
                </div>

                <div>
                    <p class="text-2xl font-black text-slate-800 tracking-tight">
                        {{ $totalOrders }}
                    </p>
                    <p class="text-[10px] text-slate-400 font-medium">Total Pesanan</p>
                    <svg viewBox="0 0 80 25" class="w-full h-6 mt-1">
                        <path d="M 0,18 Q 20,8 40,12 T 80,5" fill="none" stroke="#00bcba" stroke-width="2" />
                    </svg>
                </div>
            </div>

            <div class="flex items-center justify-between text-xs pt-2 border-t border-slate-100">
                <span class="text-[11px] text-slate-400">Menunggu Bayar</span>
                <span class="font-bold text-amber-600 px-2 py-0.5 rounded-full bg-amber-50">
                    {{ $pendingOrders }} Pesanan
                </span>
            </div>
        </div>

        <!-- Widget 6: Big Radial Progress Donut with Yellow Action Button -->
        <div class="lg:col-span-3 bg-white border border-[#d8eef0] p-5 rounded-3xl shadow-xs flex flex-col items-center justify-between text-center">
            <div class="w-full flex items-center justify-between">
                <h3 class="font-bold text-sm text-slate-800">Persentase Terjual</h3>
                <span class="text-[10px] px-2 py-0.5 rounded-full bg-[#e6f7f8] text-[#009b99] font-semibold">
                    Live
                </span>
            </div>

            <div class="relative w-32 h-32 my-2 flex items-center justify-center">
                <svg class="w-32 h-32 -rotate-90">
                    <circle cx="64" cy="64" r="50" stroke="#f0fafa" stroke-width="9" fill="none" />
                    <circle cx="64" cy="64" r="50" stroke="#00bcba" stroke-width="9" stroke-dasharray="314" stroke-dashoffset="{{ 314 - (314 * $occupancyPct) / 100 }}" stroke-linecap="round" fill="none" />
                </svg>
                <div class="absolute flex flex-col items-center">
                    <span class="text-2xl font-black text-slate-800">{{ $occupancyPct }}%</span>
                    <span class="text-[9px] text-slate-400 font-medium">Kapasitas</span>
                </div>
            </div>

            <p class="text-[11px] text-slate-500 mb-2 max-w-[180px]">
                {{ number_format($totalSoldTickets, 0, ',', '.') }} tiket telah terjual dari total kuota.
            </p>

            <a href="{{ route('tickets.index') }}" class="w-full py-2.5 rounded-2xl bg-[#fbbd23] hover:bg-[#f59e0b] font-bold text-xs text-slate-900 shadow-sm transition block text-center">
                Kelola Stok Tiket
            </a>
        </div>

        <!-- Widget 7: Dual Smooth Wave Line Chart -->
        <div class="lg:col-span-6 bg-white border border-[#d8eef0] p-5 rounded-3xl shadow-xs flex flex-col justify-between">
            <div class="flex items-center justify-between mb-2">
                <div>
                    <h3 class="font-bold text-sm text-slate-800">Tren Penjualan & Pendapatan Tiket</h3>
                    <p class="text-[11px] text-slate-400">Fluktuasi harian tiket pop punk</p>
                </div>
                <div class="flex items-center space-x-3 text-xs">
                    <span class="flex items-center text-[11px] text-slate-500">
                        <span class="w-2.5 h-2.5 rounded-full bg-[#6366f1] mr-1.5"></span> Tiket Masuk
                    </span>
                    <span class="flex items-center text-[11px] text-slate-500">
                        <span class="w-2.5 h-2.5 rounded-full bg-[#fbbd23] mr-1.5"></span> Pendapatan
                    </span>
                </div>
            </div>

            <div class="my-2 py-1">
                <svg viewBox="0 0 450 130" class="w-full h-32 overflow-visible">
                    <line x1="0" y1="30" x2="450" y2="30" stroke="#f1f5f9" stroke-width="1" />
                    <line x1="0" y1="70" x2="450" y2="70" stroke="#f1f5f9" stroke-width="1" />
                    <line x1="0" y1="110" x2="450" y2="110" stroke="#f1f5f9" stroke-width="1" />

                    <!-- Yellow line -->
                    <path d="M 10,65 Q 60,30 110,75 T 210,85 T 310,95 T 380,45 T 440,75" fill="none" stroke="#fbbd23" stroke-width="3" stroke-linecap="round" />
                    <circle cx="110" cy="75" r="4" fill="#fbbd23" />
                    <circle cx="310" cy="95" r="4" fill="#fbbd23" />
                    <circle cx="380" cy="45" r="4" fill="#fbbd23" />

                    <!-- Purple line -->
                    <path d="M 10,85 Q 60,70 110,80 T 210,60 T 310,50 T 360,20 T 440,115" fill="none" stroke="#6366f1" stroke-width="3" stroke-linecap="round" />
                    <circle cx="210" cy="60" r="4" fill="#6366f1" />
                    <circle cx="360" cy="20" r="5" fill="#6366f1" />
                </svg>
            </div>

            <div class="flex items-center justify-between text-xs pt-2 border-t border-slate-100 text-slate-500">
                <span>Konser Terlaris: <strong class="text-slate-800">Punk Rock Rebellion (Senayan)</strong></span>
                <span class="font-bold text-[#00bcba]">Total: Rp {{ number_format($totalRevenue, 0, ',', '.') }}</span>
            </div>
        </div>
    </div>

    <!-- BOTTOM WIDGETS ROW -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-12 gap-5">
        <!-- Widget 8: Multi-color Bar Chart -->
        <div class="lg:col-span-3 bg-white border border-[#d8eef0] p-5 rounded-3xl shadow-xs flex flex-col justify-between">
            <div>
                <h3 class="font-bold text-sm text-slate-800">Distribusi Kuota</h3>
                <p class="text-[11px] text-slate-400">Rasio terjual vs sisa per kategori</p>
            </div>

            <div class="my-3 py-1 flex items-center justify-center">
                <svg viewBox="0 0 160 85" class="w-full h-20 overflow-visible">
                    <line x1="0" y1="42" x2="160" y2="42" stroke="#6366f1" stroke-width="2" />
                    <rect x="15" y="20" width="12" height="22" fill="#fbbd23" rx="2" />
                    <rect x="35" y="30" width="12" height="28" fill="#00bcba" rx="2" />
                    <rect x="55" y="10" width="12" height="48" fill="#fbbd23" rx="2" />
                    <rect x="75" y="24" width="12" height="34" fill="#00bcba" rx="2" />
                    <rect x="95" y="35" width="12" height="24" fill="#fbbd23" rx="2" />
                    <rect x="115" y="26" width="12" height="30" fill="#00bcba" rx="2" />
                </svg>
            </div>

            <div class="flex items-center justify-between text-[11px] pt-2 border-t border-slate-100 text-slate-500">
                <span class="flex items-center gap-1">
                    <span class="w-2.5 h-2.5 rounded-full bg-[#fbbd23]"></span> Presale
                </span>
                <span class="flex items-center gap-1">
                    <span class="w-2.5 h-2.5 rounded-full bg-[#00bcba]"></span> Regular
                </span>
            </div>
        </div>

        <!-- Widget 9: Horizontal Timeline Milestone Bar -->
        <div class="lg:col-span-5 bg-white border border-[#d8eef0] p-5 rounded-3xl shadow-xs flex flex-col justify-between">
            <div>
                <h3 class="font-bold text-sm text-slate-800">Tahapan Penjualan Tiket</h3>
                <p class="text-[11px] text-slate-400">Jalur distribusi rilis tiket konser pop punk</p>
            </div>

            <div class="my-4 py-2">
                <div class="relative flex items-center justify-between">
                    <div class="absolute left-0 right-0 h-1 bg-[#6366f1] top-1/2 -translate-y-1/2"></div>
                    
                    <div class="relative z-10 flex flex-col items-center">
                        <span class="px-2 py-0.5 rounded text-[10px] font-bold bg-[#00bcba] text-white shadow-xs mb-1">Early Bird</span>
                        <div class="w-3 h-3 rounded-full bg-[#6366f1] border-2 border-white"></div>
                        <span class="mt-1 px-2 py-0.5 rounded text-[9px] font-bold bg-[#fbbd23] text-slate-900 shadow-xs">Sold Out</span>
                    </div>

                    <div class="relative z-10 flex flex-col items-center">
                        <span class="px-2 py-0.5 rounded text-[10px] font-bold bg-[#00bcba] text-white shadow-xs mb-1">Presale 1 & 2</span>
                        <div class="w-3 h-3 rounded-full bg-[#6366f1] border-2 border-white"></div>
                        <span class="mt-1 px-2 py-0.5 rounded text-[9px] font-bold bg-[#fbbd23] text-slate-900 shadow-xs">Terjual 85%</span>
                    </div>

                    <div class="relative z-10 flex flex-col items-center">
                        <span class="px-2 py-0.5 rounded text-[10px] font-bold bg-[#00bcba] text-white shadow-xs mb-1">VIP & Regular</span>
                        <div class="w-3 h-3 rounded-full bg-[#6366f1] border-2 border-white"></div>
                        <span class="mt-1 px-2 py-0.5 rounded text-[9px] font-bold bg-emerald-500 text-white shadow-xs">Buka</span>
                    </div>
                </div>
            </div>

            <div class="flex items-center justify-between text-[11px] pt-2 border-t border-slate-100 text-slate-500">
                <span>Rilis Gelombang Selanjutnya</span>
                <span class="font-bold text-[#00bcba]">1 November 2026</span>
            </div>
        </div>

        <!-- Widget 10: Day of Week Bar Chart -->
        <div class="lg:col-span-4 bg-white border border-[#d8eef0] p-5 rounded-3xl shadow-xs flex flex-col justify-between">
            <div class="flex items-center justify-between">
                <div>
                    <h3 class="font-bold text-sm text-slate-800">Traffic Pembelian</h3>
                    <p class="text-[11px] text-slate-400">Puncak order harian</p>
                </div>
                <span class="text-[10px] font-bold text-[#00bcba]">Sabtu & Minggu Puncak</span>
            </div>

            <div class="flex items-end justify-between h-20 my-2 px-2">
                <div class="flex flex-col items-center gap-1">
                    <div class="w-3.5 bg-[#fbbd23] rounded-t-sm" style="height: 40px"></div>
                    <span class="text-[9px] text-slate-400">Min</span>
                </div>
                <div class="flex flex-col items-center gap-1">
                    <div class="w-3.5 bg-[#6366f1] rounded-t-sm" style="height: 30px"></div>
                    <span class="text-[9px] text-slate-400">Sen</span>
                </div>
                <div class="flex flex-col items-center gap-1">
                    <div class="w-3.5 bg-[#00bcba] rounded-t-sm" style="height: 48px"></div>
                    <span class="text-[9px] text-slate-400">Sel</span>
                </div>
                <div class="flex flex-col items-center gap-1">
                    <div class="w-3.5 bg-[#fbbd23] rounded-t-sm" style="height: 25px"></div>
                    <span class="text-[9px] text-slate-400">Rab</span>
                </div>
                <div class="flex flex-col items-center gap-1">
                    <div class="w-3.5 bg-[#00bcba] rounded-t-sm" style="height: 55px"></div>
                    <span class="text-[9px] text-slate-400">Kam</span>
                </div>
                <div class="flex flex-col items-center gap-1">
                    <div class="w-3.5 bg-[#6366f1] rounded-t-sm" style="height: 65px"></div>
                    <span class="text-[9px] text-slate-400">Jum</span>
                </div>
                <div class="flex flex-col items-center gap-1">
                    <div class="w-3.5 bg-[#fbbd23] rounded-t-sm" style="height: 72px"></div>
                    <span class="text-[9px] text-slate-400">Sab</span>
                </div>
            </div>

            <div class="flex items-center justify-between text-xs pt-1 border-t border-slate-100 text-slate-500">
                <span class="text-[11px]">Rata-rata Konversi</span>
                <span class="font-bold text-slate-700">92.4% Sukses</span>
            </div>
        </div>
    </div>

    <!-- 8 STAT CARDS GRID -->
    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
        <div class="bg-white border border-[#d8eef0] p-4 rounded-2xl shadow-xs">
            <span class="text-[10px] font-bold uppercase text-slate-400 tracking-wider">Total Konser</span>
            <p class="text-2xl font-black text-slate-800 mt-1">{{ $totalConcerts }}</p>
            <p class="text-[11px] text-slate-500 mt-0.5">Event pop punk aktif</p>
        </div>

        <div class="bg-white border border-[#d8eef0] p-4 rounded-2xl shadow-xs">
            <span class="text-[10px] font-bold uppercase text-slate-400 tracking-wider">Total Pengguna</span>
            <p class="text-2xl font-black text-slate-800 mt-1">{{ $totalUsers }}</p>
            <p class="text-[11px] text-slate-500 mt-0.5">Pelanggan terdaftar</p>
        </div>

        <div class="bg-white border border-[#d8eef0] p-4 rounded-2xl shadow-xs">
            <span class="text-[10px] font-bold uppercase text-slate-400 tracking-wider">Kategori Tiket</span>
            <p class="text-2xl font-black text-slate-800 mt-1">{{ $totalTicketCategories }}</p>
            <p class="text-[11px] text-slate-500 mt-0.5">Presale, Regular, VIP</p>
        </div>

        <div class="bg-white border border-[#d8eef0] p-4 rounded-2xl shadow-xs">
            <span class="text-[10px] font-bold uppercase text-slate-400 tracking-wider">Tiket Tersedia</span>
            <p class="text-2xl font-black text-[#00bcba] mt-1">{{ number_format($totalAvailableStock, 0, ',', '.') }}</p>
            <p class="text-[11px] text-slate-500 mt-0.5">Sisa kuota siap jual</p>
        </div>

        <div class="bg-white border border-[#d8eef0] p-4 rounded-2xl shadow-xs">
            <span class="text-[10px] font-bold uppercase text-slate-400 tracking-wider">Tiket Terjual</span>
            <p class="text-2xl font-black text-emerald-600 mt-1">{{ number_format($totalSoldTickets, 0, ',', '.') }}</p>
            <p class="text-[11px] text-slate-500 mt-0.5">Lembar teralokasi</p>
        </div>

        <div class="bg-white border border-[#d8eef0] p-4 rounded-2xl shadow-xs">
            <span class="text-[10px] font-bold uppercase text-slate-400 tracking-wider">Total Pesanan</span>
            <p class="text-2xl font-black text-slate-800 mt-1">{{ $totalOrders }}</p>
            <p class="text-[11px] text-slate-500 mt-0.5">Invoice tercatat</p>
        </div>

        <div class="bg-white border border-[#d8eef0] p-4 rounded-2xl shadow-xs">
            <span class="text-[10px] font-bold uppercase text-slate-400 tracking-wider">Menunggu Bayar</span>
            <p class="text-2xl font-black text-amber-500 mt-1">{{ $pendingOrders }}</p>
            <p class="text-[11px] text-slate-500 mt-0.5">Perlu konfirmasi</p>
        </div>

        <div class="bg-white border border-[#d8eef0] p-4 rounded-2xl shadow-xs">
            <span class="text-[10px] font-bold uppercase text-slate-400 tracking-wider">Pendapatan</span>
            <p class="text-xl font-black text-[#00bcba] mt-1">Rp {{ number_format($totalRevenue, 0, ',', '.') }}</p>
            <p class="text-[11px] text-slate-500 mt-0.5">Pesanan lunas</p>
        </div>
    </div>

    <!-- TABLES: KONSER TERBARU & PESANAN TERBARU -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Recent Concerts -->
        <div class="bg-white border border-[#d8eef0] rounded-3xl shadow-xs overflow-hidden">
            <div class="p-5 border-b border-[#d8eef0] flex items-center justify-between">
                <h3 class="font-bold text-sm text-slate-800">Konser Terbaru</h3>
                <a href="{{ route('concerts.index') }}" class="text-xs font-semibold text-[#00bcba] hover:underline">Lihat Semua →</a>
            </div>
            <div class="divide-y divide-slate-100">
                @forelse($recentConcerts as $rc)
                    <div class="p-4 flex items-center justify-between hover:bg-slate-50/60 transition">
                        <div class="flex items-center space-x-3 min-w-0">
                            <img src="{{ $rc->poster_url ?? asset('images/default-poster.jpg') }}" class="w-10 h-10 rounded-xl object-cover border border-[#d8eef0]" alt="Poster">
                            <div class="min-w-0">
                                <h4 class="font-bold text-xs text-slate-800 truncate">{{ $rc->name }}</h4>
                                <p class="text-[11px] text-slate-400 truncate">{{ $rc->location }}</p>
                            </div>
                        </div>
                        <div class="text-right">
                            <span class="px-2.5 py-0.5 rounded-full text-[10px] font-semibold
                                @if($rc->status === 'Akan Datang') bg-teal-50 text-[#00bcba] border border-teal-200
                                @elseif($rc->status === 'Berlangsung') bg-emerald-50 text-emerald-600 border border-emerald-200
                                @elseif($rc->status === 'Draft') bg-amber-50 text-amber-600 border border-amber-200
                                @else bg-slate-100 text-slate-600 @endif">
                                {{ $rc->status }}
                            </span>
                            <p class="text-[10px] text-slate-400 mt-1">{{ \Carbon\Carbon::parse($rc->date_time)->format('d M Y') }}</p>
                        </div>
                    </div>
                @empty
                    <div class="p-8 text-center text-xs text-slate-400">Belum ada data konser.</div>
                @endforelse
            </div>
        </div>

        <!-- Recent Orders -->
        <div class="bg-white border border-[#d8eef0] rounded-3xl shadow-xs overflow-hidden">
            <div class="p-5 border-b border-[#d8eef0] flex items-center justify-between">
                <h3 class="font-bold text-sm text-slate-800">Pesanan Tiket Terbaru</h3>
                <a href="{{ route('orders.index') }}" class="text-xs font-semibold text-[#00bcba] hover:underline">Lihat Semua →</a>
            </div>
            <div class="divide-y divide-slate-100">
                @forelse($recentOrders as $ro)
                    <div class="p-4 flex items-center justify-between hover:bg-slate-50/60 transition">
                        <div>
                            <span class="text-xs font-mono font-bold text-[#00bcba]">{{ $ro->order_code }}</span>
                            <h4 class="text-xs font-semibold text-slate-800 mt-0.5">{{ $ro->user->name ?? 'Pelanggan' }}</h4>
                            <p class="text-[11px] text-slate-400">{{ $ro->concert->name ?? '-' }} ({{ $ro->quantity }}x {{ $ro->ticketCategory->name ?? '' }})</p>
                        </div>
                        <div class="text-right">
                            <span class="px-2.5 py-0.5 text-[10px] font-semibold rounded-full
                                @if($ro->payment_status === 'Dibayar') bg-emerald-50 text-emerald-600 border border-emerald-200
                                @elseif($ro->payment_status === 'Menunggu Pembayaran') bg-amber-50 text-amber-600 border border-amber-200
                                @else bg-rose-50 text-rose-600 border border-rose-200 @endif">
                                {{ $ro->payment_status }}
                            </span>
                            <p class="text-xs font-bold text-slate-800 mt-1">Rp {{ number_format($ro->total_amount, 0, ',', '.') }}</p>
                        </div>
                    </div>
                @empty
                    <div class="p-8 text-center text-xs text-slate-400">Belum ada transaksi pesanan.</div>
                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection
