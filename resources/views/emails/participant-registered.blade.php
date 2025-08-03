<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Registration Confirmation</title>
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
            background-color: #007bff;
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
            border-left: 4px solid #007bff;
        }
        .qr-section {
            text-align: center;
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            margin: 20px 0;
        }
        .btn {
            display: inline-block;
            background-color: #007bff;
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
        <h1>Registration Confirmed!</h1>
    </div>
    
    <div class="content">
        <h2>Hello {{ $participant->name }},</h2>
        
        <p>Thank you for registering for <strong>{{ $participant->event->title }}</strong>. Your registration has been confirmed!</p>
        
        <div class="event-details">
            <h3>Event Details</h3>
            <p><strong>Event:</strong> {{ $participant->event->title }}</p>
            <p><strong>Date:</strong> {{ $participant->event->start_date->format('l, F j, Y') }}</p>
            <p><strong>Time:</strong> {{ $participant->event->start_date->format('g:i A') }} - {{ $participant->event->end_date->format('g:i A') }}</p>
            <p><strong>Location:</strong> {{ $participant->event->location }}</p>
            
            @if($participant->event->description)
                <p><strong>Description:</strong></p>
                <p>{{ $participant->event->description }}</p>
            @endif
        </div>
        
        <div class="qr-section">
            <h3>Your Event Ticket</h3>
            <p>Please save this email or access your ticket using the link below. You'll need to present your QR code at the event for check-in.</p>
            
            <a href="{{ route('ticket.show', $participant->qr_code) }}" class="btn">
                View Your Ticket
            </a>
            
            <p style="margin-top: 15px; font-size: 14px; color: #6c757d;">
                Ticket ID: {{ $participant->qr_code }}
            </p>
        </div>
        
        <h3>What to Expect</h3>
        <ul>
            <li>Arrive at the venue 15 minutes before the event starts</li>
            <li>Present your QR code (digital or printed) at the check-in desk</li>
            <li>Follow any specific instructions provided at the venue</li>
        </ul>
        
        @if($participant->event->start_date > now()->addDay())
            <div style="background-color: #d4edda; border: 1px solid #c3e6cb; border-radius: 4px; padding: 15px; margin: 20px 0;">
                <p style="margin: 0; color: #155724;">
                    <strong>Reminder:</strong> You'll receive a reminder email 24 hours before the event.
                </p>
            </div>
        @endif
        
        <p>If you have any questions about this event, please don't hesitate to contact us.</p>
        
        <p>We look forward to seeing you at the event!</p>
        
        <p>Best regards,<br>
        The {{ config('app.name') }} Team</p>
    </div>
    
    <div class="footer">
        <p>This is an automated message. Please do not reply to this email.</p>
        <p>&copy; {{ date('Y') }} {{ config('app.name') }}. All rights reserved.</p>
    </div>
</body>
</html>