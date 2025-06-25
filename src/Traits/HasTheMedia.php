<?php

namespace AchyutN\LaravelHelpers\Traits;

use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

trait HasTheMedia
{
    use InteractsWithMedia;

    /**
     * The media collections to register accessors for.
     *
     * @var array<string>
     */
    public array $collections = ['cover'];

    public function __call(string $method, array $parameters)
    {
        foreach ($this->collections as $collection) {
            foreach (['original', 'small', 'medium', 'big'] as $conversion) {
                $expected = $conversion === 'original' ? $collection : "{$conversion}_{$collection}";

                if ($method === $expected) {
                    return $this->getMediaUrlFrom($collection, $conversion);
                }
            }
        }

        return parent::__call($method, $parameters);
    }

    public function getMediaUrlFrom(string $collection, string $conversion = 'original'): ?string
    {
        $media = $this->getMedia($collection)->last();

        return $media ? $media->getUrl($conversion) : null;
    }

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('original')
            ->format('webp')
            ->nonQueued();
        $this->addMediaConversion('small')
            ->format('webp')
            ->width(150)
            ->height(80)
            ->nonQueued();
        $this->addMediaConversion('medium')
            ->format('webp')
            ->width(300)
            ->height(160)
            ->nonQueued();
        $this->addMediaConversion('big')
            ->format('webp')
            ->width(800)
            ->height(420)
            ->nonQueued();
    }
}