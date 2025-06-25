<?php

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use AchyutN\LaravelHelpers\Traits\HasTheMedia;

abstract class MediaModel extends Model implements HasMedia
{
    use HasTheMedia;
}