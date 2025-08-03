<?php

namespace App\Console\Commands;

use App\Models\Event;
use App\Models\Participant;
use App\Mail\EventReminder;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class SendEventReminders extends Command
{
    protected $signature = 'events:send-reminders';
    protected $description = 'Send reminder emails for events happening in 24 hours';

    public function handle()
    {
        $tomorrow = now()->addDay();
        
        $events = Event::where('is_active', true)
            ->whereBetween('start_date', [
                $tomorrow->startOfDay(),
                $tomorrow->endOfDay()
            ])
            ->get();

        $sentCount = 0;

        foreach ($events as $event) {
            $participants = $event->participants()
                ->where('email_sent', true)
                ->where('is_attended', false)
                ->get();

            foreach ($participants as $participant) {
                try {
                    Mail::to($participant->email)->send(new EventReminder($participant));
                    $sentCount++;
                    
                    $this->info("Reminder sent to {$participant->email} for event: {$event->title}");
                } catch (\Exception $e) {
                    $this->error("Failed to send reminder to {$participant->email}: " . $e->getMessage());
                }
            }
        }

        $this->info("Total reminders sent: {$sentCount}");
        
        return 0;
    }
}
