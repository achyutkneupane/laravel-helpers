<?php

namespace AchyutN\LaravelHelpers\Traits;

use Cviebrock\EloquentSluggable\Sluggable;

trait HasTheSlug
{
    use Sluggable;
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }
}