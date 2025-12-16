<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasOne;

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
        // Links users.id to admin_profile.user_id (1:1)
        return $this->hasOne(AdminProfile::class, 'user_id');
    }

    /**
     * Get the customer profile associated with the user.
     */
    public function customerProfile(): HasOne
    {
        // Links users.id to customer_profile.user_id (1:1)
        return $this->hasOne(CustomerProfile::class, 'user_id');
    }
    
    // --- ACCESSORS / HELPERS ---

    /**
     * Determine if the user has an Admin role.
     */
    public function isAdmin(): bool
    {
        return $this->adminProfile()->exists();
    }
    
    /**
     * Determine if the user has a Customer role.
     */
    public function isCustomer(): bool
    {
        return $this->customerProfile()->exists();
    }
}