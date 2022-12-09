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

## Documentation
