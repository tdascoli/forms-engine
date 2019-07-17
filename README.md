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

Then add some Elements to create your form, and render it.

```php
use FormsEngine\Questions\Element;

$r = $engine->renderer();

$r->add(new Element\Title('My First FormsEngine'));
$r->add(new Element\Text('Text Input Label','Text Input Placeholder','Text Input Helptext'));

$r->render();
```

## Dependencies

A List of all Dependencies and Documentation used by this Library.

**CSS**

* [bootstrap](https://getbootstrap.com/docs/4.3/components/forms/)
* [material](https://daemonite.github.io/material/)

**PHP**

* [twig/twig](https://twig.symfony.com/)
* [myclabs/php-enum](https://github.com/myclabs/php-enum)
* [phpcollection/phpcollection](http://jmsyst.com/libs/php-collection)
* [philipp15b/php-i18n](https://github.com/Philipp15b/php-i18n)
* [slim/slim](http://www.slimframework.com/)
* [nategood/httpful](http://phphttpclient.com/)
* [league/csv](https://csv.thephpleague.com/)
* [rakibtg/sleekdb](https://sleekdb.github.io/)
* [phpmailer/phpmailer](https://github.com/PHPMailer/PHPMailer)
* [phpoffice/phpspreadsheet](https://github.com/PHPOffice/PhpSpreadsheet)

**JS**

* [Parsley.JS](http://parsleyjs.org/)
* [JOII (JavaScript Object Inheritance Implementation](https://github.com/haroldiedema/joii)

## Elements `FormsEngine\Questions\Element`

All Elements have the following methods:

**Public Methods**

* `___construct($label)` when not otherwise stated, this is the default constructor
* `serialize()` get serialized Element for persistence, array with all attributes and values.
* `prepare()` see `serialize()`
* `static deserialize($object)` deserialize Object to Element
* `toObjectVar($key, $value, $class = null)` used to map an array to key/value of Element.
* `script()` get all JavaScript code to render.
* `required()` set Element as required
* `readonly()` set Element as readonly
* `disabled()` set Element as disabled
* `inputmask($mask,$type = 'mask')` set Inputmask (see Dependencies for further Documentation)
* `addStyle($style)`add additional CSS class
* `attr($attr, $value)` add attributes

**Private Methods**
* `setId($id,$isName = false)` set id and optional also name attribute
* `setName($name)` set name attribute
* `static camelCase($str, array $noStrip = [])` get String camelCased, used for `setId` and `setName`

### Text

Usage

```php
$element = new Text('Label','Placeholder','Helptext');
```

Template/HTML

```html
<div class="form-group">
  <label for="label">Label</label>
  <input type="text" class="form-control " id="label" name="label" placeholder="Placeholder" aria-describedby="label-helptext">
  <small id="label-helptext" class="form-text text-muted">Helptext</small>
</div>
```

Public Methods
* `__construct($label, $placeholder = null, $helptext = null)` constructor
* `render($twig)` render Method for Twig Template Engine
