<?php

namespace AchyutN\LaravelHelpers\Tests\Models;

use AchyutN\LaravelHelpers\Tests\Factories\ActiveFactory;
use AchyutN\LaravelHelpers\Traits\CanBeApproved;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Model;

class Active extends Model
{
    use CanBeApproved;

    protected $guarded = [];

    protected static function factory(int $count = 1): Factory
    {
        if ($count && $count > 1) {
            return ActiveFactory::times($count);
        } else {
            return ActiveFactory::new();
        }
    }
}
