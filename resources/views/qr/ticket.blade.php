@extends('layouts.app')

@section('title', 'Tiket Anda')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow-lg">
                <div class="card-header bg-primary text-white text-center">
                    <h4 class="mb-0">Tiket Event</h4>
                </div>
                
                <div class="card-body text-center">
                    <h5 class="card-title">{{ $participant->event->title }}</h5>
                    
                    <div class="my-4">
                        <img src="{{ route('qr.generate', $participant->id) }}" 
                             alt="QR Code" 
                             class="img-fluid" 
                             style="max-width: 200px;">
                    </div>
                    
                    <div class="row text-start">
                        <div class="col-6">
                            <strong>Nama:</strong><br>
                            {{ $participant->name }}
                        </div>
                        <div class="col-6">
                            <strong>Email:</strong><br>
                            {{ $participant->email }}
                        </div>
                    </div>
                    
                    <hr>
                    
                    <div class="row text-start">
                        <div class="col-6">
                            <strong>Tanggal:</strong><br>
                            {{ $participant->event->start_date->format('j M Y') }}
                        </div>
                        <div class="col-6">
                            <strong>Waktu:</strong><br>
                            {{ $participant->event->start_date->format('H:i') }} WIB
                        </div>
                    </div>
                    
                    <div class="mt-3 text-start">
                        <strong>Lokasi:</strong><br>
                        {{ $participant->event->location }}
                    </div>
                    
                    @if($participant->is_attended)
                        <div class="alert alert-success mt-3">
                            <i class="fas fa-check-circle"></i> 
                            Anda telah check-in pada {{ $participant->attended_at->format('j M Y H:i') }} WIB
                        </div>
                    @else
                        <div class="alert alert-info mt-3">
                            <i class="fas fa-info-circle"></i> 
                            Tunjukkan kode QR ini di event untuk check-in
                        </div>
                    @endif
                </div>
                
                <div class="card-footer text-center">
                    <button onclick="window.print()" class="btn btn-outline-primary">
                        <i class="fas fa-print"></i> Cetak Tiket
                    </button>
                    <button onclick="downloadQR()" class="btn btn-outline-secondary">
                        <i class="fas fa-download"></i> Unduh QR
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function downloadQR() {
    const qrImage = document.querySelector('img[alt="QR Code"]');
    const link = document.createElement('a');
    link.download = 'ticket-qr-{{ $participant->qr_code }}.svg';
    link.href = qrImage.src;
    link.click();
}
</script>

<style>
@media print {
    .navbar, .card-footer, .btn {
        display: none !important;
    }
    
    .container {
        max-width: none !important;
        margin: 0 !important;
        padding: 0 !important;
    }
    
    .card {
        border: none !important;
        box-shadow: none !important;
    }
}
</style>
@endsection