# EduWeb Studio — Laravel

Landing page jasa website sekolah yang sudah dinamis, dilengkapi dashboard admin untuk mengelola seluruh konten utama dan pesan konsultasi.

## Menjalankan aplikasi

```bash
composer install
copy .env.example .env
php artisan key:generate
php artisan migrate --seed
php artisan serve
```

Aplikasi saat ini menggunakan SQLite (`database/database.sqlite`) agar langsung dapat dijalankan. Buka `http://127.0.0.1:8000` dan dashboard di `http://127.0.0.1:8000/admin`.

## Login awal

- Email: `admin@eduweb.test`
- Password: `admin12345`

Segera ubah akun/password sebelum dipasang ke server produksi.

## Modul dashboard

- Ringkasan konten dan pesan baru
- CRUD Layanan, Portofolio, Keunggulan, Proses Kerja, Paket Harga, Testimoni, dan FAQ
- Aktivasi/nonaktivasi serta pengurutan konten
- Pengaturan brand, hero, CTA, WhatsApp, email, dan alamat
- Kotak masuk permintaan konsultasi

File `landing-page-original.html` adalah arsip landing page statis sebelum migrasi.

## Deployment Railway

Gunakan database PostgreSQL/MySQL terpisah untuk data dashboard. Jangan gunakan SQLite produksi karena filesystem container Railway tidak persisten.

Variable minimum pada service aplikasi:

```env
APP_ENV=production
APP_DEBUG=false
APP_URL=https://domain-anda.com
APP_KEY=base64:...
DB_CONNECTION=pgsql
DATABASE_URL=${{Postgres.DATABASE_URL}}
FILESYSTEM_DISK=public
```

Untuk menjaga gambar hasil upload setelah restart/redeploy, tambahkan Railway Volume dengan mount path:

```text
/var/www/html/storage/app/public
```

Dockerfile otomatis menjalankan `storage:link` dan `migrate --force` ketika service dimulai.
