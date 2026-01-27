<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
// MISTAKE FIX: You must import this to use : BelongsTo
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Redemption extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_user_id', // Make sure this matches your MIGRATION exactly
        'reward_id',
        'points_spent',
        'status',
    ];

    public function user(): BelongsTo
    {
        // Specifying 'customer_user_id' here is correct since it's non-standard
        return $this->belongsTo(User::class, 'customer_user_id');
    }

    public function reward(): BelongsTo
    {
        return $this->belongsTo(Rewards::class, 'reward_id');
    }
}