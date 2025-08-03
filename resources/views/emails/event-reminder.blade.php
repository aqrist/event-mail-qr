<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Event Reminder</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }
        .header {
            background-color: #28a745;
            color: white;
            text-align: center;
            padding: 20px;
            border-radius: 8px 8px 0 0;
        }
        .content {
            background-color: #f8f9fa;
            padding: 30px;
            border-radius: 0 0 8px 8px;
        }
        .event-details {
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            margin: 20px 0;
            border-left: 4px solid #28a745;
        }
        .countdown {
            text-align: center;
            background-color: #fff3cd;
            border: 1px solid #ffeaa7;
            border-radius: 8px;
            padding: 20px;
            margin: 20px 0;
        }
        .btn {
            display: inline-block;
            background-color: #28a745;
            color: white;
            text-decoration: none;
            padding: 12px 24px;
            border-radius: 4px;
            margin: 10px 0;
        }
        .footer {
            text-align: center;
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid #dee2e6;
            color: #6c757d;
            font-size: 14px;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Event Reminder</h1>
        <p>Don't forget about your upcoming event!</p>
    </div>
    
    <div class="content">
        <h2>Hello {{ $participant->name }},</h2>
        
        <p>This is a friendly reminder that you're registered for <strong>{{ $participant->event->title }}</strong>, which is happening soon!</p>
        
        <div class="countdown">
            <h3 style="margin-top: 0; color: #856404;">⏰ Event starts in less than 24 hours!</h3>
            <p style="margin-bottom: 0; font-size: 18px; font-weight: bold;">
                {{ $participant->event->start_date->format('l, F j, Y \a\t g:i A') }}
            </p>
        </div>
        
        <div class="event-details">
            <h3>Event Details</h3>
            <p><strong>Event:</strong> {{ $participant->event->title }}</p>
            <p><strong>Date:</strong> {{ $participant->event->start_date->format('l, F j, Y') }}</p>
            <p><strong>Time:</strong> {{ $participant->event->start_date->format('g:i A') }} - {{ $participant->event->end_date->format('g:i A') }}</p>
            <p><strong>Location:</strong> {{ $participant->event->location }}</p>
        </div>
        
        <h3>Important Reminders</h3>
        <ul>
            <li><strong>Arrive early:</strong> Please arrive 15 minutes before the event starts</li>
            <li><strong>Bring your ticket:</strong> You'll need your QR code for check-in</li>
            <li><strong>Check traffic:</strong> Plan your route and allow extra time for travel</li>
            @if($participant->phone)
                <li><strong>Contact info:</strong> Keep your phone handy in case we need to reach you</li>
            @endif
        </ul>
        
        <div style="text-align: center; margin: 30px 0;">
            <a href="{{ route('ticket.show', $participant->qr_code) }}" class="btn">
                View Your Ticket
            </a>
        </div>
        
        @if(!$participant->is_attended)
            <div style="background-color: #d1ecf1; border: 1px solid #bee5eb; border-radius: 4px; padding: 15px; margin: 20px 0;">
                <p style="margin: 0; color: #0c5460;">
                    <strong>Quick Check-in:</strong> Save time at the event by having your QR code ready on your phone or printed out.
                </p>
            </div>
        @endif
        
        <p>We're excited to see you at the event!</p>
        
        <p>If you can no longer attend or have any questions, please let us know as soon as possible.</p>
        
        <p>Best regards,<br>
        The {{ config('app.name') }} Team</p>
    </div>
    
    <div class="footer">
        <p>This is an automated reminder. Please do not reply to this email.</p>
        <p>&copy; {{ date('Y') }} {{ config('app.name') }}. All rights reserved.</p>
    </div>
</body>
</html>