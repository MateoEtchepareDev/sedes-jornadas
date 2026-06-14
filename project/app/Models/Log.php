<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    public $timestamps = false;

    protected $fillable = ['user_id', 'event_id', 'action_type', 'actor_type', 'affected_table', 'entity_id', 'created_at'];

    protected $casts = [
        'before_data' => 'array',
        'after_data' => 'array',
    ];
}
