# 🎉 Event Management System (Laravel + Filament + Bootstrap 5)

Sistem manajemen event berbasis Laravel, lengkap dengan:
- Registrasi online
- Notifikasi email otomatis
- Absensi QR Code
- Custom event
- Admin panel dengan Filament
- Halaman publik dengan Bootstrap 5

---

## 🚀 Fitur Utama

### 🧑‍💻 Frontend (Bootstrap 5)
- Landing page event (judul, tanggal, lokasi, deskripsi)
- Form registrasi online
- Halaman tiket (menampilkan QR unik)
- Countdown event
- Galeri & sponsor (optional)
- Responsif dan mobile friendly

### ⚙️ Backend Admin (Filament)
- CRUD event (judul, deskripsi, tanggal, lokasi, gambar)
- CRUD peserta (lihat daftar, ubah status kehadiran, ekspor data)
- Scan QR untuk kehadiran (absensi realtime)
- Template email registrasi & reminder
- Role management (Admin / Panitia)

### ✉️ Notifikasi Email
- Email konfirmasi setelah registrasi
- Reminder H-1 event (via scheduler)
- Opsi kirim ulang email
- Template dinamis per event

### 🧾 QR Code Attendance
- QR unik per peserta
- Halaman scan untuk admin / panitia
- Absensi realtime dan status "Hadir / Belum Hadir"
- Riwayat waktu hadir
- Export Excel daftar hadir

### 🔧 Event Customization
- Event bisa diaktifkan / dinonaktifkan
- Mendukung banyak event aktif sekaligus
- Form registrasi bisa disesuaikan per event (opsional)
- Kategori tiket dan kapasitas (opsional)