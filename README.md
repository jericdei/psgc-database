# PSGC Database

[![Latest Version on Packagist](https://img.shields.io/packagist/v/jericdei/psgc-database.svg?style=flat-square)](https://packagist.org/packages/jericdei/psgc-database)
[![GitHub Tests Action Status](https://img.shields.io/github/actions/workflow/status/jericdei/psgc-database/run-tests.yml?branch=main&label=tests&style=flat-square)](https://github.com/jericdei/psgc-database/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/actions/workflow/status/jericdei/psgc-database/fix-php-code-style-issues.yml?branch=main&label=code%20style&style=flat-square)](https://github.com/jericdei/psgc-database/actions?query=workflow%3A"Fix+PHP+code+style+issues"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/jericdei/psgc-database.svg?style=flat-square)](https://packagist.org/packages/jericdei/psgc-database)

**WORK IN PROGRESS!!**

This is a simple CLI tool to easily add Philippine Standard Geographic Code (PSGC) data to your database.

## Support us

[<img src="https://github-ads.s3.eu-central-1.amazonaws.com/psgc-database.jpg?t=1" width="419px" />](https://spatie.be/github-ad-click/psgc-database)

We invest a lot of resources into creating [best in class open source packages](https://spatie.be/open-source). You can support us by [buying one of our paid products](https://spatie.be/open-source/support-us).

We highly appreciate you sending us a postcard from your hometown, mentioning which of our package(s) you are using. You'll find our address on [our contact page](https://spatie.be/about-us). We publish all received postcards on [our virtual postcard wall](https://spatie.be/open-source/postcards).

## Installation

You can install the package via composer:

```bash
composer require jericdei/psgc-database:dev-master
```

You can publish the config file with:

```bash
php artisan vendor:publish --tag="psgc-database-config"
```

## Usage

### Make sure to publish and run the migrations
```bash
php artisan vendor:publish --tag="psgc-database-migrations"
php artisan migrate
```

### Download the latest PSGC data and store in your `storage/public` directory
```bash
php artisan psgc-db:download
```

### Convert the Excel file into tables in your database
```bash
php artisan psgc-db:convert
```

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [Jeric June Logan](https://github.com/jericdei)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
