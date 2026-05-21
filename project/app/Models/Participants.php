<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

#[Fillable(['event_id', 'full_name', 'dni', 'email', 'modality', 'payment_status', 'payment_external_id', 
'qr_token', 'checkin_confirmed', 'access_code', 'questions_completed', 'registered_at', 'paid_at'])]

class Participants extends Model
{
    protected $table = 'participants';

    protected $fillable = 

    [
        'event_id',
        'full_name',
        'dni',
        'email',
        'role',
        'modality',
        'payment_status',
        'payment_method',
        'payment_external_id',
        'qr_token',
        'checkin_confirmed',
        'access_code',
        'questions_completed',
        'registered_at',
        'paid_at'
    ];
}
