<?php

namespace Database\Seeders;

use App\Models\Event;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EventSeeder extends Seeder
{
    public function run(): void
    {
        $events = [
            [
                'title' => 'Konferensi Teknologi 2025',
                'description' => 'Bergabunglah dengan kami dalam konferensi teknologi terbesar tahun ini! Pelajari inovasi terbaru dalam AI, pengembangan web, dan cloud computing. Networking dengan profesional industri dan ikuti workshop praktis.',
                'start_date' => now()->addDays(30)->setTime(9, 0),
                'end_date' => now()->addDays(30)->setTime(17, 0),
                'location' => 'Jakarta Convention Center, Jakarta',
                'capacity' => 500,
                'is_active' => true,
                'registration_open' => true,
                'registration_deadline' => now()->addDays(25),
                'custom_fields' => [
                    [
                        'name' => 'company',
                        'label' => 'Nama Perusahaan',
                        'type' => 'text',
                        'required' => false
                    ],
                    [
                        'name' => 'experience',
                        'label' => 'Level Pengalaman',
                        'type' => 'select',
                        'options' => ['Pemula', 'Menengah', 'Mahir'],
                        'required' => true
                    ]
                ]
            ],
            [
                'title' => 'Workshop Digital Marketing',
                'description' => 'Kuasai seni digital marketing! Workshop intensif ini mencakup SEO, social media marketing, strategi konten, dan analytics. Cocok untuk entrepreneur dan profesional marketing.',
                'start_date' => now()->addDays(15)->setTime(10, 0),
                'end_date' => now()->addDays(15)->setTime(16, 0),
                'location' => 'Bandung Creative Hub, Bandung',
                'capacity' => 50,
                'is_active' => true,
                'registration_open' => true,
                'registration_deadline' => now()->addDays(10),
                'custom_fields' => [
                    [
                        'name' => 'business_type',
                        'label' => 'Jenis Bisnis',
                        'type' => 'select',
                        'options' => ['E-commerce', 'Jasa', 'Manufaktur', 'Lainnya'],
                        'required' => false
                    ]
                ]
            ],
            [
                'title' => 'Malam Pitch Startup',
                'description' => 'Malam yang menarik dimana startup inovatif mempresentasikan ide mereka kepada investor dan ahli industri. Bergabunglah untuk networking, belajar, dan menemukan hal besar berikutnya!',
                'start_date' => now()->addDays(7)->setTime(18, 0),
                'end_date' => now()->addDays(7)->setTime(21, 0),
                'location' => 'Surabaya Innovation Center, Surabaya',
                'capacity' => 200,
                'is_active' => true,
                'registration_open' => true,
                'registration_deadline' => now()->addDays(5),
                'custom_fields' => [
                    [
                        'name' => 'role',
                        'label' => 'Peran Anda',
                        'type' => 'select',
                        'options' => ['Entrepreneur', 'Investor', 'Developer', 'Mahasiswa', 'Lainnya'],
                        'required' => true
                    ],
                    [
                        'name' => 'interests',
                        'label' => 'Bidang Minat',
                        'type' => 'textarea',
                        'required' => false
                    ]
                ]
            ],
            [
                'title' => 'Bootcamp Pengembangan Web',
                'description' => 'Bootcamp intensif 3 hari mencakup pengembangan web modern dengan React, Node.js, dan database. Sesi coding hands-on dengan instruktur berpengalaman.',
                'start_date' => now()->addDays(45)->setTime(9, 0),
                'end_date' => now()->addDays(47)->setTime(17, 0),
                'location' => 'Yogyakarta Tech Campus, Yogyakarta',
                'capacity' => 30,
                'is_active' => true,
                'registration_open' => true,
                'registration_deadline' => now()->addDays(35),
                'custom_fields' => [
                    [
                        'name' => 'programming_experience',
                        'label' => 'Pengalaman Programming',
                        'type' => 'select',
                        'options' => ['Tidak ada', '< 1 tahun', '1-3 tahun', '3+ tahun'],
                        'required' => true
                    ],
                    [
                        'name' => 'laptop',
                        'label' => 'Apakah Anda memiliki laptop?',
                        'type' => 'select',
                        'options' => ['Ya', 'Tidak - Saya perlu meminjam'],
                        'required' => true
                    ]
                ]
            ],
            [
                'title' => 'Summit AI & Machine Learning',
                'description' => 'Jelajahi masa depan artificial intelligence dan machine learning. Pembicara ahli akan membahas deep learning, neural networks, dan aplikasi praktis AI dalam bisnis.',
                'start_date' => now()->addDays(60)->setTime(8, 30),
                'end_date' => now()->addDays(60)->setTime(18, 0),
                'location' => 'Bali International Convention Centre, Bali',
                'capacity' => 300,
                'is_active' => true,
                'registration_open' => true,
                'registration_deadline' => now()->addDays(50),
                'custom_fields' => [
                    [
                        'name' => 'background',
                        'label' => 'Latar Belakang Profesional',
                        'type' => 'select',
                        'options' => ['Data Science', 'Software Engineering', 'Penelitian', 'Bisnis', 'Mahasiswa', 'Lainnya'],
                        'required' => true
                    ]
                ]
            ],
            [
                'title' => 'Event Tertutup - Networking VIP',
                'description' => 'Event networking eksklusif untuk pemimpin industri dan stakeholder kunci. Event ini saat ini tidak terbuka untuk pendaftaran publik.',
                'start_date' => now()->addDays(20)->setTime(19, 0),
                'end_date' => now()->addDays(20)->setTime(22, 0),
                'location' => 'Premium Hotel, Jakarta',
                'capacity' => 50,
                'is_active' => true,
                'registration_open' => false,
                'registration_deadline' => now()->addDays(15),
                'custom_fields' => []
            ]
        ];

        foreach ($events as $eventData) {
            Event::create($eventData);
        }
    }
}
