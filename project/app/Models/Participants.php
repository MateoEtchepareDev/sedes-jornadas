<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;


class Participants extends Model
{
    protected $fillable = [
        'event_id',
        'full_name',
        'dni',
        'email',
        'modality',
        'payment_status',
        'payment_external_id',
        'qr_token',
        'checkin_confirmed',
        'access_code',
        'questions_completed',
        'registered_at',
        'paid_at'
    ];

    public function event()
    {
        return $this->belongsTo(Events::class);
    }
}
