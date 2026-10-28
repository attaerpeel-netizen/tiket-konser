<p align="center">
  <a href="https://laravel.com" target="_blank">
    <img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo">
  </a>
</p>

<p align="center">
  <a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
  <a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
  <a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
  <a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

# PunkTicket Admin

Dashboard administrasi manajemen tiket untuk promotor dan festival musik pop punk Indonesia. Sistem ini mengelola publikasi konser, alokasi kategori tiket, kuota stok tunggal (*single source of truth*), basis data pengguna, serta rekonsiliasi pesanan secara akurat.


---

## 1. Fitur Utama
- **Autentikasi Admin**: Akses khusus admin dengan enkripsi kata sandi dan proteksi session middleware.
- **Dashboard Statistik**: Metrik real-time total konser, tiket terjual, sisa kuota, pendapatan bersih, serta grafik tren penjualan.
- **Manajemen Konser (CRUD)**: Kelola jadwal, lokasi, lineup band, deskripsi, status konser, dan unggah poster.
- **Manajemen Stok & Kategori**: Atur kategori tiket (Presale, Regular, VIP), harga (IDR), dan validasi kapasitas awal vs tiket terjual.
- **Sistem Pesanan & Rekonsiliasi**: Kode invoice otomatis, pencatatan transaksi atomik (`DB::transaction` & `lockForUpdate`), serta pengembalian kuota otomatis jika status pesanan dibatalkan.
- **Manajemen Pengguna**: Database pelanggan dan staf, lengkap dengan proteksi akun admin utama dari penghapusan.

---

## 2. Aturan Stok Tunggal
- **Stok Tersedia** = Kapasitas Awal - Tiket Terjual
- Kapasitas awal baru tidak boleh lebih kecil dari jumlah tiket yang sudah terjual.
- Sistem menolak pesanan baru jika kuantitas melebihi sisa stok tersedia.
- Perubahan status pesanan ke **Dibatalkan** secara otomatis mengembalikan kuota ke stok tersedia.

---

## 3. Teknologi yang Digunakan
- **Backend Framework**: Laravel 11.x / 12.x (PHP 8.2+)
- **Database**: MySQL 8.0+
- **Frontend**: Laravel Blade, HTML5, Vanilla JavaScript, CSS

---

## 4. Lisensi & Pembuat
- **Pembuat**: Atta Alfarizi (attaerpeel@gmail.com)
- **Lisensi**: Hak Cipta © 2026 Atta Alfarizi. Seluruh hak cipta dilindungi undang-undang.
