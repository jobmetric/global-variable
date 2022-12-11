# Global Variable for laravel

It is a package for using organized variables throughout Laravel, which can use the created variables everywhere in Laravel.

## Install via composer

Run the following command to pull in the latest version:
```bash
composer require jobmetric/global-variable
```

### Add service provider

Add the service provider to the providers array in the config/app.php config file as follows:

```php
'providers' => [

    ...

    JobMetric\GlobalVariable\Providers\GlobalVariableServiceProvider::class,
]
```

### Publish the config
Copy the `config` file from `vendor/jobmetric/global-variable/config/config.php` to `config` folder of your Laravel application and rename it to `global-variable.php`

Run the following command to publish the package config file:

```bash
php artisan vendor:publish --provider="JobMetric\GlobalVariable\Providers\GlobalVariableServiceProvider" --tag="config"
```

You should now have a `config/global-variable.php` file that allows you to configure the basics of this package.


### Public Assets

To use the plugins used in this package, the following command must be executed.

```php
php artisan vendor:publish --provider="JobMetric\GlobalVariable\Providers\GlobalVariableServiceProvider" --tag="public"
```

## Documentation
