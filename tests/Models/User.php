<?php

namespace AchyutN\LaravelHelpers\Tests\Models;

use AchyutN\LaravelHelpers\Tests\Factories\UserFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\Factory;

class User extends Authenticatable
{
    protected $guarded = [];

    protected static function factory(int $count = 1): Factory
    {
        if ($count && $count > 1) {
            return UserFactory::times($count);
        } else {
            return UserFactory::new();
        }
    }
}
