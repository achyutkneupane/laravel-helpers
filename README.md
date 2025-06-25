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

`Note: ` You must have `slug` column in your table. 

```php
<?php

namespace App\Models;

use AchyutN\Traits\HasTheSlug;

class Post extends Model
{
    use HasTheSlug;

    protected string $sluggableColumn = 'name';
}
```

---

#### `HasTheMedia`

This trait is used to add media conversions over the `HasMedia` trait from [spatie/laravel-medialibrary](https://github.com/spatie/laravel-medialibrary) package.

```php

namespace App\Models;

use AchyutN\LaravelHelpers\Traits\HasTheMedia;
use Spatie\MediaLibrary\HasMedia;

class Post extends Model implements HasMedia
{
    use HasTheMedia;
}
```

or alternatively, you can extend your model using the `MediaModel` class provided by the package:

```php

namespace App\Models;

use AchyutN\LaravelHelpers\Models\MediaModel;

class Post extends MediaModel
{
    //
}
```

You can use: 
- `cover()` to get original image (in format: `WebP`).
- `small_cover()` to get small image (in format: `WebP`).
- `medium_cover()` to get medium image (in format: `WebP`).
- `large_cover()` to get large image (in format: `WebP`).

---

#### `HasTheDashboardTraits`

This trait is used to add `HasTheSlug` and `HasTheMedia` traits to your model.

```php
<?php

namespace App\Models;

use AchyutN\LaravelHelpers\Traits\HasTheDashboardTraits;

class Post extends Model
{
    use HasTheDashboardTraits;
}
```

---

#### `CanBeApproved`

This trait adds **approval logic** to your Eloquent models using timestamp-based flags (`approved_at`, `rejected_at`). By default, only **approved** records are returned in queries due to a global scope.


Make sure your model's table includes `approved_at` and `rejected_at` columns:

```php
Schema::table('posts', function (Blueprint $table) {
    $table->timestamp('approved_at')->nullable();
    $table->timestamp('rejected_at')->nullable();
});
```

Then, use the trait in your model:

```php
use AchyutN\LaravelHelpers\Traits\CanBeApproved;

class Post extends Model
{
    use CanBeApproved;
}
```

##### Methods

| Method         | Description                                                                |
|----------------|----------------------------------------------------------------------------|
| `setApproved()`| Marks the model as approved (sets `approved_at`, clears `rejected_at`)     |
| `setRejected()`| Marks the model as rejected (sets `rejected_at`, clears `approved_at`)     |
| `setPending()` | Resets approval state (clears both `approved_at` and `rejected_at`)        |

```php
$post->setApproved();
$post->setRejected();
$post->setPending();
```

##### Scope

The trait adds a global scope to only include **approved** records. You can override it using the following query macros:

| Macro               | Description                                                  |
|---------------------|--------------------------------------------------------------|
| `withPending()`     | Includes approved and pending records                        |
| `onlyPending()`     | Only records where both `approved_at` and `rejected_at` are `null` |
| `withoutApproved()` | Records that are **not** approved (includes pending & rejected) |
| `withRejected()`    | Rejected records (`rejected_at` not null, `approved_at` null)|
| `onlyRejected()`    | Strictly rejected records (regardless of previous approval)  |
| `withAll()`         | Removes global scope and returns all records                 |

```php
Post::withPending()->get();
Post::onlyPending()->get();
Post::withoutApproved()->get();
Post::withRejected()->get();
Post::onlyRejected()->get();
Post::withAll()->count();
```

##### Custom Column Names

You can override the default column names by defining constants in your model:

```php
class Post extends Model
{
    use CanBeApproved;

    public const APPROVED_AT = 'approved_time';
    public const REJECTED_AT = 'rejected_time';
}
```

---

#### `CanBeInactive`

This trait allows Eloquent models to be marked as **inactive** or **active**, using a nullable `inactive_at` timestamp column. By default, only **active** models are returned from queries due to a global scope.

##### Setup

Ensure your model's table includes an `inactive_at` column:

```php
Schema::table('articles', function (Blueprint $table) {
    $table->timestamp('inactive_at')->nullable();
});
```

Then, use the trait in your model:

```php
use AchyutN\LaravelHelpers\Traits\CanBeInactive;

class Article extends Model
{
    use CanBeInactive;
}
```

##### Methods

| Method         | Description                                                       |
|----------------|-------------------------------------------------------------------|
| `setInactive()`| Marks the model as inactive (sets `inactive_at` to current time)  |
| `setActive()`  | Marks the model as active (clears the `inactive_at` column)       |

```php
$article->setInactive();
$article->setActive();
```

##### Scopes

This trait applies a global scope to include **only active** models by default. Use the following macros to override:

| Macro               | Description                                                  |
|---------------------|--------------------------------------------------------------|
| `withInactive()`    | Includes both active and inactive models                     |
| `withoutInactive()` | Excludes inactive models (same as default scope)             |
| `onlyInactive()`    | Returns only inactive models                                 |

```php
Article::withInactive()->get();
Article::onlyInactive()->get();
Article::withoutInactive()->count();
```

##### Custom Column Name

You can override the column name by defining a constant in your model:

```php
class Article extends Model
{
    use CanBeInactive;

    public const INACTIVE_AT = 'disabled_at';
}
```

---

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

---

### Validations

#### LatitudeRule

This rule ensures that the given value is a **numeric latitude** within the valid range `-90` to `90`.

```php
use AchyutN\LaravelHelpers\Rules\LatitudeRule;

$request->validate([
    'latitude' => [new LatitudeRule()],
]);
```

---

#### LongitudeRule

This rule ensures that the given value is a **numeric longitude** within the valid range `-180` to `180`.

```php
use AchyutN\LaravelHelpers\Rules\LongitudeRule;

$request->validate([
    'longitude' => [new LongitudeRule()],
]);
```
