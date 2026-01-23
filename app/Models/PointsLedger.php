<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PointsLedger extends Model
{
    use HasFactory;

    protected $table = 'points_ledger';

    public $timestamps = false;

    protected $fillable = [
        'user_id',
        'points_amount',
        'source_type',
        'source_id',
        'description',
        'ledger_date',
    ];

    protected $casts = [
        'ledger_date' => 'datetime',
        'points_amount' => 'decimal:2',
    ];

    /**
     * Corrected Relationship:
     * PointsLedger belongs to a CustomerProfile.
     * From there, we can reach the User details.
     */
    public function customer(): BelongsTo
    {
        // We link points_ledger.user_id to customer_profile.user_id
        return $this->belongsTo(CustomerProfile::class, 'user_id', 'user_id');
    }

    public function salesTransaction(): BelongsTo
    {
        return $this->belongsTo(SalesTransaction::class, 'source_id');
    }

    public function scopeOfSource($query, $type)
    {
        return $query->where('source_type', $type);
    }
}