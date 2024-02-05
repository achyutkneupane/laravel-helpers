<?php

namespace AchyutN\LaravelHelpers\Tests\Routes;

use AchyutN\LaravelHelpers\Rules\LatitudeRule;
use AchyutN\LaravelHelpers\Rules\LongitudeRule;
use AchyutN\LaravelHelpers\Tests\BaseTestCase;
use Illuminate\Http\Request;

class LatLongRoutes extends BaseTestCase
{
    public static function setupLatLongRoutes($router): void
    {
        $router->post('lat-long', function (Request $request) {
            $validated = $request->validate([
                'latitude' => new LatitudeRule,
                'longitude' => new LongitudeRule
            ]);
            return response()->json($validated);
        });
    }
}