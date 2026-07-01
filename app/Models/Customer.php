<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'phone',
        'member_number',
        'loyalty_tier',
        'is_active',
        'created_by',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    // --- Relationships ---

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }

    public function redemptions()
    {
        return $this->hasMany(Redemption::class);
    }

    // --- Accessors ---

    protected function fullName(): Attribute
    {
        return Attribute::make(
            get: fn () => "{$this->first_name} {$this->last_name}",
        );
    }

    // --- Points balance: derived from transactions minus completed redemptions ---

    public function pointsBalance(): int
    {
        $earned = $this->transactions()->sum('points_earned');
        $spent  = $this->redemptions()->where('status', 'completed')->sum('points_spent');

        return max(0, $earned - $spent);
    }

    // Eager-load-friendly version using already-loaded relations (avoids N+1 in lists)
    public function pointsBalanceFromLoaded(): int
    {
        $earned = $this->relationLoaded('transactions')
            ? $this->transactions->sum('points_earned')
            : $this->transactions()->sum('points_earned');

        $spent = $this->relationLoaded('redemptions')
            ? $this->redemptions->where('status', 'completed')->sum('points_spent')
            : $this->redemptions()->where('status', 'completed')->sum('points_spent');

        return max(0, $earned - $spent);
    }
}
