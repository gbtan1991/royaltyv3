<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AdminProfile extends Model
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
        'password_hash',
        'last_login_at',
        'role',
        'status',
    ];
    
    // --- RELATIONSHIPS ---

    /**
     * Get the core identity user that owns the admin profile.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}