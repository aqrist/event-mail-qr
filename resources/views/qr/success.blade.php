@extends('layouts.app')

@section('title', 'Check-in Berhasil')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow-lg text-center">
                <div class="card-body">
                    <div class="text-success mb-4">
                        <i class="fas fa-check-circle fa-5x"></i>
                    </div>
                    
                    <h2 class="text-success mb-4">Check-in Berhasil!</h2>
                    
                    <div class="alert alert-success">
                        <h5>Selamat datang di {{ $participant->event->title }}</h5>
                        <hr>
                        <p class="mb-1"><strong>Peserta:</strong> {{ $participant->name }}</p>
                        <p class="mb-1"><strong>Email:</strong> {{ $participant->email }}</p>
                        <p class="mb-0"><strong>Waktu Check-in:</strong> {{ $participant->attended_at->format('j M Y H:i') }} WIB</p>
                    </div>
                    
                    <div class="mt-4">
                        <a href="{{ route('events.index') }}" class="btn btn-primary">
                            <i class="fas fa-calendar"></i> Lihat Event Lain
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection