<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SalesTransaction extends Model
{
    protected $table = 'sales_transaction';

    protected $fillable = [
        'customer_user_id',
        'admin_user_id',
        'amount',
        'points_ledger_id',

    ];

    protected function customer(){
        return $this->belongsTo(User::class, 'customer_user_id');
    }

    protected function admin(){
        return $this->belongsTo(User::class, 'admin_user_id');
    
    }

    public function pointsLedger(){
        return $this->belongsTo(PointsLedger::class);
    }
}
