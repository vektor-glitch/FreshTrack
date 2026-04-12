# FreshTrack

Web manajemen inventaris rumah tangga yang dirancang khusus untuk menekan angka food waste (sampah makanan) di tingkat keluarga. Sistem ini memungkinkan pengguna untuk mendigitalisasi isi dapur dengan mencatat tanggal kedaluwarsa setiap bahan makanan, sehingga durasi kesegarannya dapat terpantau secara sistematis. Selain itu, tersedia fitur pengingat (reminder) berupa notifikasi yang membantu pengguna mengantisipasi masa kadaluarsa bahan makanan

# TARGET USER

1. Ibu rumah tangga yang menyimpan bahan makanan di kulkas atau di lemari
2. Anak kos yang menyimpan bahan makanan di kulkas kostnya
   Penjual bahan makanan yang menyimpan barang dagangannya

# Gambaran Project

1. Project berbasis website
2. Project dibuat dengan:
   - Frontend dengan HTML CSS
   - Backend dengan JavaScript PHP
   - Database dengan MySQL
   - Deploy dengan Vercel
3. Bentuk website seperti dashboard admin
4. ada navbar dan sidebar
5. navbar dapat berisi komponen seperti search, icon lonceng untuk notifikasi, profile, dll
6. sidebar dapat berisi menu dan sub menu
7. Pengguna website ada 1 role : user

# Kebutuhan User Website FreshTrack

1. Authentikasi
   - User bisa melakukan registrasi akun baru (Sign Up).
   - User bisa login menggunakan email dan password.
   - User bisa logout dari sistem (via ikon garis 3 di sidebar).
2. Menu Dashboard
   - User dapat melihat kartu ringkasan status bahan makanan (Aman/Hijau, Mendekati Batas/Kuning, Kritis/Merah).
   - User dapat melihat list prioritas bahan makanan yang harus segera digunakan berdasarkan tanggal kedaluwarsa terdekat.
3. Menu Bahan Makanan (Inventaris)
   - User dapat melihat daftar bahan makanan yang dikelompokkan berdasarkan kategori (Sayur, Minuman, Buah-buahan, Daging, Bumbu, dll).
   - User dapat menambahkan bahan makanan baru (input nama, kategori, dan tanggal kedaluwarsa).
   - User dapat mengedit informasi bahan makanan jika ada kesalahan input.
   - User dapat menghapus bahan makanan dari daftar.
   - User dapat memperbarui status bahan makanan dengan 1 klik (mengubah dari "Tersedia" menjadi "Sudah Dimasak" atau "Terpaksa Dibuang").
4. Menu Pengaturan Notifikasi
   - User dapat mengatur dan menyimpan preferensi waktu pengingat kedaluwarsa (pilihan H-1, H-3, atau H-7).
   - User dapat melihat notifikasi peringatan (alert banner) di area Dashboard untuk bahan yang sudah masuk masa kritis.
5. Menu Resep Dadakan
   - User dapat melihat daftar artikel resep masakan sederhana.
   - User dapat membaca detail resep untuk mengolah bahan makanan sisa dengan waktu pembuatan yang singkat.

# Features

1. Manajemen Inventaris Dapur
   - Pengguna dapat melihat, menambahkan, mengedit, dan menghapus (CRUD) data bahan makanan.
   - Pengguna dapat mengklasifikasikan bahan makanan berdasarkan kategori penyimpanannya.
   - Pengguna dapat mengubah status operasional bahan makanan (Dimasak/Dibuang).
2. Sistem Peringatan (Expiry Reminder)
   - Sistem dapat mendeteksi rentang waktu antara hari ini dengan tanggal kedaluwarsa bahan makanan.
   - Sistem dapat memunculkan peringatan otomatis sesuai dengan pengaturan preferensi pengguna (H-1, H-3, H-7).
3. Edukasi & Inspirasi Masak
   - Pengguna dapat membaca kumpulan resep dadakan untuk menyelamatkan bahan makanan yang hampir kadaluarsa.
4. Tracking Food Waste (Reporting Sederhana)
   - Pengguna dapat melihat jumlah bahan makanan yang berhasil diselamatkan (Sudah Dimasak) versus bahan yang membusuk (Dibuang) sebagai tolok ukur penghematan.
