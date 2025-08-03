<?php

namespace App\Console\Commands;

use App\Models\Participant;
use App\Mail\ParticipantRegistered;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class TestEmail extends Command
{
    protected $signature = 'email:test {email?}';
    protected $description = 'Test email sending functionality';

    public function handle()
    {
        $email = $this->argument('email') ?? 'test@example.com';
        
        $this->info('Testing email configuration...');
        
        // Test basic email configuration
        try {
            $this->info('Mail configuration:');
            $this->line('Mailer: ' . config('mail.default'));
            $this->line('Host: ' . config('mail.mailers.smtp.host'));
            $this->line('Port: ' . config('mail.mailers.smtp.port'));
            $this->line('From: ' . config('mail.from.address'));
            
            // Get a participant to test with
            $participant = Participant::first();
            
            if (!$participant) {
                $this->error('No participants found in database. Please run seeders first.');
                return 1;
            }
            
            $this->info("Testing email to: {$email}");
            $this->info("Using participant: {$participant->name}");
            
            // Test sending email
            Mail::to($email)->send(new ParticipantRegistered($participant));
            
            $this->info('✅ Email sent successfully!');
            $this->line('Check your email inbox (and spam folder).');
            
            return 0;
            
        } catch (\Exception $e) {
            $this->error('❌ Email failed to send:');
            $this->error($e->getMessage());
            
            if (str_contains($e->getMessage(), 'Connection could not be established')) {
                $this->warn('Possible issues:');
                $this->warn('1. SMTP credentials are incorrect');
                $this->warn('2. Internet connection problem');
                $this->warn('3. SMTP server is blocking the connection');
                $this->warn('4. Two-factor authentication required for Gmail');
            }
            
            return 1;
        }
    }
}
