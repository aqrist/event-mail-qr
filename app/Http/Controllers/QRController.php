<?php

namespace App\Http\Controllers;

use App\Models\Participant;
use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class QRController extends Controller
{
    public function generateQR($participantId)
    {
        $participant = Participant::findOrFail($participantId);
        
        $qrCode = QrCode::size(300)
            ->generate(route('attendance.scan', $participant->qr_code));
        
        return response($qrCode)
            ->header('Content-Type', 'image/svg+xml');
    }
    
    public function scanQR($qrCode)
    {
        $participant = Participant::where('qr_code', $qrCode)->firstOrFail();
        
        if ($participant->is_attended) {
            return view('qr.already-attended', compact('participant'));
        }
        
        $participant->markAsAttended();
        
        return view('qr.success', compact('participant'));
    }
    
    public function showQRTicket($qrCode)
    {
        $participant = Participant::where('qr_code', $qrCode)->firstOrFail();
        
        return view('qr.ticket', compact('participant'));
    }
}
