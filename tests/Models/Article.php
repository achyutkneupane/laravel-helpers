<?php

namespace AchyutN\LaravelHelpers\Tests\Models;

use AchyutN\LaravelHelpers\Tests\Factories\ArticleFactory;
use AchyutN\LaravelHelpers\Traits\CanBeApproved;
use AchyutN\LaravelHelpers\Traits\CanBeInactive;
use AchyutN\LaravelHelpers\Traits\HasTheSlug;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use CanBeInactive, HasTheSlug, CanBeApproved;
    protected $guarded = [];
    protected static function factory(int $count = 1): Factory
    {
        if($count && $count > 1) {
            return ArticleFactory::times($count);
        } else {
            return ArticleFactory::new();
        }
    }
}
