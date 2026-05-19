<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Events extends Model
{
    protected $fillable = ['title', 'description', 'price', 'stream_url', 'registration_opens_at',
        'registration_closes_at', 'event_starts_at', 'event_ends_at', 'max_participants', 'status'];
}
