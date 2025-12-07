<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\AdminFactory> */
    use HasFactory, Notifiable;

    protected $table = 'admins';

    protected $fillable = [
        'username',
        'password_hash',
        'role',
        'status',
        'first_name',
        'last_name',
        'last_login_at',
        'last_login_ip',
        'login_attempts',
        'locked_until',
        'password_reset_token',
        'password_reset_sent_at',
    ];

    protected $hidden = [
        'password_hash',
        'password_reset_token'
    ];

    public function getAuthPassword()
    {
        return $this->password_hash;
    }

}
