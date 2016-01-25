# Centurian

Centurian is a Laravel package which adds extra commands to [Sentry](https://getsentry.com) of new releases.

## Installation

Either [PHP](https://php.net) 5.5+ or [HHVM](http://hhvm.com) 3.6+ are required.

To get the latest version of Blue Bay Travel Centurian, simply require the project using [Composer](https://getcomposer.org):

```bash
$ composer require bluebaytravel/centurian
```

Instead, you may of course manually update your require block and run `composer update` if you so choose:

```json
{
    "require": {
        "bluebaytravel/centurian": "^1.0"
    }
}
```

Once Blue Bay Travel Centurian is installed, you need to register the service provider. Open up `config/app.php` and add the following to the `providers` key.

* `'BlueBayTravel\Centurian\CenturianServiceProvider'`

After the service provider has been loaded, publish the config:

```bash
$ php artisan vendor:publish
```

## License

Blue Bay Travel Centurian is licensed under [The MIT License (MIT)](/LICENSE).
