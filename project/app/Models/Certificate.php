<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Certificate extends Model
{
    protected $fillable = ['participant_id', 'event_id', 'certificate_url', 'issued_at'];
    public function participant()
    {
        return $this->belongsTo(Participant::class);
    }
    public function event()
    {
        return $this->belongsTo(Event::class);
    }
}
