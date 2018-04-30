# Wizishop PHP

[![Build Status](https://travis-ci.org/yuzu-co/wizishop-php.svg?branch=master)](https://travis-ci.org/yuzu-co/wizishop-php)
[![SensioLabsInsight](https://insight.sensiolabs.com/projects/abce624b-7a65-4bd8-8e2b-182b0da5c346/mini.png)](https://insight.sensiolabs.com/projects/abce624b-7a65-4bd8-8e2b-182b0da5c346)

PHP library for the Wizishop API.

See full doc: [https://api-doc.wizishop.com/documentation/3/home](https://api-doc.wizishop.com/documentation/3/home)


## Install

Via Composer

``` bash
$ composer require yuzu-co/wizishop-php
```

## Usage

``` php
$client = new Yuzu\Wizishop\Client($username, $password);

// see Examples/example.php 
```

## Tests

```php
php composer test
```

## Roadmap

- [ ] GET List Shop
- [ ] GET Refresh Token
- [ ] Shop/Brands
- [ ] Shop/Categories
- [ ] Shop/Categories Products
- [ ] Shop/Customers
- [ ] Shop/Orders Status
- [ ] Shop/Orders
- [ ] Shop/Products
- [ ] Shop/SKUs