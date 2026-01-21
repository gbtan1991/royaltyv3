<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Settings extends Model
{
    use HasFactory;


    /**
     * The attributes that are mass assignable.
     */

    protected $fillable = [
        'key',
        'value',
        'description',
    ];

    public static function getVal(string $key, $default = null) 
    {
        $setting = self::where('key', $key)->first();

        return $setting ? $setting->value : $default;
    }
}
