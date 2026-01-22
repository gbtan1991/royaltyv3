<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rewards extends Model
{
    /** @use HasFactory<\Database\Factories\RewardsFactory> */
    use HasFactory;

    protected $fillable = ['name', 'description', 'points_cost', 'stock_quantity', 'is_active', 'image_path'];

    // Scope to only show available rewards to customers
    public function scopeActive($query)
    {
        return $query->where('is_active', true)->where('stock_quantity', '>', 0);
    }
}
