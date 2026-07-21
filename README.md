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
