<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Participants;
use Database\Factories\EventFactory;

class Event extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'title',
        'description',
        'price',
        'stream_url',
        'registration_opens_at',
        'registration_closes_at',
        'event_starts_at',
        'event_ends_at',
        'max_participants',
        'status'
    ];
    
    public function participants()
    {
        return $this->hasMany(Participants::class);
    }

    protected static function newFactory()
    {
        return EventFactory::new();
    }

}
