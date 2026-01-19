<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PointsLedger extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     * * @var string
     */
    protected $table = 'points_ledger';

    /**
     * Indicates if the model should be timestamped.
     * Since your table uses 'ledger_date' instead of 'created_at', 
     * we set this to false to prevent Laravel from looking for default columns.
     * * @var bool
     */
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'points_amount',
        'source_type',
        'source_id',
        'description',
        'ledger_date',
    ];

    /**
     * The attributes that should be cast.
     * This ensures 'ledger_date' is treated as a Carbon instance
     * so you can use ->format() in your Blade views.
     *
     * @var array
     */
    protected $casts = [
        'ledger_date' => 'datetime',
        'points_amount' => 'decimal:2',
    ];

    /**
     * Get the Customer (User) associated with this ledger entry.
     * Mapping: user_id -> users.id
     */
    public function customer(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Get the specific Sales Transaction linked to this entry.
     * Mapping: source_id -> sales_transactions.id
     */
    public function salesTransaction(): BelongsTo
    {
        return $this->belongsTo(SalesTransaction::class, 'source_id');
    }

    /**
     * Scope helper to easily filter by type (e.g., TRANSACTION, REDEMPTION)
     */
    public function scopeOfSource($query, $type)
    {
        return $query->where('source_type', $type);
    }
}