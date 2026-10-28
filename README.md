<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

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

## 3. Teknologi yang Digunakan
- **Backend Framework**: Laravel 11.x / 12.x (PHP 8.2+)
- **Database Utama**: MySQL 8.0+
- **Template Engine**: Laravel Blade dengan HTML5 & Vanilla JavaScript

---

## 4. Cara Login Sebagai Administrator
1. Buka peramban (*web browser*) dan arahkan ke alamat URL aplikasi Anda.
2. Halaman pertama yang muncul adalah formulir login administrator.
3. Masukkan alamat email admin dan kata sandi yang telah disiapkan secara terpisah oleh pengelola sistem (silakan merujuk ke dokumen teknis `SETUP.md` untuk informasi kredensial awal hasil seeder).
4. Klik tombol **Masuk ke Dashboard**.
5. Jika kredensial cocok, Anda akan diarahkan langsung ke halaman ringkasan Dashboard. Jika salah, sistem akan menampilkan pesan peringatan yang jelas.

---

## 5. Cara Menggunakan Dashboard
- **Memantau Kartu Metrik**: Di bagian paling atas dashboard, terdapat 8 kartu indikator kinerja utama. Setiap angka dihitung secara langsung dari database saat halaman dimuat.
- **Melihat Grafik Penjualan**: Grafik batang menampilkan perbandingan akumulasi tiket terjual pada setiap konser aktif.
- **Tabel Ringkasan Cepat**: Di bagian bawah dashboard terdapat dua tabel cepat: Konser Terbaru dan Pesanan Terbaru untuk pemantauan operasional harian.

---

## 6. Cara Menambahkan & Mengedit Konser
### Menambahkan Konser Baru:
1. Klik menu **Konser** pada bilah navigasi samping (*sidebar*).
2. Klik tombol **+ Tambah Konser Baru** di pojok kanan atas.
3. Isi kolom:
   - **Nama Konser**: Masukkan judul acara musik.
   - **Lineup Artis / Band**: Masukkan band pengisi acara (pisahkan dengan koma, contoh: *Pee Wee Gaskins, Rocket Rockers, Closehead*).
   - **Tanggal & Waktu Acara**: Tentukan jadwal mulai konser.
   - **Lokasi Acara**: Tulis nama venue atau stadion dan kota.
   - **Deskripsi Acara**: Tuliskan pengantar singkat, aturan venue, atau pesan promotor.
   - **Poster Acara**: Unggah berkas gambar poster konser (format JPG, PNG, atau WebP).
   - **Status Konser**: Pilih status (*Draft*, *Akan Datang*, *Berlangsung*, atau *Selesai*).
4. Klik tombol **Simpan Konser**.

### Mengedit Konser:
1. Pada tabel daftar konser, klik tombol ikon pensil (**Edit**) pada baris konser yang ingin diperbarui.
2. Lakukan perubahan data yang diperlukan.
3. Klik tombol **Perbarui Konser**.

---

## 7. Cara Mengelola Kategori & Stok Tiket
1. Klik menu **Kategori & Stok Tiket** pada sidebar.
2. Halaman ini menampilkan seluruh tiket yang dikelompokkan berdasarkan nama konser.
3. Untuk menambahkan kategori baru pada konser tertentu:
   - Klik tombol **+ Tambah Kategori Tiket**.
   - Pilih konser tujuan.
   - Isi nama kategori (contoh: *Presale 1*, *Regular*, atau *VIP Soundcheck*).
   - Masukkan harga tiket dalam Rupiah (tidak boleh bernilai negatif).
   - Masukkan kapasitas awal jumlah lembar tiket yang dialokasikan.
   - Klik **Simpan Kategori**.
4. **Pembaruan Kapasitas**: Anda dapat menambah atau mengurangi kapasitas awal selama kapasitas baru tidak lebih kecil dari jumlah tiket yang sudah dipesan/terjual.

---

## 8. Aturan Baku Pengelolaan Stok Tiket
Sistem menerapkan aturan ketat untuk menjaga integritas transaksi promotor:
1. **Perhitungan Stok Tunggal**:  
   $$\text{Stok Tersedia} = \text{Kapasitas Awal} - \text{Tiket Terjual}$$
2. **Kapasitas Non-Negatif**: Nilai kapasitas awal dan harga tiket tidak boleh di bawah angka 0.
3. **Pencegahan Overselling**: Pesanan baru akan ditolak seketika oleh sistem jika kuantitas yang diminta melebihi sisa stok tiket tersedia.
4. **Penguncian Baris Database (*Row Locking*)**: Setiap perubahan status pesanan dijalankan di dalam blok transaksi database (`DB::transaction`) dengan metode `lockForUpdate()` guna mencegah kondisi balapan (*race condition*) apabila dua pelanggan bertransaksi bersamaan.
5. **Dampak Perubahan Status Pesanan Terhadap Stok**:
   - Status **Menunggu Pembayaran** atau **Dibayar**: Kuota tiket dialokasikan (tiket terjual bertambah).
   - Status diubah menjadi **Dibatalkan**: Kuota tiket segera dikembalikan ke stok tersedia (tiket terjual berkurang).
   - Pesanan yang berstatus **Dibatalkan** hanya dapat diaktifkan kembali jika sisa kuota tiket masih mencukupi.

---

## 9. Cara Mengelola Pengguna & Pelanggan
1. Klik menu **Pengguna** pada sidebar.
2. Anda dapat melihat daftar seluruh akun pelanggan terdaftar dan staf admin.
3. Untuk mendaftarkan akun baru secara manual, klik **+ Tambah Pengguna**, lengkapi nama, email, nomor telepon, dan tentukan kata sandi awal.
4. **Keamanan Akun Admin**: Sistem secara otomatis mengunci akun admin utama dari tombol hapus guna mencegah terputusnya akses kendali promotor.

---

## 10. Cara Melihat & Mengelola Pesanan Tiket
1. Klik menu **Pesanan** pada sidebar.
2. Gunakan kolom pencarian untuk melacak pesanan berdasarkan kode pesanan, nama pemesan, atau nama konser.
3. Gunakan filter dropdown untuk menyaring status: *Semua*, *Menunggu Pembayaran*, *Dibayar*, atau *Dibatalkan*.
4. Klik tombol **Lihat Detail** pada pesanan yang ingin diperiksa.
5. Pada panel detail pesanan:
   - Admin dapat memverifikasi bukti transfer atau konfirmasi kasir.
   - Ubah status pesanan menjadi **Dibayar** setelah dana masuk.
   - Jika pembayaran melewati batas waktu yang ditentukan, admin dapat mengubah status menjadi **Dibatalkan** sehingga kuota tiket kembali tersedia bagi pembeli lain.

---

## 11. Penjelasan Navigasi Bilah Samping (Sidebar)
- **Dashboard**: Ringkasan visual metrik penjualan dan aktivitas terkini.
- **Konser**: Pengelolaan jadwal, poster, dan lineup konser pop punk.
- **Kategori & Stok Tiket**: Pengendalian kuota, batas kapasitas, dan harga tiket.
- **Pesanan**: Daftar invoice transaksi dan pembaruan status pembayaran.
- **Pengguna**: Basis data pelanggan konser dan akun promotor.
- **Profil Admin**: Informasi akun administrator yang sedang bertugas.
- **Keluar (Logout)**: Mengakhiri sesi administrasi secara aman.

---
*Untuk panduan teknis pemasangan server lokal, konfigurasi database MySQL, dan eksekusi seeder, silakan buka berkas terpisah: `SETUP.md`.*
