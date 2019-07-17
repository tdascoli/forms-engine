# FormsEngine

Library to build forms on basis of Bootstrap 4 templates. This library includes customizable templates to use also other frameworks than Bootstrap, has multilanguage support and configurable  ways to persist the form data.

[![Latest Version](https://img.shields.io/packagist/v/apollo29/forms-engine.svg?style=flat-square)](https://packagist.org/packages/apollo29/forms-engine)
[![Build Status](https://travis-ci.com/tdascoli/forms-engine.svg?branch=develop)](https://travis-ci.com/tdascoli/forms-engine)

## Install

Install using [composer](https://getcomposer.org/).

``` bash
$ composer require apollo29/forms-engine
```

## Usage

In your `index.php` you have to create a new `FormsEngine` instance first.

```php
use FormsEngine\FormsEngine;

$engine = new FormsEngine();
```
