# Blog App (Laravel 12 + Filament 4)

Aplikasi blog/portal berita berbasis Laravel dengan halaman publik dan panel admin Filament.

## Fitur Utama

- Halaman publik:
  - Landing page
  - Daftar berita
  - Detail berita
  - Daftar kategori dan berita per kategori
  - Halaman tentang kami
- Panel admin (`/admin`) untuk kelola:
  - Artikel/pos
  - Kategori
- Statistik ringkas di dashboard admin
- Sanitasi konten HTML artikel sebelum dirender

## Tech Stack

- PHP 8.2+
- Laravel 12
- Filament 4
- MySQL
- Vite + Tailwind CSS

## Prasyarat

Pastikan sudah terpasang:

- PHP >= 8.2
- Composer >= 2
- Node.js >= 20 dan npm

## Instalasi dari Git Clone

1. Clone repository lalu masuk ke folder project.

```bash
git clone <URL_GITHUB_REPO>.git
cd blog
```

2. Install dependency backend dan frontend.

```bash
composer install
npm install
```

3. Buat file `.env` dari template.

Linux/macOS:

```bash
cp .env.example .env
```

Windows PowerShell:

```powershell
Copy-Item .env.example .env
```

4. Buat database MySQL, misalnya `blog`.

Contoh via MySQL CLI:

```bash
mysql -u root -p -e "CREATE DATABASE blog CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;"
```

5. Atur koneksi database di `.env`:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=blog
DB_USERNAME=root
DB_PASSWORD=
```

6. Generate app key, jalankan migrasi, seed data awal, dan buat symlink storage.

```bash
php artisan key:generate
php artisan migrate
php artisan db:seed
php artisan storage:link
```

7. Jalankan mode development (server + queue + vite).

```bash
composer run dev
```

8. Buka aplikasi:

- Frontend: `http://127.0.0.1:8000`
- Admin: `http://127.0.0.1:8000/admin`

## Akun Default

Setelah `php artisan db:seed`, akun berikut tersedia:

- Admin: `admin@blog.test` / `password`
- Penulis: `penulis@blog.test` / `password`

Disarankan langsung ganti password setelah login pertama.

## Alternatif Setup Cepat

Bisa juga pakai script bawaan:

```bash
composer run setup
```

Script ini menjalankan:

- `composer install`
- copy `.env` jika belum ada
- `php artisan key:generate`
- `php artisan migrate --force`
- `npm install`
- `npm run build`

Catatan: script `setup` tidak menjalankan `db:seed` dan `storage:link`, jadi jalankan manual jika dibutuhkan.

## Menjalankan Test

```bash
composer test
```

## Lisensi

Project ini menggunakan lisensi MIT.
