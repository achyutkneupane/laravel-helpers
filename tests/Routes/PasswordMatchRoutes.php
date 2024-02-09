<?php

namespace AchyutN\LaravelHelpers\Tests\Routes;

use AchyutN\LaravelHelpers\Rules\MatchOldPassword;
use AchyutN\LaravelHelpers\Tests\BaseTestCase;
use Illuminate\Http\Request;

class PasswordMatchRoutes extends BaseTestCase
{
    public static function setupPasswordMatchRoutes($router): void
    {
        $router->post('change-password', function (Request $request) {
            $validated = $request->validate([
                'password' => new MatchOldPassword
            ]);
            return response()->json($validated);
        });
    }
}
