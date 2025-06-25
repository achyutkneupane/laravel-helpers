<?php

namespace AchyutN\LaravelHelpers\Traits;

use Cviebrock\EloquentSluggable\Sluggable;

trait HasTheSlug
{
    use Sluggable;

    /**
     * Column name to generate the slug from.
     * You can override this in your model.
     *
     * @var string
     */
    protected string $sluggableColumn = 'title';

    /**
     * Get the configuration array for sluggable.
     */
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => $this->getSluggableColumn()
            ]
        ];
    }

    /**
     * Get the sluggable column value.
     */
    public function getSluggableColumn(): string
    {
        return property_exists($this, 'sluggableColumn') ? $this->sluggableColumn : 'title';
    }
}