<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CustomerProfile extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     * @var string
     */
    protected $table = 'customer_profile';

    /**
     * We override the primary key to 'user_id' to match the 1:1 migration structure.
     * @var string
     */
    protected $primaryKey = 'user_id';
    public $incrementing = false;
    protected $keyType = 'int';

    protected $fillable = [
        'user_id',
        'member_id',
        'loyalty_tier',
        'last_activity_at',
        'registered_by_admin_user_id',
    ];
    
    // --- RELATIONSHIPS ---

    /**
     * Get the core identity user that owns the customer profile.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Get the admin user who registered this customer (the audit link).
     */
    public function registeredBy(): BelongsTo
    {
        // Links customer_profile.registered_by_admin_user_id to users.id
        return $this->belongsTo(User::class, 'registered_by_admin_user_id');
    }

    public function pointsLedger()
{
    // Points are linked by user_id
    return $this->hasMany(PointsLedger::class, 'user_id', 'user_id');
}
}