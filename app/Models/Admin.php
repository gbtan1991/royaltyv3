<?php

namespace App\Models;

use Illuminate\Support\Facades\Hash;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\AdminFactory> */
    use Notifiable;
    use HasFactory;

    protected $fillable = [
        'username',
        'password',
        'first_name',
        'last_name',
        'birthdate',
        'account_type',
        'account_status',
        'avatar',


    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function setPasswordAttribute($value)
    {
        if(!empty($value)){
            $this->attributes['password'] = Hash::make($value);

        }
    }


    public function getFullNameAttribute()
    {
        return "{$this->first_name} {$this->last_name}";
    }
};
