<?php

namespace AchyutN\LaravelHelpers\Tests\Models;

use AchyutN\LaravelHelpers\Tests\Factories\ApproveActiveFactory;
use AchyutN\LaravelHelpers\Traits\CanBeApproved;
use AchyutN\LaravelHelpers\Traits\CanBeInactive;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Model;

class ApproveActive extends Model
{
    use CanBeInactive, CanBeApproved;

    protected $table = 'approve_active';

    protected $guarded = [];

    protected static function factory(int $count = 1): Factory
    {
        if ($count && $count > 1) {
            return ApproveActiveFactory::times($count);
        } else {
            return ApproveActiveFactory::new();
        }
    }
}
