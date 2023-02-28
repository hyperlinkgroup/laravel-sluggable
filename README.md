# Slugs for Laravel - laravel-sluggable

[![Latest Version on Packagist](https://img.shields.io/packagist/v/hyperlink/laravel-sluggable.svg?style=flat-square)](https://packagist.org/packages/hyperlink/laravel-sluggable)
[![GitHub Tests Action Status](https://img.shields.io/github/actions/workflow/status/hyperlinkgroup/laravel-sluggable/run-tests.yml?branch=main&label=tests&style=flat-square)](https://github.com/hyperlinkgroup/laravel-sluggable/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/actions/workflow/status/hyperlinkgroup/laravel-sluggable/fix-php-code-style-issues.yml?branch=main&label=code%20style&style=flat-square)](https://github.com/hyperlinkgroup/laravel-sluggable/actions?query=workflow%3A"Fix+PHP+code+style+issues"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/hyperlink/laravel-sluggable.svg?style=flat-square)](https://packagist.org/packages/hyperlink/laravel-sluggable)

Create permanent seo friendly slugs for every model

## Installation

You can install the package via composer:

```bash
composer require hyperlink/laravel-sluggable
```

You can publish and run the migrations with:

```bash
php artisan vendor:publish --tag="laravel-sluggable-migrations"
php artisan migrate
```

You can publish the config file with:

```bash
php artisan vendor:publish --tag="laravel-sluggable-config"
```

This is the contents of the published config file:

```php
return [
    /*
     * The name of the table that will store the slugs.
     */
    'table' => 'slugs',

    /*
     * The name of the column that will store the slug.
     */
    'column' => 'slug',

    /*
     * The separator used to separate words in the slug.
     * ATTENTION: If you change this value
     * no existing slugs will be changed.
     */
    'separator' => '-',

    /*
     * The separator used to separate the slug from the counter.
     * If the slug already exists, a counter will be added.
     * ATTENTION: If you change this value
     * no existing slugs will be changed.
     */
    'counter_separator' => '_',

    /*
     * The max length of the slug excluding the counter.
     * ATTENTION: If you change this value to above 255
     * you must also publish the migration and
     * change column type in the database.
     */
    'max_length' => 255,

    /*
     * The model that will be used to generate the slug.
     * You can use your own model by extending the provided model.
     */
    'model' => Hyperlink\Sluggable\Models\Slug::class,
];
```

## Usage

```php
class Post extends Model
{
    use Sluggable; // Add this trait to your model

    // The column that will be used to generate the slug
    protected string $slugCreatedFrom = 'title';
}
```
The trait will register an observer that will generate the slug when the model is created or updated.
```php
    public static function bootSluggable(): void
    {
        // ...
        static::created(/* ... */);

        static::updated(/* ... */);
        // ...
    }
```
You can overwrite it with
```php
protected function makeSlug(): string
{
    return (string) sluggable($this->{$this->getSlugCreatedFrom()});
}
```

## Testing

```bash
composer test
```

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [Katalam](https://github.com/Katalam)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
