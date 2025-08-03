@extends('layouts.app')

@section('title', 'Check-in Successful')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow-lg text-center">
                <div class="card-body">
                    <div class="text-success mb-4">
                        <i class="fas fa-check-circle fa-5x"></i>
                    </div>
                    
                    <h2 class="text-success mb-4">Check-in Successful!</h2>
                    
                    <div class="alert alert-success">
                        <h5>Welcome to {{ $participant->event->title }}</h5>
                        <hr>
                        <p class="mb-1"><strong>Participant:</strong> {{ $participant->name }}</p>
                        <p class="mb-1"><strong>Email:</strong> {{ $participant->email }}</p>
                        <p class="mb-0"><strong>Check-in Time:</strong> {{ $participant->attended_at->format('M d, Y g:i A') }}</p>
                    </div>
                    
                    <div class="mt-4">
                        <a href="{{ route('events.index') }}" class="btn btn-primary">
                            <i class="fas fa-calendar"></i> View Other Events
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection