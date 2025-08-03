<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Konfirmasi Pendaftaran</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }
        .header {
            background-color: #007bff;
            color: white;
            text-align: center;
            padding: 20px;
            border-radius: 8px 8px 0 0;
        }
        .content {
            background-color: #f8f9fa;
            padding: 30px;
            border-radius: 0 0 8px 8px;
        }
        .event-details {
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            margin: 20px 0;
            border-left: 4px solid #007bff;
        }
        .qr-section {
            text-align: center;
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            margin: 20px 0;
        }
        .btn {
            display: inline-block;
            background-color: #007bff;
            color: white;
            text-decoration: none;
            padding: 12px 24px;
            border-radius: 4px;
            margin: 10px 0;
        }
        .footer {
            text-align: center;
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid #dee2e6;
            color: #6c757d;
            font-size: 14px;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Pendaftaran Dikonfirmasi!</h1>
    </div>
    
    <div class="content">
        <h2>Halo {{ $participant->name }},</h2>
        
        <p>Terima kasih telah mendaftar untuk <strong>{{ $participant->event->title }}</strong>. Pendaftaran Anda telah dikonfirmasi!</p>
        
        <div class="event-details">
            <h3>Detail Event</h3>
            <p><strong>Event:</strong> {{ $participant->event->title }}</p>
            <p><strong>Tanggal:</strong> {{ $participant->event->start_date->format('l, j F Y') }}</p>
            <p><strong>Waktu:</strong> {{ $participant->event->start_date->format('H:i') }} - {{ $participant->event->end_date->format('H:i') }} WIB</p>
            <p><strong>Lokasi:</strong> {{ $participant->event->location }}</p>
            
            @if($participant->event->description)
                <p><strong>Deskripsi:</strong></p>
                <p>{{ $participant->event->description }}</p>
            @endif
        </div>
        
        <div class="qr-section">
            <h3>Tiket Event Anda</h3>
            <p>Silakan simpan email ini atau akses tiket Anda menggunakan tautan di bawah. Anda perlu menunjukkan kode QR di event untuk check-in.</p>
            
            <a href="{{ route('ticket.show', $participant->qr_code) }}" class="btn">
                Lihat Tiket Anda
            </a>
            
            <p style="margin-top: 15px; font-size: 14px; color: #6c757d;">
                ID Tiket: {{ $participant->qr_code }}
            </p>
        </div>
        
        <h3>Yang Perlu Dipersiapkan</h3>
        <ul>
            <li>Tiba di lokasi 15 menit sebelum event dimulai</li>
            <li>Tunjukkan kode QR Anda (digital atau cetak) di meja check-in</li>
            <li>Ikuti instruksi khusus yang diberikan di lokasi</li>
        </ul>
        
        @if($participant->event->start_date > now()->addDay())
            <div style="background-color: #d4edda; border: 1px solid #c3e6cb; border-radius: 4px; padding: 15px; margin: 20px 0;">
                <p style="margin: 0; color: #155724;">
                    <strong>Pengingat:</strong> Anda akan menerima email pengingat 24 jam sebelum event.
                </p>
            </div>
        @endif
        
        <p>Jika Anda memiliki pertanyaan tentang event ini, jangan ragu untuk menghubungi kami.</p>
        
        <p>Kami menantikan kehadiran Anda di event!</p>
        
        <p>Salam hormat,<br>
        Tim {{ config('app.name') }}</p>
    </div>
    
    <div class="footer">
        <p>Ini adalah pesan otomatis. Mohon jangan membalas email ini.</p>
        <p>&copy; {{ date('Y') }} {{ config('app.name') }}. Hak cipta dilindungi.</p>
    </div>
</body>
</html>