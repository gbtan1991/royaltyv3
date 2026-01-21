<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SalesTransaction extends Model
{
    protected $table = 'sales_transaction';

    protected $fillable = [
        'customer_user_id',
        'admin_user_id',
        'amount',
        'points_ledger_id',

    ];

    public function customer(): BelongsTo{
        return $this->belongsTo(User::class, 'customer_user_id');
    }

    public function admin(): BelongsTo{
        return $this->belongsTo(User::class, 'admin_user_id');
    
    }

    public function pointsLedger(): BelongsTo{
        return $this->belongsTo(PointsLedger::class, 'points_ledger_id');
    }

    public function calculatePointsEarned() {

        $ratio = Settings::getVal('points_ratio', 5); // Default to 5 if not set

        $ratio = floatval($ratio) ? : 5;

        return floor($this->amount / $ratio);   
    }


    protected $casts = [
    'amount' => 'decimal:2',
    'transaction_date' => 'datetime', // <--- Add this line
    'created_at' => 'datetime',
    'updated_at' => 'datetime',
];



}


