<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

class Participant extends Model
{
    protected $fillable = [
        'event_id',
        'name',
        'email',
        'phone',
        'additional_data',
        'qr_code',
        'is_attended',
        'attended_at',
        'email_sent',
    ];

    protected $casts = [
        'is_attended' => 'boolean',
        'attended_at' => 'datetime',
        'email_sent' => 'boolean',
        'additional_data' => 'array',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($participant) {
            if (!$participant->qr_code) {
                $participant->qr_code = Str::uuid();
            }
        });
    }

    public function event(): BelongsTo
    {
        return $this->belongsTo(Event::class);
    }

    public function markAsAttended(): void
    {
        $this->update([
            'is_attended' => true,
            'attended_at' => now(),
        ]);
    }

    public function getQrUrlAttribute(): string
    {
        return route('attendance.scan', $this->qr_code);
    }
}
