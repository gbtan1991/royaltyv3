<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Redemption extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id',
        'reward_id',
        'redeemed_by',
        'points_spent',
        'status',
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function reward()
    {
        return $this->belongsTo(Reward::class);
    }

    public function redeemedBy()
    {
        return $this->belongsTo(User::class, 'redeemed_by');
    }
}
