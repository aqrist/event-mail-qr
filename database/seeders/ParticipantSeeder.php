<?php

namespace Database\Seeders;

use App\Models\Event;
use App\Models\Participant;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ParticipantSeeder extends Seeder
{
    public function run(): void
    {
        $events = Event::all();
        
        $participants = [
            [
                'name' => 'Ahmad Rizki',
                'email' => 'ahmad.rizki@tridi.com',
                'phone' => '+62812345678',
                'email_sent' => true,
            ],
            [
                'name' => 'Sari Dewi',
                'email' => 'sari.dewi@tridi.com',
                'phone' => '+62823456789',
                'email_sent' => true,
            ],
            [
                'name' => 'Budi Prasetyo',
                'email' => 'budi.prasetyo@tridi.com',
                'phone' => '+62834567890',
                'email_sent' => true,
            ],
            [
                'name' => 'Indira Sari',
                'email' => 'indira.sari@tridi.com',
                'phone' => '+62845678901',
                'email_sent' => true,
            ],
            [
                'name' => 'Fajar Nugroho',
                'email' => 'fajar.nugroho@tridi.com',
                'phone' => '+62856789012',
                'email_sent' => true,
            ],
            [
                'name' => 'Rina Maharani',
                'email' => 'rina.maharani@tridi.com',
                'phone' => '+62867890123',
                'email_sent' => true,
            ],
            [
                'name' => 'Dani Setiawan',
                'email' => 'dani.setiawan@tridi.com',
                'phone' => '+62878901234',
                'email_sent' => true,
            ],
            [
                'name' => 'Maya Kusuma',
                'email' => 'maya.kusuma@tridi.com',
                'phone' => '+62889012345',
                'email_sent' => true,
            ],
            [
                'name' => 'Eko Wijaya',
                'email' => 'eko.wijaya@tridi.com',
                'phone' => '+62890123456',
                'email_sent' => true,
            ],
            [
                'name' => 'Lestari Putri',
                'email' => 'lestari.putri@tridi.com',
                'phone' => '+62901234567',
                'email_sent' => true,
            ]
        ];

        foreach ($events as $event) {
            // Skip if registration is closed
            if (!$event->registration_open) {
                continue;
            }

            // Generate random number of participants for each event
            $participantCount = rand(5, min(15, $event->capacity ?? 20));
            
            for ($i = 0; $i < $participantCount; $i++) {
                $participantData = $participants[$i % count($participants)];
                
                // Make email unique by adding event ID and index
                $participantData['email'] = "participant{$i}.event{$event->id}@tridi.com";
                $participantData['event_id'] = $event->id;
                
                // Add custom field data based on event
                if ($event->custom_fields) {
                    $additionalData = [];
                    foreach ($event->custom_fields as $field) {
                        switch ($field['name']) {
                            case 'company':
                                $companies = ['PT Teknologi Maju', 'Digital Solutions Indonesia', 'Innovation Labs Jakarta', 'StartupX Indonesia', 'Global Systems'];
                                $additionalData[$field['name']] = $companies[array_rand($companies)];
                                break;
                            case 'experience':
                                $additionalData[$field['name']] = $field['options'][array_rand($field['options'])];
                                break;
                            case 'business_type':
                                $additionalData[$field['name']] = $field['options'][array_rand($field['options'])];
                                break;
                            case 'role':
                                $additionalData[$field['name']] = $field['options'][array_rand($field['options'])];
                                break;
                            case 'programming_experience':
                                $additionalData[$field['name']] = $field['options'][array_rand($field['options'])];
                                break;
                            case 'laptop':
                                $additionalData[$field['name']] = $field['options'][array_rand($field['options'])];
                                break;
                            case 'background':
                                $additionalData[$field['name']] = $field['options'][array_rand($field['options'])];
                                break;
                            case 'interests':
                                $interests = ['AI dan ML', 'Pengembangan Web', 'Aplikasi Mobile', 'IoT', 'Blockchain'];
                                $additionalData[$field['name']] = $interests[array_rand($interests)];
                                break;
                        }
                    }
                    $participantData['additional_data'] = $additionalData;
                }

                // Some participants have already attended (for testing)
                if (rand(1, 100) <= 30) { // 30% chance of being attended
                    $participantData['is_attended'] = true;
                    $participantData['attended_at'] = $event->start_date->subDays(rand(1, 5));
                }

                Participant::create($participantData);
            }
        }
    }
}
