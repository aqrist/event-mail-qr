<?php

namespace App\Console\Commands;

use App\Models\Participant;
use App\Mail\ParticipantRegistered;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class TestResendEmail extends Command
{
    protected $signature = 'email:test-resend {participantId?}';
    protected $description = 'Test resend email functionality';

    public function handle()
    {
        $participantId = $this->argument('participantId');
        
        if ($participantId) {
            $participant = Participant::find($participantId);
        } else {
            $participant = Participant::first();
        }
        
        if (!$participant) {
            $this->error('Participant not found');
            return 1;
        }
        
        $this->info("Testing resend email to: {$participant->name} ({$participant->email})");
        $this->info("Event: {$participant->event->title}");
        
        try {
            Mail::to($participant->email)->send(new ParticipantRegistered($participant));
            
            $participant->update(['email_sent' => true]);
            
            $this->info('✅ Resend email successful!');
            $this->line('Check the email inbox.');
            
            return 0;
            
        } catch (\Exception $e) {
            $this->error('❌ Resend email failed:');
            $this->error($e->getMessage());
            return 1;
        }
    }
}
