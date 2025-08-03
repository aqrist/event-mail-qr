<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Participant;
use Illuminate\Http\Request;
use App\Mail\ParticipantRegistered;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class EventController extends Controller
{
    public function index()
    {
        $events = Event::where('is_active', true)
            ->where('start_date', '>', now())
            ->orderBy('start_date')
            ->paginate(12);

        return view('events.index', compact('events'));
    }

    public function show(Event $event)
    {
        if (!$event->is_active) {
            abort(404);
        }

        return view('events.show', compact('event'));
    }

    public function register(Request $request, Event $event)
    {
        if (!$event->is_active || !$event->registration_open || $event->is_full) {
            return redirect()->back()->with('error', 'Registration is not available for this event.');
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:255',
            'custom_fields' => 'nullable|array',
        ]);

        // Check if already registered
        $existingParticipant = Participant::where('event_id', $event->id)
            ->where('email', $validated['email'])
            ->first();

        if ($existingParticipant) {
            return redirect()->route('ticket.show', $existingParticipant->qr_code)
                ->with('info', 'You are already registered for this event.');
        }

        // Create participant
        $participant = Participant::create([
            'event_id' => $event->id,
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'],
            'additional_data' => $validated['custom_fields'],
        ]);

        // Send confirmation email
        try {
            Mail::to($participant->email)->send(new ParticipantRegistered($participant));
            $participant->update(['email_sent' => true]);
        } catch (\Exception $e) {
            // Log error but don't fail registration
            Log::error('Failed to send registration email: ' . $e->getMessage());
        }

        return redirect()->route('ticket.show', $participant->qr_code)
            ->with('success', 'Registration successful! Check your email for confirmation.');
    }
}
