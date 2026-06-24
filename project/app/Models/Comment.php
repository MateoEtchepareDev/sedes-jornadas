<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable =[
        'participant_id',
        'full_name',
        'message'
    ];
    public function participant()
    {
        return $this->belongsTo(Participant::class);
    }
}
?>