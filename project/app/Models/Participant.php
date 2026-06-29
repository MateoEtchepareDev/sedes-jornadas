<?php

namespace App\Models;
use App\Models\Event;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;


class Participant extends Model
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

    protected static function booted()
    {
        static::creating(function ($model) {
            if (!$model->uuid) {
                $model->uuid = (string) Str::uuid();
            }
        });
    }


    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    public function getRouteKeyName()
    {
        return 'id';
    }

    public function canDownloadCertificate(): bool
    {
        if ($this->payment_status !== 'approved') {
            return false;
        }

        if ($this->modality === 'in_person') {
            return (bool) $this->checkin_confirmed;
        }

        if ($this->modality === 'virtual') {
            return (bool) $this->questions_completed;
        }

        return false;
    }
}
