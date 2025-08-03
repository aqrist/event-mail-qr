# Email Troubleshooting Guide

## Status: ✅ Email Configuration WORKING

### Konfigurasi Email yang Sudah Diperbaiki:

1. **Queue Connection**: Diubah dari `database` ke `sync`
   - File: `.env` 
   - `QUEUE_CONNECTION=sync`

2. **Email Mailable**: Dihapus `ShouldQueue` interface
   - File: `app/Mail/ParticipantRegistered.php`
   - File: `app/Mail/EventReminder.php`
   - Sekarang email langsung terkirim (tidak di-queue)

3. **SMTP Configuration**: 
   ```
   MAIL_MAILER=smtp
   MAIL_HOST=smtp.gmail.com
   MAIL_PORT=587
   MAIL_USERNAME="tridayadigital@gmail.com"
   MAIL_PASSWORD="lzhkuedpdedsycou"
   MAIL_ENCRYPTION=tls
   MAIL_FROM_ADDRESS="tridayadigital@gmail.com"
   ```

### Testing Commands:

1. **Test Email Basic**:
   ```bash
   php artisan email:test [email]
   ```

2. **Test Resend Email**:
   ```bash
   php artisan email:test-resend [participantId]
   ```

### Features yang Sudah Ditambahkan:

#### Resend Email di Admin Panel:
1. **Individual Action**: Tombol "Kirim Ulang Email" per peserta
2. **Bulk Action**: Pilih multiple peserta → "Kirim Ulang Email"
3. **Confirmation Modal**: Konfirmasi sebelum mengirim
4. **Logging**: Semua aktivitas email di-log
5. **Notifications**: Success/error notifications

#### Tombol Resend Email:
- ✅ Icon: envelope
- ✅ Color: info (blue)
- ✅ Confirmation modal
- ✅ Error handling
- ✅ Success feedback
- ✅ Bahasa Indonesia

### Cara Menggunakan Resend Email:

1. **Via Admin Panel**:
   - Login ke `/admin`
   - Buka "Participants" 
   - Klik "Kirim Ulang Email" pada peserta
   - Konfirmasi di modal

2. **Via Command Line**:
   ```bash
   php artisan email:test-resend
   ```

### Troubleshooting:

Jika email masih bermasalah:

1. **Cek Config Cache**:
   ```bash
   php artisan config:clear
   php artisan cache:clear
   ```

2. **Cek Log**:
   ```bash
   tail -f storage/logs/laravel.log
   ```

3. **Test SMTP Connection**:
   ```bash
   php artisan email:test your-email@gmail.com
   ```

### Gmail App Password:
Email menggunakan Gmail App Password: `lzhkuedpdedsycou`
Jika bermasalah, generate App Password baru di Google Account Settings.