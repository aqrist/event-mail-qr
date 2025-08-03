<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Pengingat Event</title>
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
            background-color: #28a745;
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
            border-left: 4px solid #28a745;
        }
        .countdown {
            text-align: center;
            background-color: #fff3cd;
            border: 1px solid #ffeaa7;
            border-radius: 8px;
            padding: 20px;
            margin: 20px 0;
        }
        .btn {
            display: inline-block;
            background-color: #28a745;
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
        <h1>Pengingat Event</h1>
        <p>Jangan lupa tentang event Anda yang akan datang!</p>
    </div>
    
    <div class="content">
        <h2>Halo {{ $participant->name }},</h2>
        
        <p>Ini adalah pengingat ramah bahwa Anda telah terdaftar untuk <strong>{{ $participant->event->title }}</strong>, yang akan segera berlangsung!</p>
        
        <div class="countdown">
            <h3 style="margin-top: 0; color: #856404;">⏰ Event dimulai dalam kurang dari 24 jam!</h3>
            <p style="margin-bottom: 0; font-size: 18px; font-weight: bold;">
                {{ $participant->event->start_date->format('l, j F Y \p\u\k\u\l H:i') }} WIB
            </p>
        </div>
        
        <div class="event-details">
            <h3>Detail Event</h3>
            <p><strong>Event:</strong> {{ $participant->event->title }}</p>
            <p><strong>Tanggal:</strong> {{ $participant->event->start_date->format('l, j F Y') }}</p>
            <p><strong>Waktu:</strong> {{ $participant->event->start_date->format('H:i') }} - {{ $participant->event->end_date->format('H:i') }} WIB</p>
            <p><strong>Lokasi:</strong> {{ $participant->event->location }}</p>
        </div>
        
        <h3>Pengingat Penting</h3>
        <ul>
            <li><strong>Tiba lebih awal:</strong> Harap tiba 15 menit sebelum event dimulai</li>
            <li><strong>Bawa tiket Anda:</strong> Anda memerlukan kode QR untuk check-in</li>
            <li><strong>Periksa lalu lintas:</strong> Rencanakan rute dan beri waktu ekstra untuk perjalanan</li>
            @if($participant->phone)
                <li><strong>Info kontak:</strong> Siapkan telepon Anda jika kami perlu menghubungi Anda</li>
            @endif
        </ul>
        
        <div style="text-align: center; margin: 30px 0;">
            <a href="{{ route('ticket.show', $participant->qr_code) }}" class="btn">
                Lihat Tiket Anda
            </a>
        </div>
        
        @if(!$participant->is_attended)
            <div style="background-color: #d1ecf1; border: 1px solid #bee5eb; border-radius: 4px; padding: 15px; margin: 20px 0;">
                <p style="margin: 0; color: #0c5460;">
                    <strong>Check-in Cepat:</strong> Hemat waktu di event dengan menyiapkan kode QR Anda di ponsel atau sudah dicetak.
                </p>
            </div>
        @endif
        
        <p>Kami sangat menantikan kehadiran Anda di event!</p>
        
        <p>Jika Anda tidak bisa hadir atau memiliki pertanyaan, mohon beritahu kami sesegera mungkin.</p>
        
        <p>Salam hormat,<br>
        Tim {{ config('app.name') }}</p>
    </div>
    
    <div class="footer">
        <p>Ini adalah pengingat otomatis. Mohon jangan membalas email ini.</p>
        <p>&copy; {{ date('Y') }} {{ config('app.name') }}. Hak cipta dilindungi.</p>
    </div>
</body>
</html>