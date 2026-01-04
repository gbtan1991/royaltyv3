<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PointsLedger extends Model
{
    protected $table = 'points_ledger';
    public $timestamps = false;

    protected $fillable = [
        'user_id',
        'points_amount',
        'source_type',
        'source_id',
        'description'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
}
