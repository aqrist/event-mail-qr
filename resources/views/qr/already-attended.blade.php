@extends('layouts.app')

@section('title', 'Sudah Check-in')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow-lg text-center">
                <div class="card-body">
                    <div class="text-warning mb-4">
                        <i class="fas fa-exclamation-triangle fa-5x"></i>
                    </div>
                    
                    <h2 class="text-warning mb-4">Sudah Check-in</h2>
                    
                    <div class="alert alert-warning">
                        <h5>{{ $participant->name }}</h5>
                        <hr>
                        <p class="mb-1">Anda sudah check-in untuk <strong>{{ $participant->event->title }}</strong></p>
                        <p class="mb-0"><strong>Check-in Sebelumnya:</strong> {{ $participant->attended_at->format('j M Y H:i') }} WIB</p>
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