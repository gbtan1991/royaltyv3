<?php

namespace App\Services;

use App\Models\Setting;

class PointsCalculator
{
    /**
     * Calculate points earned for a given payment amount.
     *
     * The rate is stored in settings as 'points_per_unit':
     *   1   = 1 point per 1 currency unit  (e.g. ₱1 → 1 pt)
     *   0.1 = 1 point per ₱10
     *   0.01= 1 point per ₱100
     *
     * Result is always floored to a whole number.
     */
    public function calculate(float $amount): int
    {
        $rate = (float) Setting::get('points_per_unit', 1);

        return (int) floor($amount * $rate);
    }
}
