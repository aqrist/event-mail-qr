@extends('layouts.app')

@section('title', 'Tutorial Sistem Event Management')

@section('content')
<div class="container my-5">
    <div class="row">
        <div class="col-md-12">
            <div class="text-center mb-5">
                <h1 class="display-4 text-primary">📚 Tutorial Lengkap</h1>
                <p class="lead">Panduan menggunakan sistem Event Management dari A sampai Z</p>
            </div>

            <!-- Navigation Tabs -->
            <ul class="nav nav-pills nav-justified mb-4" id="tutorialTabs" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="admin-tab" data-bs-toggle="pill" data-bs-target="#admin" type="button" role="tab" aria-controls="admin" aria-selected="true">
                        👨‍💼 Tutorial Admin
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="user-tab" data-bs-toggle="pill" data-bs-target="#user" type="button" role="tab" aria-controls="user" aria-selected="false">
                        👤 Tutorial Pengguna
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="qr-tab" data-bs-toggle="pill" data-bs-target="#qr" type="button" role="tab" aria-controls="qr" aria-selected="false">
                        📱 Tutorial QR Code
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="scanner-tab" data-bs-toggle="pill" data-bs-target="#scanner" type="button" role="tab" aria-controls="scanner" aria-selected="false">
                        📷 Tutorial Scanner
                    </button>
                </li>
            </ul>

            <!-- Tab Content -->
            <div class="tab-content" id="tutorialTabsContent">
                
                <!-- ADMIN TUTORIAL -->
                <div class="tab-pane fade show active" id="admin" role="tabpanel">
                    <div class="card shadow">
                        <div class="card-header bg-primary text-white">
                            <h3 class="mb-0">👨‍💼 Tutorial Admin Panel</h3>
                        </div>
                        <div class="card-body">
                            
                            <!-- Step 1: Login -->
                            <div class="mb-5">
                                <h4 class="text-primary mb-3">
                                    <span class="badge bg-primary me-2">1</span>
                                    Login ke Admin Panel
                                </h4>
                                <ol class="list-group list-group-numbered">
                                    <li class="list-group-item">
                                        Buka browser dan kunjungi: <code>{{ url('/admin') }}</code>
                                    </li>
                                    <li class="list-group-item">
                                        Masukkan email dan password admin
                                    </li>
                                    <li class="list-group-item">
                                        Klik tombol <strong>"Sign in"</strong>
                                    </li>
                                </ol>
                                <div class="alert alert-info mt-3">
                                    <strong>💡 Tips:</strong> Jika lupa password, hubungi developer untuk reset password.
                                </div>
                            </div>

                                <!-- Step 2: Create Event -->
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingTwo">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#step2" aria-expanded="false" aria-controls="step2">
                                            <span class="badge bg-primary me-2">2</span>
                                            Membuat Event Baru
                                        </button>
                                    </h2>
                                    <div id="step2" class="accordion-collapse collapse" data-bs-parent="#adminAccordion" aria-labelledby="headingTwo">
                                        <div class="accordion-body">
                                            <ol class="list-group list-group-numbered">
                                                <li class="list-group-item">
                                                    Di dashboard admin, klik menu <strong>"Events"</strong>
                                                </li>
                                                <li class="list-group-item">
                                                    Klik tombol <strong>"New Event"</strong>
                                                </li>
                                                <li class="list-group-item">
                                                    Isi form dengan lengkap:
                                                    <ul class="mt-2">
                                                        <li><strong>Title:</strong> Nama event</li>
                                                        <li><strong>Description:</strong> Deskripsi event</li>
                                                        <li><strong>Start Date:</strong> Tanggal & waktu mulai</li>
                                                        <li><strong>End Date:</strong> Tanggal & waktu selesai</li>
                                                        <li><strong>Location:</strong> Lokasi event</li>
                                                        <li><strong>Capacity:</strong> Maksimal peserta</li>
                                                        <li><strong>Registration Deadline:</strong> Batas pendaftaran</li>
                                                    </ul>
                                                </li>
                                                <li class="list-group-item">
                                                    Klik <strong>"Create"</strong> untuk menyimpan
                                                </li>
                                            </ol>
                                            <div class="alert alert-warning mt-3">
                                                <strong>⚠️ Penting:</strong> Pastikan semua field diisi dengan benar, terutama tanggal dan waktu.
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Step 3: Manage Participants -->
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingThree">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#step3" aria-expanded="false" aria-controls="step3">
                                            <span class="badge bg-primary me-2">3</span>
                                            Mengelola Peserta
                                        </button>
                                    </h2>
                                    <div id="step3" class="accordion-collapse collapse" data-bs-parent="#adminAccordion" aria-labelledby="headingThree">
                                        <div class="accordion-body">
                                            <h5>📋 Melihat Daftar Peserta:</h5>
                                            <ol class="list-group list-group-numbered mb-3">
                                                <li class="list-group-item">Klik menu <strong>"Participants"</strong></li>
                                                <li class="list-group-item">Anda akan melihat tabel semua peserta terdaftar</li>
                                                <li class="list-group-item">Filter berdasarkan event atau status kehadiran</li>
                                            </ol>

                                            <h5>📧 Kirim Ulang Email:</h5>
                                            <ol class="list-group list-group-numbered mb-3">
                                                <li class="list-group-item">Di tabel peserta, klik tombol <strong>"Kirim Ulang Email"</strong> (ikon amplop)</li>
                                                <li class="list-group-item">Konfirmasi pengiriman di modal yang muncul</li>
                                                <li class="list-group-item">Email konfirmasi akan dikirim ulang ke peserta</li>
                                            </ol>

                                            <h5>📊 Export Data:</h5>
                                            <ol class="list-group list-group-numbered">
                                                <li class="list-group-item">Pilih peserta yang ingin di-export (centang checkbox)</li>
                                                <li class="list-group-item">Klik dropdown "Bulk Actions"</li>
                                                <li class="list-group-item">Pilih "Export" untuk download file Excel</li>
                                            </ol>
                                        </div>
                                    </div>
                                </div>

                                <!-- Step 4: QR Scanning -->
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingFour">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#step4" aria-expanded="false" aria-controls="step4">
                                            <span class="badge bg-primary me-2">4</span>
                                            Scan QR Code Peserta
                                        </button>
                                    </h2>
                                    <div id="step4" class="accordion-collapse collapse" data-bs-parent="#adminAccordion" aria-labelledby="headingFour">
                                        <div class="accordion-body">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <h5>📱 Cara Scan QR:</h5>
                                                    <ol class="list-group list-group-numbered">
                                                        <li class="list-group-item">Buka aplikasi QR scanner di smartphone</li>
                                                        <li class="list-group-item">Arahkan kamera ke QR code peserta</li>
                                                        <li class="list-group-item">Buka link yang muncul</li>
                                                        <li class="list-group-item">Status kehadiran otomatis tercatat</li>
                                                    </ol>
                                                </div>
                                                <div class="col-md-6">
                                                    <h5>✅ Manual Check-in:</h5>
                                                    <ol class="list-group list-group-numbered">
                                                        <li class="list-group-item">Buka menu "Participants" di admin</li>
                                                        <li class="list-group-item">Cari nama peserta</li>
                                                        <li class="list-group-item">Klik tombol "Edit"</li>
                                                        <li class="list-group-item">Centang "Is Attended" dan simpan</li>
                                                    </ol>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- USER TUTORIAL -->
                <div class="tab-pane fade" id="user" role="tabpanel">
                    <div class="card shadow">
                        <div class="card-header bg-success text-white">
                            <h3 class="mb-0">👤 Tutorial Pengguna</h3>
                        </div>
                        <div class="card-body">
                            
                            <div class="accordion" id="userAccordion">
                                <!-- Step 1: Browse Events -->
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="userHeadingOne">
                                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#user-step1" aria-expanded="true" aria-controls="user-step1">
                                            <span class="badge bg-success me-2">1</span>
                                            Melihat Daftar Event
                                        </button>
                                    </h2>
                                    <div id="user-step1" class="accordion-collapse collapse show" data-bs-parent="#userAccordion" aria-labelledby="userHeadingOne">
                                        <div class="accordion-body">
                                            <ol class="list-group list-group-numbered">
                                                <li class="list-group-item">
                                                    Buka halaman utama: <code>{{ url('/') }}</code>
                                                </li>
                                                <li class="list-group-item">
                                                    Lihat daftar event yang tersedia
                                                </li>
                                                <li class="list-group-item">
                                                    Klik <strong>"Lihat Detail"</strong> pada event yang diminati
                                                </li>
                                            </ol>
                                            <div class="alert alert-info mt-3">
                                                <strong>💡 Tips:</strong> Event yang sudah penuh atau lewat deadline tidak bisa didaftar.
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Step 2: Register -->
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="userHeadingTwo">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#user-step2" aria-expanded="false" aria-controls="user-step2">
                                            <span class="badge bg-success me-2">2</span>
                                            Mendaftar Event
                                        </button>
                                    </h2>
                                    <div id="user-step2" class="accordion-collapse collapse" data-bs-parent="#userAccordion" aria-labelledby="userHeadingTwo">
                                        <div class="accordion-body">
                                            <ol class="list-group list-group-numbered">
                                                <li class="list-group-item">
                                                    Di halaman detail event, klik <strong>"Daftar Sekarang"</strong>
                                                </li>
                                                <li class="list-group-item">
                                                    Isi form pendaftaran dengan lengkap:
                                                    <ul class="mt-2">
                                                        <li><strong>Nama Lengkap:</strong> Sesuai KTP/identitas</li>
                                                        <li><strong>Email:</strong> Email aktif untuk konfirmasi</li>
                                                        <li><strong>Nomor Telepon:</strong> Yang bisa dihubungi</li>
                                                        <li><strong>Custom Fields:</strong> Isi sesuai kebutuhan event</li>
                                                    </ul>
                                                </li>
                                                <li class="list-group-item">
                                                    Klik <strong>"Daftar"</strong> untuk mengirim pendaftaran
                                                </li>
                                            </ol>
                                            <div class="alert alert-success mt-3">
                                                <strong>✅ Berhasil:</strong> Anda akan menerima email konfirmasi dengan tiket QR code.
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Step 3: Email Confirmation -->
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="userHeadingThree">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#user-step3" aria-expanded="false" aria-controls="user-step3">
                                            <span class="badge bg-success me-2">3</span>
                                            Email Konfirmasi & Tiket
                                        </button>
                                    </h2>
                                    <div id="user-step3" class="accordion-collapse collapse" data-bs-parent="#userAccordion" aria-labelledby="userHeadingThree">
                                        <div class="accordion-body">
                                            <h5>📧 Email Konfirmasi:</h5>
                                            <ol class="list-group list-group-numbered mb-3">
                                                <li class="list-group-item">Cek inbox email Anda</li>
                                                <li class="list-group-item">Buka email dengan subjek "Pendaftaran Dikonfirmasi"</li>
                                                <li class="list-group-item">Email berisi detail event dan link tiket</li>
                                            </ol>

                                            <h5>🎫 Tiket Digital:</h5>
                                            <ol class="list-group list-group-numbered mb-3">
                                                <li class="list-group-item">Klik tombol <strong>"Lihat Tiket Anda"</strong> di email</li>
                                                <li class="list-group-item">Simpan halaman tiket atau screenshot QR code</li>
                                                <li class="list-group-item">Pastikan QR code terlihat jelas</li>
                                            </ol>

                                            <h5>🔔 Email Pengingat:</h5>
                                            <ol class="list-group list-group-numbered">
                                                <li class="list-group-item">24 jam sebelum event, Anda akan menerima email pengingat</li>
                                                <li class="list-group-item">Email berisi detail event dan reminder penting</li>
                                                <li class="list-group-item">Siapkan tiket QR code Anda</li>
                                            </ol>
                                        </div>
                                    </div>
                                </div>

                                <!-- Step 4: Attend Event -->
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="userHeadingFour">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#user-step4" aria-expanded="false" aria-controls="user-step4">
                                            <span class="badge bg-success me-2">4</span>
                                            Menghadiri Event
                                        </button>
                                    </h2>
                                    <div id="user-step4" class="accordion-collapse collapse" data-bs-parent="#userAccordion" aria-labelledby="userHeadingFour">
                                        <div class="accordion-body">
                                            <h5>📍 Persiapan:</h5>
                                            <ul class="list-group mb-3">
                                                <li class="list-group-item">✅ Tiba 15 menit sebelum event dimulai</li>
                                                <li class="list-group-item">✅ Bawa smartphone dengan tiket QR code</li>
                                                <li class="list-group-item">✅ Atau cetak tiket jika diperlukan</li>
                                                <li class="list-group-item">✅ Bawa identitas diri (KTP/SIM)</li>
                                            </ul>

                                            <h5>🎫 Check-in:</h5>
                                            <ol class="list-group list-group-numbered">
                                                <li class="list-group-item">Cari meja registrasi/check-in</li>
                                                <li class="list-group-item">Tunjukkan QR code pada petugas</li>
                                                <li class="list-group-item">Petugas akan scan QR code Anda</li>
                                                <li class="list-group-item">Terima name tag/materials jika ada</li>
                                            </ol>

                                            <div class="alert alert-warning mt-3">
                                                <strong>⚠️ Perhatian:</strong> QR code hanya bisa di-scan sekali. Jika ada masalah, hubungi petugas.
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- QR CODE TUTORIAL -->
                <div class="tab-pane fade" id="qr" role="tabpanel">
                    <div class="card shadow">
                        <div class="card-header bg-info text-white">
                            <h3 class="mb-0">📱 Tutorial QR Code</h3>
                        </div>
                        <div class="card-body">
                            
                            <div class="row">
                                <div class="col-md-6">
                                    <h4>🎫 Untuk Peserta</h4>
                                    <div class="card mb-3">
                                        <div class="card-body">
                                            <h5>Cara Mendapatkan QR Code:</h5>
                                            <ol class="list-group list-group-numbered">
                                                <li class="list-group-item">Daftar event melalui website</li>
                                                <li class="list-group-item">Cek email konfirmasi</li>
                                                <li class="list-group-item">Klik "Lihat Tiket Anda"</li>
                                                <li class="list-group-item">Screenshot atau cetak QR code</li>
                                            </ol>

                                            <h5 class="mt-3">Tips Menggunakan QR Code:</h5>
                                            <ul class="list-group">
                                                <li class="list-group-item">✅ Pastikan QR code terlihat jelas</li>
                                                <li class="list-group-item">✅ Brightness layar maksimal saat di-scan</li>
                                                <li class="list-group-item">✅ Hindari refleksi cahaya pada layar</li>
                                                <li class="list-group-item">✅ Jaga baterai smartphone tetap cukup</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <h4>👨‍💼 Untuk Admin/Panitia</h4>
                                    <div class="card mb-3">
                                        <div class="card-body">
                                            <h5>Cara Scan QR Code:</h5>
                                            <ol class="list-group list-group-numbered">
                                                <li class="list-group-item">Gunakan aplikasi QR scanner</li>
                                                <li class="list-group-item">Arahkan kamera ke QR code peserta</li>
                                                <li class="list-group-item">Tunggu hingga terdeteksi</li>
                                                <li class="list-group-item">Buka link yang muncul</li>
                                                <li class="list-group-item">Sistem otomatis mencatat kehadiran</li>
                                            </ol>

                                            <h5 class="mt-3">Aplikasi QR Scanner Recommended:</h5>
                                            <ul class="list-group">
                                                <li class="list-group-item">📱 <strong>Android:</strong> QR Code Reader, Barcode Scanner</li>
                                                <li class="list-group-item">📱 <strong>iPhone:</strong> Kamera bawaan iOS, QR Reader</li>
                                                <li class="list-group-item">💻 <strong>Web:</strong> Camera browser (Chrome/Firefox)</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row mt-4">
                                <div class="col-12">
                                    <div class="alert alert-info">
                                        <h5>🔧 Troubleshooting QR Code:</h5>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <h6>Masalah Umum:</h6>
                                                <ul>
                                                    <li>QR code tidak terbaca → Bersihkan layar, atur pencahayaan</li>
                                                    <li>Link tidak bisa dibuka → Periksa koneksi internet</li>
                                                    <li>Sudah ter-scan → QR code hanya bisa digunakan sekali</li>
                                                </ul>
                                            </div>
                                            <div class="col-md-6">
                                                <h6>Solusi:</h6>
                                                <ul>
                                                    <li>Gunakan manual check-in di admin panel</li>
                                                    <li>Hubungi support untuk resend email</li>
                                                    <li>Verifikasi menggunakan nama dan email</li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- SCANNER TUTORIAL -->
                <div class="tab-pane fade" id="scanner" role="tabpanel" aria-labelledby="scanner-tab">
                    <div class="card shadow">
                        <div class="card-header bg-warning text-dark">
                            <h3 class="mb-0">📷 Tutorial QR Scanner</h3>
                        </div>
                        <div class="card-body">
                            
                            <div class="alert alert-info mb-4">
                                <h5>📱 Akses Scanner: <a href="{{ url('/scanner') }}" class="btn btn-primary btn-sm">Buka Scanner</a></h5>
                                <p class="mb-0">Halaman scanner akan otomatis mendeteksi device Anda dan menampilkan interface yang sesuai.</p>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="card mb-4">
                                        <div class="card-header bg-primary text-white">
                                            <h4 class="mb-0">📱 Mobile Scanner</h4>
                                        </div>
                                        <div class="card-body">
                                            <h5>Cara Menggunakan:</h5>
                                            <ol class="list-group list-group-numbered">
                                                <li class="list-group-item">Buka halaman <code>/scanner</code> di smartphone</li>
                                                <li class="list-group-item">Klik tombol <strong>"Mulai Scan"</strong></li>
                                                <li class="list-group-item">Izinkan akses kamera</li>
                                                <li class="list-group-item">Arahkan kamera ke QR code peserta</li>
                                                <li class="list-group-item">Tunggu deteksi otomatis</li>
                                                <li class="list-group-item">Lihat hasil check-in</li>
                                            </ol>

                                            <h5 class="mt-3">Fitur Mobile:</h5>
                                            <ul class="list-group">
                                                <li class="list-group-item">✅ Camera real-time scanner</li>
                                                <li class="list-group-item">✅ Pilihan kamera (depan/belakang)</li>
                                                <li class="list-group-item">✅ Deteksi otomatis QR code</li>
                                                <li class="list-group-item">✅ Status scanning real-time</li>
                                            </ul>

                                            <div class="alert alert-warning mt-3">
                                                <strong>💡 Tips Mobile:</strong>
                                                <ul class="mb-0">
                                                    <li>Pastikan pencahayaan cukup</li>
                                                    <li>Jaga jarak 15-30cm dari QR code</li>
                                                    <li>Gunakan kamera belakang untuk hasil terbaik</li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="card mb-4">
                                        <div class="card-header bg-info text-white">
                                            <h4 class="mb-0">💻 Desktop Scanner</h4>
                                        </div>
                                        <div class="card-body">
                                            <h5>Cara Menggunakan:</h5>
                                            <ol class="list-group list-group-numbered">
                                                <li class="list-group-item">Buka halaman <code>/scanner</code> di komputer</li>
                                                <li class="list-group-item">Ketik/paste QR code di input field</li>
                                                <li class="list-group-item">Atau gunakan barcode scanner USB</li>
                                                <li class="list-group-item">Klik tombol <strong>"Check-in"</strong></li>
                                                <li class="list-group-item">Lihat hasil check-in</li>
                                            </ol>

                                            <h5 class="mt-3">Fitur Desktop:</h5>
                                            <ul class="list-group">
                                                <li class="list-group-item">✅ Input manual QR code</li>
                                                <li class="list-group-item">✅ Support barcode scanner USB</li>
                                                <li class="list-group-item">✅ Keyboard shortcuts</li>
                                                <li class="list-group-item">✅ Optional webcam scanner</li>
                                            </ul>

                                            <div class="alert alert-success mt-3">
                                                <strong>💡 Tips Desktop:</strong>
                                                <ul class="mb-0">
                                                    <li>Gunakan barcode scanner USB untuk efisiensi</li>
                                                    <li>Auto-focus pada input field</li>
                                                    <li>Tekan F1 untuk shortcut</li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12">
                                    <div class="card">
                                        <div class="card-header bg-secondary text-white">
                                            <h4 class="mb-0">⌨️ Keyboard Shortcuts</h4>
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <h5>Mobile Shortcuts:</h5>
                                                    <ul class="list-group">
                                                        <li class="list-group-item"><kbd>F1</kbd> - Start/Stop scanner</li>
                                                        <li class="list-group-item"><kbd>Esc</kbd> - Stop scanner</li>
                                                    </ul>
                                                </div>
                                                <div class="col-md-6">
                                                    <h5>Desktop Shortcuts:</h5>
                                                    <ul class="list-group">
                                                        <li class="list-group-item"><kbd>Enter</kbd> - Submit QR code</li>
                                                        <li class="list-group-item"><kbd>Esc</kbd> - Clear input & stop camera</li>
                                                        <li class="list-group-item"><kbd>Ctrl+F</kbd> - Focus input field</li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row mt-4">
                                <div class="col-12">
                                    <div class="alert alert-warning">
                                        <h5>⚠️ Troubleshooting Scanner:</h5>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <h6>Masalah Umum:</h6>
                                                <ul>
                                                    <li><strong>Kamera tidak muncul:</strong> Refresh browser, cek permission</li>
                                                    <li><strong>QR tidak terdeteksi:</strong> Periksa pencahayaan, jarak</li>
                                                    <li><strong>Scanner lag:</strong> Tutup aplikasi lain, refresh browser</li>
                                                    <li><strong>Input tidak responsive:</strong> Klik pada input field dulu</li>
                                                </ul>
                                            </div>
                                            <div class="col-md-6">
                                                <h6>Solusi:</h6>
                                                <ul>
                                                    <li><strong>Clear browser cache</strong></li>
                                                    <li><strong>Gunakan Chrome/Firefox</strong> terbaru</li>
                                                    <li><strong>Check koneksi internet</strong></li>
                                                    <li><strong>Restart browser</strong> jika perlu</li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Quick Links -->
            <div class="row mt-5">
                <div class="col-12">
                    <div class="card border-primary">
                        <div class="card-header bg-light">
                            <h4 class="mb-0">🔗 Link Cepat</h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-3">
                                    <h5>Admin</h5>
                                    <ul class="list-unstyled">
                                        <li><a href="{{ url('/admin') }}" class="btn btn-outline-primary btn-sm mb-1">🏠 Admin Panel</a></li>
                                        <li><a href="{{ url('/admin/events') }}" class="btn btn-outline-primary btn-sm mb-1">📅 Kelola Event</a></li>
                                        <li><a href="{{ url('/admin/participants') }}" class="btn btn-outline-primary btn-sm mb-1">👥 Kelola Peserta</a></li>
                                    </ul>
                                </div>
                                <div class="col-md-3">
                                    <h5>Pengguna</h5>
                                    <ul class="list-unstyled">
                                        <li><a href="{{ url('/') }}" class="btn btn-outline-success btn-sm mb-1">🏠 Halaman Utama</a></li>
                                        <li><a href="{{ url('/events') }}" class="btn btn-outline-success btn-sm mb-1">📅 Daftar Event</a></li>
                                    </ul>
                                </div>
                                <div class="col-md-3">
                                    <h5>Tools</h5>
                                    <ul class="list-unstyled">
                                        <li><a href="{{ url('/scanner') }}" class="btn btn-outline-warning btn-sm mb-1">📷 QR Scanner</a></li>
                                        <li><a href="{{ url('/tutorial') }}" class="btn btn-outline-info btn-sm mb-1">📚 Tutorial</a></li>
                                    </ul>
                                </div>
                                <div class="col-md-3">
                                    <h5>Support</h5>
                                    <ul class="list-unstyled">
                                        <li><strong>📧 Email:</strong> tridayadigital@gmail.com</li>
                                        <li><strong>🕒 Response:</strong> 1x24 jam</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Ensure Bootstrap JS is loaded and working
    if (typeof bootstrap !== 'undefined') {
        console.log('Bootstrap loaded successfully');
    } else {
        console.error('Bootstrap not loaded - accordion may not work');
    }

    // Initialize all accordions manually if needed
    const accordions = document.querySelectorAll('.accordion-button');
    accordions.forEach(button => {
        button.addEventListener('click', function() {
            const target = this.getAttribute('data-bs-target');
            const targetElement = document.querySelector(target);
            
            if (targetElement) {
                // Force toggle if Bootstrap is not working
                if (!targetElement.classList.contains('show')) {
                    // Close other accordion items in the same parent
                    const parent = targetElement.closest('.accordion');
                    const siblings = parent.querySelectorAll('.accordion-collapse.show');
                    siblings.forEach(sibling => {
                        if (sibling !== targetElement) {
                            sibling.classList.remove('show');
                        }
                    });
                    
                    // Open current item
                    targetElement.classList.add('show');
                    this.classList.remove('collapsed');
                    this.setAttribute('aria-expanded', 'true');
                } else {
                    // Close current item
                    targetElement.classList.remove('show');
                    this.classList.add('collapsed');
                    this.setAttribute('aria-expanded', 'false');
                }
            }
        });
    });
});
</script>

