<?php

use App\Models\Setting;
use App\Services\PointsCalculator;

it('awards 1 point per unit by default', function () {
    Setting::set('points_per_unit', 1);

    $pts = app(PointsCalculator::class)->calculate(100.00);

    expect($pts)->toBe(100);
});

it('floors fractional points', function () {
    Setting::set('points_per_unit', 1);

    expect(app(PointsCalculator::class)->calculate(100.50))->toBe(100);
});

it('respects a custom rate', function () {
    Setting::set('points_per_unit', 1.5);

    expect(app(PointsCalculator::class)->calculate(200.00))->toBe(300);
});

it('floors fractional result at custom rate', function () {
    Setting::set('points_per_unit', 1.5);

    // 99.99 * 1.5 = 149.985 → floor → 149
    expect(app(PointsCalculator::class)->calculate(99.99))->toBe(149);
});

it('reads the rate live from settings without caching', function () {
    Setting::set('points_per_unit', 1);
    $calc = app(PointsCalculator::class);

    expect($calc->calculate(100.00))->toBe(100);

    Setting::set('points_per_unit', 2);

    expect($calc->calculate(100.00))->toBe(200);
});

it('returns zero for zero amount', function () {
    Setting::set('points_per_unit', 5);

    expect(app(PointsCalculator::class)->calculate(0))->toBe(0);
});
