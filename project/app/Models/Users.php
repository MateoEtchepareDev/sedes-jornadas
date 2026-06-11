<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

#[Fillable(['name', 'email', 'password_hash', 'is_admin'])]

class Users extends Model
{
    protected $fillable = ['name', 'email', 'password_hash', 'is_admin'];
}
