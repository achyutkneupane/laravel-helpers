# Laravel Helpers

[![Lint PR](https://github.com/achyutkneupane/laravel-helpers/actions/workflows/prlint.yml/badge.svg)](https://github.com/achyutkneupane/laravel-helpers/actions/workflows/prlint.yml)
[![Bump version](https://github.com/achyutkneupane/laravel-helpers/actions/workflows/tagrelease.yml/badge.svg)](https://github.com/achyutkneupane/laravel-helpers/actions/workflows/tagrelease.yml)
[![Latest Stable Version](http://poser.pugx.org/achyutn/laravel-helpers/v)](https://packagist.org/packages/achyutn/laravel-helpers)
[![Total Downloads](http://poser.pugx.org/achyutn/laravel-helpers/downloads)](https://packagist.org/packages/achyutn/laravel-helpers)
[![Dependents](http://poser.pugx.org/achyutn/laravel-helpers/dependents)](https://packagist.org/packages/achyutn/laravel-helpers)

## Installation

You can install the package via composer:

```bash
composer require achyutn/laravel-helpers
```

## Usage

### Traits

You can use following traits for your models:

#### `HasTheSlug`

This trait is used to generate slug for your model. It uses [cviebrock/eloquent-sluggable](https://github.com/cviebrock/eloquent-sluggable) package.

`Note: ` You must have `slug` column in your table and the source column for the slug should be `title`. 

```php
<?php

namespace App\Models;

use AchyutN\Traits\HasTheSlug;

class Post extends Model
{
    use HasTheSlug;
}
```

#### `HasTheMedia`

This trait is used to add media conversions over the `HasMedia` trait from [spatie/laravel-medialibrary](https://github.com/spatie/laravel-medialibrary) package.

```php

namespace App\Models;

use AchyutN\Traits\HasTheMedia;
use Spatie\MediaLibrary\HasMedia;

class Post extends Model implements HasMedia
{
    use HasTheMedia;
}
```

You can use: 
- `cover()` to get original image (in format: `WebP`).
- `small_cover()` to get small image (in format: `WebP`).
- `medium_cover()` to get medium image (in format: `WebP`).
- `large_cover()` to get large image (in format: `WebP`).

#### `HasTheDashboardTraits`

This trait is used to add `HasTheSlug` and `HasTheMedia` traits to your model.

```php
<?php

namespace App\Models;

use AchyutN\Traits\HasTheDashboardTraits;

class Post extends Model
{
    use HasTheDashboardTraits;
}
```

### Nepali Helpers

You can simply use following helper functions:

#### `english_nepali_number`

Converts english number to nepali number.

```php
<?php

echo(english_nepali_number('१ २३४५६७८०९', 'en')); // 1 234567890

echo(english_nepali_number('1 234567890', 'ne')); // १ २३४५६७८०९
```

#### `english_nepali`

To select value based on the locale.

```php
<?php

echo(english_nepali('नेपाली', 'Nepali', 'en')); // Nepali
echo(english_nepali('नेपाली', 'Nepali', 'ne')); // नेपाली
```