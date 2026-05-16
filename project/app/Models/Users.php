<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

#[Fillable(['full_name', 'email', 'password_hash', 'is_admin'])]

class Users extends Model
{
    //
}
