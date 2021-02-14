# Navigator

[![Latest Version on Packagist](https://img.shields.io/packagist/v/binomendev/navigator.svg?style=flat-square)](https://packagist.org/packages/binomendev/navigator)
[![GitHub Tests Action Status](https://img.shields.io/github/workflow/status/binomendev/navigator/run-tests?label=tests)](https://github.com/binomendev/navigator/actions?query=workflow%3ATests+branch%3Amaster)
[![GitHub Code Style Action Status](https://img.shields.io/github/workflow/status/binomendev/navigator/Check%20&%20fix%20styling?label=code%20style)](https://github.com/binomendev/navigator/actions?query=workflow%3A"Check+%26+fix+styling"+branch%3Amaster)
[![Total Downloads](https://img.shields.io/packagist/dt/binomendev/navigator.svg?style=flat-square)](https://packagist.org/packages/binomendev/navigator)


A utility package for creating various navigation menus such as navbar, dropdowns, pills, tabs and others.


## Installation

You can install the package via composer:

```bash
composer require binomendev/navigator
```

You can publish and run the migrations with:

```bash
php artisan vendor:publish --provider="Binomendev\Navigator\NavigatorServiceProvider" --tag="navigator-migrations"
php artisan migrate
```

You can publish the config file with:
```bash
php artisan vendor:publish --provider="Binomendev\Navigator\NavigatorServiceProvider" --tag="navigator-config"
```

This is the contents of the published config file:

```php
return [
    //
];
```

## Usage

To create a new menu you can use the facade.

```php
\Binomendev\Navigator\NavigatorFacade::menu('main', [
    \Binomedev\Navigator\NavItem::make(__('Home'), '/', 'fa fa-house')
]);
```

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](.github/CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [Codrin Axinte](https://github.com/codrin-axinte)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
