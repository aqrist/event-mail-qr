<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Event extends Model
{
    protected $fillable = [
        'title',
        'description',
        'start_date',
        'end_date',
        'location',
        'image',
        'capacity',
        'is_active',
        'registration_open',
        'registration_deadline',
        'custom_fields',
    ];

    protected $casts = [
        'start_date' => 'datetime',
        'end_date' => 'datetime',
        'registration_deadline' => 'datetime',
        'is_active' => 'boolean',
        'registration_open' => 'boolean',
        'custom_fields' => 'array',
    ];

    public function participants(): HasMany
    {
        return $this->hasMany(Participant::class);
    }

    public function attendedParticipants(): HasMany
    {
        return $this->hasMany(Participant::class)->where('is_attended', true);
    }

    public function getAvailableSlotsAttribute(): int
    {
        if (!$this->capacity) {
            return PHP_INT_MAX;
        }
        
        return $this->capacity - $this->participants()->count();
    }

    public function getIsFullAttribute(): bool
    {
        return $this->capacity && $this->participants()->count() >= $this->capacity;
    }
}
