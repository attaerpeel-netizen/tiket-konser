# Panduan Pemasangan & Konfigurasi Teknis - PunkTicket Admin

Dokumen ini memuat petunjuk teknis lengkap untuk mengunduh, mengonfigurasi, dan menjalankan proyek **PunkTicket Admin** di lingkungan lokal Anda menggunakan **PHP**, **Composer**, dan **Database MySQL**.

---

## 1. Kebutuhan Sistem
Pastikan komputer atau server lokal Anda telah terpasang:
- **PHP** versi 8.2 atau lebih baru (dengan ekstensi: `pdo_mysql`, `mbstring`, `openssl`, `bcmath`, `curl`, `tokenizer`, `xml`).
- **Composer** versi 2.x.
- **MySQL Database Server** versi 8.0+ atau MariaDB 10.4+.
- **Node.js & NPM** (opsional untuk memproses aset CSS/Tailwind jika ingin memodifikasi tampilan).

---

## 2. Langkah-Langkah Instalasi

### Langkah 1: Ekstrak Berkas Proyek
Ekstrak berkas `PunkTicket.zip` ke direktori kerja web server lokal Anda (misalnya di `htdocs`, `www`, atau direktori proyek lokal).

```bash
# Masuk ke direktori hasil ekstrak
cd PunkTicket
```

---

### Langkah 2: Pasang Ketergantungan (*Dependencies*) via Composer
Jalankan perintah berikut di terminal untuk memasang paket framework Laravel:

```bash
composer install
```

---

### Langkah 3: Konfigurasi Lingkungan (*Environment File*)
Salin berkas contoh konfigurasi `.env.example` menjadi `.env`:

```bash
cp .env.example .env
```

Buka berkas `.env` menggunakan teks editor, lalu sesuaikan konfigurasi koneksi database MySQL Anda:

```ini
APP_NAME="PunkTicket Admin"
APP_ENV=local
APP_KEY=
APP_DEBUG=true
APP_URL=http://localhost:8000

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=punk_ticket_db
DB_USERNAME=root
DB_PASSWORD=
```

> **Catatan Penting**: Buatlah database baru di MySQL dengan nama yang sesuai (misalnya `punk_ticket_db`) melalui phpMyAdmin, MySQL Workbench, atau terminal MySQL:
> ```sql
> CREATE DATABASE punk_ticket_db CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
> ```

---

### Langkah 4: Generate Kunci Aplikasi (Application Key)
Jalankan perintah Artisan untuk membuat enkripsi key unik Laravel:

```bash
php artisan key:generate
```

---

### Langkah 5: Buat Tautan Penyimpanan Berkas (*Storage Symlink*)
Untuk memungkinkan akses publik terhadap poster konser yang diunggah:

```bash
php artisan storage:link
```

---

### Langkah 6: Jalankan Migrasi Database & Seeder Data Demo
Jalankan migrasi skema tabel MySQL dan isi dengan data simulasi konser pop punk Indonesia:

```bash
php artisan migrate:fresh --seed
```

Perintah di atas akan secara otomatis membuat tabel:
1. `users` (admin & pelanggan)
2. `concerts` (daftar konser pop punk)
3. `ticket_categories` (kategori presale, regular, VIP beserta kuota)
4. `orders` (transaksi pemesanan dengan status beragam)
5. `order_items` (rincian item tiket per pesanan)

---

## 3. Kredensial Akun Administrator Awal
Setelah proses seeding berhasil, gunakan akun berikut untuk masuk ke dashboard:

- **URL Login**: `http://localhost:8000/login`
- **Alamat Email**: `admin@punkticket.id` (atau `attaerpeel@gmail.com`)
- **Kata Sandi**: `punkrock2026`

> *Sangat disarankan untuk memperbarui kata sandi ini melalui menu **Profil Admin** setelah pertama kali berhasil masuk ke sistem.*

---

## 4. Menjalankan Server Pengembangan Lokal
Jalankan perintah berikut untuk menyalakan server bawaan Laravel:

```bash
php artisan serve
```

Buka browser dan buka alamat:
`http://localhost:8000`

---

## 5. Menjalankan Pengujian Otomatis (*Automated Testing*)
Proyek ini dilengkapi dengan unit dan feature test otomatis untuk memverifikasi autentikasi, hak akses, validasi formulir, serta integritas transaksi stok tiket:

```bash
php artisan test
```
atau jika menggunakan PHPUnit langsung:
```bash
./vendor/bin/phpunit
```
