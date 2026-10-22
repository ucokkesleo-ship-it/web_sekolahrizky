# Web Sekolah Rizky

Website sekolah ini dibuat dengan Laravel 12. Halaman beranda saat ini berupa tampilan statis, sehingga bisa dipublikasikan gratis melalui GitHub Pages tanpa kartu kredit.

## Menjalankan secara lokal

1. Jalankan `composer install`.
2. Salin `.env.example` menjadi `.env`.
3. Jalankan `php artisan key:generate`.
4. Jalankan `php artisan serve`, lalu buka alamat lokal yang ditampilkan.

## Deploy gratis ke GitHub Pages

Workflow `.github/workflows/deploy-pages.yml` membangun halaman statis dari tampilan beranda dan menerbitkannya setiap kali ada perubahan di branch `main`.

Untuk mengaktifkan deployment pertama kali:

1. Buka **Settings > Pages** pada repository GitHub.
2. Pada bagian **Build and deployment**, pilih **GitHub Actions** sebagai source.
3. Tunggu workflow **Deploy to GitHub Pages** selesai dengan status berhasil pada tab **Actions**.
4. Buka `https://ucokkesleo-ship-it.github.io/web_sekolahrizky/`.

Halaman GitHub Pages ini hanya menayangkan tampilan statis. Route dinamis Laravel, PHP, database, dan pengiriman formulir tidak dijalankan di GitHub Pages.
