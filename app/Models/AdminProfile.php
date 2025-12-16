<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AdminProfile extends Authenticatable
{
    use HasFactory;

    /**
     * The table associated with the model.
     * @var string
     */
    protected $table = 'admin_profile';

    /**
     * We override the primary key to 'user_id' to match the 1:1 migration structure.
     * @var string
     */
    protected $primaryKey = 'user_id';
    public $incrementing = false; // Key is managed by the User table
    protected $keyType = 'int';

    protected $fillable = [
        'user_id',
        'employee_id',
        'username',
        'last_login_at',
        'role',
        'status',
    ];

    /**
     * Hide the password hash from JSON responses for security.
     */
    protected $hidden = [
        'password_hash',
    ];


    /**
     * Tells Laravel to use 'password_hash' instead of 'password' 
     * when checking credentials during login.
     */
    public function getAuthPassword()
    {
        return $this->password_hash;
    }


    // --- RELATIONSHIPS ---

    /**
     * Get the core identity user that owns the admin profile.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}