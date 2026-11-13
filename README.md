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

# Panduan Penggunaan Website - PunkTicket Admin

**Aplikasi:** PunkTicket Admin  
**Jenis Aplikasi:** Dashboard Administrasi Manajemen Tiket Konser Musik Pop Punk Indonesia  
**Pembuat:** Atta Alfarizi  
**Email:** attaerpeel@gmail.com  
**Bahasa Antarmuka:** Bahasa Indonesia  
**Lisensi:** Hak Cipta © 2026 Atta Alfarizi. Seluruh hak cipta dilindungi undang-undang.

---

## 1. Deskripsi Aplikasi
PunkTicket Admin adalah sistem manajemen administrasi tiket konser berbasis web yang dirancang khusus untuk promotor dan penyelenggara festival musik pop punk di Indonesia. Sistem ini memberikan kendali menyeluruh terhadap publikasi konser musik, pengaturan kategori tiket, pemantauan kapasitas dan kuota tiket, pengelolaan basis data pengguna/pelanggan, serta pengawasan transaksi pesanan tiket dengan prinsip akurasi stok tunggal (*single source of truth*).

Seluruh data konser, nama penampil, harga, dan kuota tiket dalam demo sistem ini berstatus sebagai **data contoh/simulasi** untuk keperluan pengujian dan portofolio promotor, bukan jadwal konser riil.

---

## 2. Fitur Utama Sistem
1. **Autentikasi Aman Khusus Admin**: Sistem login dengan proteksi session, enkripsi kata sandi menggunakan hashing Laravel (*Bcrypt/Argon2*), serta pembatasan akses (*middleware*).
2. **Dashboard Statistik Real-Time**:
   - Total konser terdaftar.
   - Total pelanggan/pengguna aktif.
   - Total kategori tiket yang dibuka.
   - Total kapasitas dan sisa stok tiket tersedia.
   - Total akumulasi tiket terjual.
   - Total pesanan tiket.
   - Jumlah pesanan yang masih berstatus menunggu pembayaran.
   - Total pendapatan bersih dari pesanan berstatus dibayar.
   - Grafik tren penjualan tiket per konser.
   - Tabel ringkasan konser dan transaksi pesanan terbaru.
3. **Manajemen Konser (CRUD Lengkap)**:
   - Penambahan konser baru dengan upload poster, daftar lineup band, tanggal, waktu, lokasi, deskripsi, dan status.
   - Pencarian berdasarkan judul konser atau lokasi panggung.
   - Filter status konser: *Draft*, *Akan Datang*, *Berlangsung*, atau *Selesai*.
   - Detail informasi konser lengkap dengan daftar kategori tiket terikat.
   - Pembaruan data konser.
   - Penghapusan aman (*safe delete*) dengan pengecekan relasi transaksi aktif.
4. **Manajemen Kategori & Stok Tiket**:
   - Pengaturan kategori tiket (seperti *Presale*, *Regular*, dan *VIP*).
   - Penentuan harga tiket dalam mata uang Rupiah (IDR).
   - Penentuan kapasitas awal tiket.
   - Perhitungan otomatis sisa stok tiket dan persentase penjualan.
   - Validasi ketat aturan kapasitas: kapasitas baru tidak boleh lebih kecil dari tiket yang telah terjual.
5. **Manajemen Pengguna & Pelanggan**:
   - Daftar identitas pengguna: ID, Nama Lengkap, Alamat Email, Nomor Telepon, Status Akun, dan Tanggal Registrasi.
   - Penambahan dan pembaruan data pengguna.
   - Proteksi akun admin utama agar tidak dapat terhapus secara tidak sengaja.
6. **Manajemen Pesanan Tiket**:
   - Kode pesanan unik berformat standar industri (contoh: `ORD-PK-20261020-001`).
   - Pencatatan nama pemesan, konser tujuan, kategori tiket, kuantitas, dan total nominal.
   - Siklus status pembayaran: *Menunggu Pembayaran*, *Dibayar*, dan *Dibatalkan*.
   - Rekonsiliasi stok otomatis dengan transaksi database atomik (*database transaction & row locking*).
