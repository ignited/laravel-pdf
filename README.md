# Laravel HTML 2 PDF

[![Latest Stable Version](https://poser.pugx.org/ignited/laravel-pdf/v/stable.png)](https://packagist.org/packages/ignited/laravel-pdf)
[![Total Downloads](https://poser.pugx.org/ignited/laravel-pdf/downloads.png)](https://packagist.org/packages/ignited/laravel-pdf)

A simple [Laravel 4](http://four.laravel.com/) service provider for including the [wkhtmltopdf](http://code.google.com/p/wkhtmltopdf/) library.

## Installation

The Laravel PDF Service Provider can be installed via [Composer](http://getcomposer.org) by requiring the
`ignited/laravel-pdf` package in your project's `composer.json`.

```json
{
    "require": {
        "ignited/laravel-pdf": "1.*"
    }
}
```

#### Note (you must also include wkhtmltopdf binaries)

**32-bit systems**
```json
{
    "require": {
        "h4cc/wkhtmltopdf-i386": "*"
    }
}
```

**64-bit systems** 
```json
{
    "require": {
        "h4cc/wkhtmltopdf-amd64": "*"
    }
}
```

You can include both of these if you need.

## Configuration

To use the PDF Service Provider, you must register the provider when bootstrapping your Laravel application.

Publish the package configuration using Artisan.

```sh
php artisan config:publish ignited/laravel-pdf
```

Update your settings in the generated `app/config/packages/ignited/laravel-pdf` configuration file.

Uncomment the relevant binary.

**32-bit systems**
```php
return array(
	# Uncomment for 32-bit systems
	'bin' => base_path() . '/vendor/h4cc/wkhtmltopdf-i386/bin/wkhtmltopdf-i386'
```

**64-bit systems**
```php
return array(
	# Uncomment for 64-bit systems
	'bin' => base_path() . '/vendor/h4cc/wkhtmltopdf-amd64/bin/wkhtmltopdf-amd64'
```

Find the `providers` key in your `app/config/app.php` and register the AWS Service Provider.

```php
    'providers' => array(
        // ...
        'Ignited\Pdf\PdfServiceProvider',
    )
```

Find the `aliases` key in your `app/config/app.php` and add the AWS facade alias.

```php
    'aliases' => array(
        // ...
        'PDF'			  => 'Ignited\Pdf\Facades\Pdf'
    )
```

## Usage

In `routes.php`

```php
Route::get('/', function() {
	$pdf = PDF::make();
	$pdf->addPage('<html><head></head><body><b>Hello World</b></body></html>');
	$pdf->send();
});
```
