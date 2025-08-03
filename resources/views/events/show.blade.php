@extends('layouts.app')

@section('title', $event->title)

@section('content')
<div class="container py-5">
    <div class="row">
        <div class="col-lg-8 mx-auto">
            <!-- Event Header -->
            <div class="card shadow-sm mb-4">
                @if($event->image)
                    <img src="{{ Storage::url($event->image) }}" class="card-img-top" alt="{{ $event->title }}" style="height: 300px; object-fit: cover;">
                @endif
                
                <div class="card-body">
                    <h1 class="card-title display-5">{{ $event->title }}</h1>
                    
                    <div class="row mt-4">
                        <div class="col-md-6">
                            <h6><i class="fas fa-calendar text-primary"></i> Tanggal & Waktu</h6>
                            <p>{{ $event->start_date->format('l, j F Y') }}<br>
                               {{ $event->start_date->format('H:i') }} - {{ $event->end_date->format('H:i') }} WIB</p>
                        </div>
                        <div class="col-md-6">
                            <h6><i class="fas fa-map-marker-alt text-primary"></i> Lokasi</h6>
                            <p>{{ $event->location }}</p>
                        </div>
                    </div>
                    
                    @if($event->capacity)
                        <div class="row">
                            <div class="col-md-6">
                                <h6><i class="fas fa-users text-primary"></i> Kapasitas</h6>
                                <p>{{ $event->participants()->count() }} / {{ $event->capacity }} terdaftar</p>
                                <div class="progress" style="height: 8px;">
                                    <div class="progress-bar" role="progressbar" 
                                         style="width: {{ ($event->participants()->count() / $event->capacity) * 100 }}%">
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Event Description -->
            <div class="card shadow-sm mb-4">
                <div class="card-body">
                    <h5 class="card-title">Tentang Event Ini</h5>
                    <div class="card-text">
                        {!! nl2br(e($event->description)) !!}
                    </div>
                </div>
            </div>

            <!-- Registration Form -->
            @if($event->registration_open && !$event->is_full)
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title">Daftar untuk Event Ini</h5>
                        
                        @if($errors->any())
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form action="{{ route('events.register', $event) }}" method="POST">
                            @csrf
                            
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="name" class="form-label">Nama Lengkap <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="name" name="name" 
                                           value="{{ old('name') }}" required>
                                </div>
                                
                                <div class="col-md-6 mb-3">
                                    <label for="email" class="form-label">Alamat Email <span class="text-danger">*</span></label>
                                    <input type="email" class="form-control" id="email" name="email" 
                                           value="{{ old('email') }}" required>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="phone" class="form-label">Nomor Telepon</label>
                                    <input type="tel" class="form-control" id="phone" name="phone" 
                                           value="{{ old('phone') }}">
                                </div>
                            </div>
                            
                            <!-- Custom Fields -->
                            @if($event->custom_fields)
                                @foreach($event->custom_fields as $field)
                                    <div class="mb-3">
                                        <label for="custom_{{ $loop->index }}" class="form-label">
                                            {{ $field['label'] }}
                                            @if($field['required'] ?? false)
                                                <span class="text-danger">*</span>
                                            @endif
                                        </label>
                                        
                                        @if($field['type'] === 'text')
                                            <input type="text" class="form-control" 
                                                   id="custom_{{ $loop->index }}" 
                                                   name="custom_fields[{{ $field['name'] }}]"
                                                   value="{{ old('custom_fields.' . $field['name']) }}"
                                                   {{ ($field['required'] ?? false) ? 'required' : '' }}>
                                        @elseif($field['type'] === 'textarea')
                                            <textarea class="form-control" 
                                                      id="custom_{{ $loop->index }}" 
                                                      name="custom_fields[{{ $field['name'] }}]"
                                                      rows="3"
                                                      {{ ($field['required'] ?? false) ? 'required' : '' }}>{{ old('custom_fields.' . $field['name']) }}</textarea>
                                        @elseif($field['type'] === 'select')
                                            <select class="form-select" 
                                                    id="custom_{{ $loop->index }}" 
                                                    name="custom_fields[{{ $field['name'] }}]"
                                                    {{ ($field['required'] ?? false) ? 'required' : '' }}>
                                                <option value="">Pilih opsi</option>
                                                @foreach($field['options'] as $option)
                                                    <option value="{{ $option }}" 
                                                            {{ old('custom_fields.' . $field['name']) === $option ? 'selected' : '' }}>
                                                        {{ $option }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        @endif
                                    </div>
                                @endforeach
                            @endif
                            
                            <button type="submit" class="btn btn-primary btn-lg w-100">
                                Daftar Event
                            </button>
                        </form>
                    </div>
                </div>
            @elseif($event->is_full)
                <div class="card shadow-sm">
                    <div class="card-body text-center">
                        <h5 class="card-title text-warning">Event Penuh</h5>
                        <p class="card-text">Event ini telah mencapai kapasitas maksimum.</p>
                    </div>
                </div>
            @else
                <div class="card shadow-sm">
                    <div class="card-body text-center">
                        <h5 class="card-title text-secondary">Pendaftaran Ditutup</h5>
                        <p class="card-text">Pendaftaran untuk event ini sudah tidak tersedia.</p>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>

<!-- Countdown Timer -->
@if($event->start_date > now())
<script>
document.addEventListener('DOMContentLoaded', function() {
    const countdownDate = new Date("{{ $event->start_date->toISOString() }}").getTime();
    
    const timer = setInterval(function() {
        const now = new Date().getTime();
        const distance = countdownDate - now;
        
        if (distance < 0) {
            clearInterval(timer);
            return;
        }
        
        const days = Math.floor(distance / (1000 * 60 * 60 * 24));
        const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
        const seconds = Math.floor((distance % (1000 * 60)) / 1000);
        
        // Update countdown display if element exists
        const countdownElement = document.getElementById('countdown');
        if (countdownElement) {
            countdownElement.innerHTML = `${days}d ${hours}h ${minutes}m ${seconds}s`;
        }
    }, 1000);
});
</script>
@endif
@endsection