7. **Profil Administrator**:
   - Pembaruan nama profil, email korespondensi, dan pergantian kata sandi admin.

---

## 3. Struktur Proyek

| File / Folder | Fungsi |
|---|---|
| `app/Models/` | Model Eloquent (`Concert.php`, `TicketCategory.php`, `Order.php`, `OrderItem.php`, `User.php`)[cite: 1] |
| `app/Http/Controllers/` | Logika bisnis utama (`ConcertController`, `TicketCategoryController`, `OrderController`, `DashboardController`, `UserController`, `ProfileController`, `AuthController`)[cite: 1] |
| `app/Http/Middleware/AdminMiddleware.php` | Proteksi pembatasan hak akses khusus role administrator[cite: 1] |
| `app/Http/Requests/` | Class aturan validasi input (`ConcertRequest`, `TicketCategoryRequest`, `OrderStatusRequest`, `UserRequest`)[cite: 1] |
| `database/migrations/` | Skema struktur tabel database (`users`, `concerts`, `ticket_categories`, `orders`, `order_items`)[cite: 1] |
| `database/seeders/` | Data awal (*seeders*) untuk akun admin, konser simulasi, kategori tiket, dan pesanan[cite: 1] |
| `resources/views/concerts/` | Tampilan CRUD manajemen konser dan kelola poster (`index`, `create`, `edit`, `show`)[cite: 1] |
| `resources/views/tickets/` | Tampilan manajemen kategori tiket, penetapan harga, dan alokasi stok (`index`, `create`, `edit`)[cite: 1] |
| `resources/views/orders/` | Tampilan pengawasan pesanan tiket dan pembaruan status pembayaran (`index`, `show`)[cite: 1] |
| `resources/views/dashboard/` | Tampilan statistik utama, metrik ringkasan, dan grafik tren penjualan real-time (`index`)[cite: 1] |
| `resources/views/users/` | Tampilan manajemen basis data pelanggan dan staf admin (`index`, `create`, `edit`)[cite: 1] |
| `resources/views/profile/` | Tampilan manajemen profil dan ubah kata sandi administrator (`index`)[cite: 1] |
| `resources/views/auth/` | Tampilan antarmuka login dan registrasi (`login`, `register`)[cite: 1] |
| `resources/views/layouts/app.blade.php` | Template layout utama aplikasi dan navigasi sidebar[cite: 1] |
| `routes/web.php` | Registrasi seluruh endpoint route aplikasi dan proteksi middleware admin[cite: 1] |
| `tests/` | Pengujian otomatis (*Unit & Feature tests*) untuk autentikasi dan alokasi transaksi stok[cite: 1] |

---

## 4. Cara Login & Operasional
1. **Login**: Akses URL aplikasi, masukkan email dan kata sandi admin, lalu klik **Masuk ke Dashboard**.
2. **Tambah Konser**: Buka menu **Konser** > **+ Tambah Konser Baru**, isi detail konser dan unggah poster, lalu simpan.
3. **Tambah Kategori & Stok Tiket**: Buka menu **Kategori & Stok Tiket** > **+ Tambah Kategori Tiket**, pilih konser, tentukan nama kategori, harga, dan alokasi kapasitas awal.
4. **Kelola Pesanan**: Buka menu **Pesanan**, periksa detail invoice, dan ubah status menjadi **Dibayar** atau **Dibatalkan**.

---

## 5. Teknologi yang Digunakan
- **Backend Framework**: Laravel 11.x / 12.x (PHP 8.2+)[cite: 1]
- **Database Utama**: MySQL 8.0+
- **Frontend / Template Engine**: Laravel Blade, HTML5, CSS, dan Vanilla JavaScript[cite: 1]

---

## 6. Lisensi & Hak Cipta
Hak Cipta © 2026 Atta Alfarizi. Seluruh hak cipta dilindungi undang-undang.
