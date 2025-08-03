@extends('layouts.app')

@section('title', 'Event')

@section('content')
<div class="container py-5">
    <div class="row">
        <div class="col-12">
            <h1 class="display-4 text-center mb-5">Event Mendatang</h1>
        </div>
    </div>
    
    <div class="row">
        @forelse($events as $event)
            <div class="col-md-6 col-lg-4 mb-4">
                <div class="card h-100 shadow-sm">
                    @if($event->image)
                        <img src="{{ Storage::url($event->image) }}" class="card-img-top" alt="{{ $event->title }}" style="height: 200px; object-fit: cover;">
                    @else
                        <div class="card-img-top bg-light d-flex align-items-center justify-content-center" style="height: 200px;">
                            <i class="fas fa-calendar-alt fa-3x text-muted"></i>
                        </div>
                    @endif
                    
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title">{{ $event->title }}</h5>
                        <p class="card-text">{{ Str::limit($event->description, 100) }}</p>
                        
                        <div class="mt-auto">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <small class="text-muted">
                                    <i class="fas fa-calendar"></i> {{ $event->start_date->format('M d, Y') }}
                                </small>
                                <small class="text-muted">
                                    <i class="fas fa-clock"></i> {{ $event->start_date->format('H:i') }}
                                </small>
                            </div>
                            
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <small class="text-muted">
                                    <i class="fas fa-map-marker-alt"></i> {{ $event->location }}
                                </small>
                                @if($event->capacity)
                                    <small class="text-muted">
                                        {{ $event->available_slots }} slot tersisa
                                    </small>
                                @endif
                            </div>
                            
                            @if($event->registration_open && !$event->is_full)
                                <a href="{{ route('events.show', $event) }}" class="btn btn-primary w-100">
                                    Daftar Sekarang
                                </a>
                            @elseif($event->is_full)
                                <button class="btn btn-secondary w-100" disabled>
                                    Event Penuh
                                </button>
                            @else
                                <button class="btn btn-secondary w-100" disabled>
                                    Pendaftaran Ditutup
                                </button>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12 text-center">
                <div class="py-5">
                    <i class="fas fa-calendar-times fa-4x text-muted mb-3"></i>
                    <h3 class="text-muted">Tidak ada event tersedia</h3>
                    <p class="text-muted">Silakan cek kembali untuk event mendatang.</p>
                </div>
            </div>
        @endforelse
    </div>
    
    @if($events->hasPages())
        <div class="row">
            <div class="col-12 d-flex justify-content-center">
                {{ $events->links() }}
            </div>
        </div>
    @endif
</div>
@endsection