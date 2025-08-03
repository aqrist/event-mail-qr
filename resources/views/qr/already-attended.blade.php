@extends('layouts.app')

@section('title', 'Already Checked In')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow-lg text-center">
                <div class="card-body">
                    <div class="text-warning mb-4">
                        <i class="fas fa-exclamation-triangle fa-5x"></i>
                    </div>
                    
                    <h2 class="text-warning mb-4">Already Checked In</h2>
                    
                    <div class="alert alert-warning">
                        <h5>{{ $participant->name }}</h5>
                        <hr>
                        <p class="mb-1">You have already checked in to <strong>{{ $participant->event->title }}</strong></p>
                        <p class="mb-0"><strong>Previous Check-in:</strong> {{ $participant->attended_at->format('M d, Y g:i A') }}</p>
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