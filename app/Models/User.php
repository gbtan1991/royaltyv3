<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = ['name', 'email', 'password'];

    protected $hidden = ['password', 'remember_token'];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password'          => 'hashed',
    ];

    public function customers()
    {
        return $this->hasMany(Customer::class, 'created_by');
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class, 'recorded_by');
    }

    public function redemptions()
    {
        return $this->hasMany(Redemption::class, 'redeemed_by');
    }
}
