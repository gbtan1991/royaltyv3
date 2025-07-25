<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    /** @use HasFactory<\Database\Factories\AdminFactory> */
    use HasFactory;

    protected $guard = 'admin';

protected $fillable = [
    'username',
    'first_name',
    'last_name',
    'date_of_birth',
    'email',
    'password',
    'admin_type',
    'account_status',
    'last_login_at',
    
];

    protected $hidden = [
        'password',
        'remember_token',
    
    ];

    protected $casts = [
        'date_of_birth' => 'date',
        'last_login_at' => 'datetime',
    ];
}
