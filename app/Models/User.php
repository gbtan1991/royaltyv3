<?php

namespace App\Models;

use App\Models\CustomerProfile;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The table associated with the model.
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     * @var array<int, string>
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'birth_date',
        'access_key',
        'gender',
        'is_active',
    ];
    
    // --- RELATIONSHIPS ---

    /**
     * Get the admin profile associated with the user.
     */
  public function adminProfile(): HasOne
    {
        return $this->hasOne(AdminProfile::class, 'user_id');
    }

    /**
     * Get the customer profile associated with the user.
     * (One-to-One Identity Mapping)
     */
    public function customerProfile(): HasOne
    {
        return $this->hasOne(CustomerProfile::class, 'user_id');
    }

    // --- RELATIONSHIPS (Audit Trail) ---

    /**
     * If this user is an admin, get the list of customers they registered.
     * (One-to-Many Audit Mapping)
     */
    public function registeredCustomers(): HasMany
    {
        return $this->hasMany(CustomerProfile::class, 'registered_by_admin_user_id');
    }

    // --- ACCESSORS / HELPERS ---

    /**
     * Determine if the user has an Admin profile.
     * Optimized to check loaded properties first to save SQL queries.
     */
    public function isAdmin(): bool
    {
        return !is_null($this->adminProfile);
    }

    /**
     * Determine if the user has a Customer profile.
     */
    public function isCustomer(): bool
    {
        return !is_null($this->customerProfile);
    }

    /**
     * Get the full name of the user.
     * Usage: $user->full_name
     */
    public function getFullNameAttribute(): string
    {
        return "{$this->first_name} {$this->last_name}";
    }
}