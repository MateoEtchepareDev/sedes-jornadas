<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Users extends Authenticatable
{
    use Notifiable;

    protected $table = 'users';

    protected $fillable = [
        'name',
        'email',
        'password_hash',
        'is_admin',
    ];

    protected $hidden = [
        'password_hash',
    ];

    /**
     * Laravel buscará la contraseña aquí
     * en lugar de usar la columna "password".
     */
    public function getAuthPassword(): string
    {
        return $this->password_hash;
    }
}