<style>
/* Ensure accordion styling */
.accordion-button:not(.collapsed) {
    background-color: var(--bs-primary);
    color: white;
}

.accordion-button:focus {
    box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.25);
}

.accordion-collapse {
    transition: height 0.35s ease;
}

.accordion-collapse:not(.show) {
    height: 0;
    overflow: hidden;
}

.accordion-collapse.show {
    height: auto;
    overflow: visible;
}

/* Tab styling improvements */
.nav-pills .nav-link {
    border-radius: 0.375rem;
    margin: 0 2px;
}

.nav-pills .nav-link.active {
    background-color: var(--bs-primary);
}

/* Card improvements */
.card {
    border: none;
    box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
}

.card-header {
    border-bottom: 1px solid rgba(0, 0, 0, 0.125);
}

/* List group improvements */
.list-group-numbered {
    counter-reset: section;
}

.list-group-numbered .list-group-item::before {
    counter-increment: section;
    content: counter(section);
    position: absolute;
    left: 10px;
    top: 50%;
    transform: translateY(-50%);
    background-color: var(--bs-primary);
    color: white;
    width: 20px;
    height: 20px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 0.75rem;
    font-weight: bold;
}

.list-group-numbered .list-group-item {
    padding-left: 40px;
    position: relative;
}

/* Alert improvements */
.alert {
    border-radius: 0.5rem;
}

/* Badge improvements */
.badge {
    font-size: 0.75em;
}

/* Button improvements */
.btn-sm {
    padding: 0.25rem 0.5rem;
    font-size: 0.875rem;
}

/* Mobile responsiveness */
@media (max-width: 768px) {
    .nav-pills {
        flex-direction: column;
    }
    
    .nav-pills .nav-link {
        margin: 2px 0;
        text-align: center;
    }
    
    .accordion-button {
        font-size: 0.9rem;
        padding: 0.75rem;
    }
    
    .card-body {
        padding: 1rem;
    }
}
</style>
@endsection