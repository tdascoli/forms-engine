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

A List of all Dependencies used by this Library.

**CSS**

* [bootstrap](https://getbootstrap.com/docs/4.3/components/forms/)
* [material](https://daemonite.github.io/material/)

**PHP**

* [twig/twig](https://twig.symfony.com/) templating
* [myclabs/php-enum](https://github.com/myclabs/php-enum)
* [phpcollection/phpcollection](http://jmsyst.com/libs/php-collection) Sets, Sequences, Collections
* [philipp15b/php-i18n](https://github.com/Philipp15b/php-i18n) i18n
* [slim/slim](http://www.slimframework.com/) RESTful
* [nategood/httpful](http://phphttpclient.com/) HTTP calls
* [league/csv](https://csv.thephpleague.com/) CSV
* [rakibtg/sleekdb](https://sleekdb.github.io/) JSONDB
* [phpmailer/phpmailer](https://github.com/PHPMailer/PHPMailer) E-Mail
* [phpoffice/phpspreadsheet](https://github.com/PHPOffice/PhpSpreadsheet) Excel

**JS**

* [Parsley.JS](http://parsleyjs.org/) Input validation
* [JOII (JavaScript Object Inheritance Implementation](https://github.com/haroldiedema/joii) JS Objects

## Option

Used for `RadioGroup`, `CheckboxGroup` and `Select` Elements. For `Typeahead` see #39

Usage

```php
$option = new Option();

$option->add('first',1);
$option->add('second',2);
$option->add('third',3);
```

**Public Methods**

* `__construct()` constructor
* `add($label, $value, $selected = false)` add values to `Option` Element
* `addAll($options)` add an Array of `Option` Elements
* `all()` get All Elements
* `static create($label, $value, $selected = false)` returns an `Option` Element
* `serialize()` get serialized Element for persistence, array with all attributes and values.
* `static deserialize($object)` deserialize Object to Element

**Private Methods**

* `static camelCase($str, array $noStrip = [])` get String camelCased, used for `id`

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

### Text, E-Mail, Number

Extends from `Input`

Usage

```php
$text   = new Text('Label','Placeholder','Helptext');

$email  = new Email('Label','Placeholder','Helptext');

$number = new Number('Label','Placeholder','Helptext');
```

Template/HTML (`type` is different according to Element)

```html
<div class="form-group">
  <label for="label">Label</label>
  <input type="text" class="form-control" id="label" name="label" placeholder="Placeholder" aria-describedby="label-helptext">
  <small id="label-helptext" class="form-text text-muted">Helptext</small>
</div>
```

Public Methods

* `__construct($label, $placeholder = null, $helptext = null)` constructor
* `render($twig)` render Method for Twig Template Engine

### Textarea

Extends from `Input`

Usage

```php
$element = new Textarea('Label','Placeholder','Helptext');
```

Template/HTML

```html
<div class="form-group">
  <label for="label">Label</label>
  <input type="text" class="form-control typeahead" id="label" name="label" placeholder="Placeholder" aria-describedby="label-helptext" data-provide="typeahead" autocomplete="off">
  <small id="label-helptext" class="form-text text-muted">Helptext</small>
</div>
```

Public Methods

* `__construct($label, $placeholder = null, $helptext = null)` constructor
* `render($twig)` render Method for Twig Template Engine

### Typeahead

Extends from `Text`

Usage

```php
$options = array('first','second','third','fourth');

$element = new Typeahead('Label',$options,'Placeholder','Helptext');
```

Template/HTML

```html
<div class="form-group">
  <label for="label">Label</label>
  <input type="text" class="form-control" id="label" name="label" placeholder="Placeholder" aria-describedby="label-helptext">
  <small id="label-helptext" class="form-text text-muted">Helptext</small>
</div>
```

Public Methods

* `__construct($label, $options, $placeholder = null, $helptext = null)` constructor
* `render($twig)` render Method for Twig Template Engine

### Radio

Extends from `Element`

Usage

```php
$element = new Radio('Label','Value','Name',true);
```

Template/HTML

```html
<div class="form-group">
  <div class="custom-control custom-radio">
    <input
      type="radio"
      class="custom-control-input"
      id="Label"
      value="Value"
      name="Name"
      checked="checked">
    <label class="custom-control-label" for="Label">Label</label>
  </div>
</div>
```

Public Methods

* `__construct($label, $value, $name, $checked = false)` constructor
* `render($twig)` render Method for Twig Template Engine

### Radioroup

Extends from `Element`

Usage, see `Option` for more information

```php
$option = new Option();
$option->add('first',1);
$option->add('second',2);
$option->add('third',3);

$element = new RadioGroup('Label',$option,'Name');
```

Template/HTML

```html
<div class="form-group">
  <label for="label">Label</label>
  <div class="mt-2" id="label">
    <!-- Renders all Option Elements -->
    <div class="custom-control custom-radio">
        <input
            type="radio"
            class="custom-control-input"
            id="first"
            name="Name"
            value="1">
        <label class="custom-control-label" for="first">first</label>
    </div>
    <!-- /End -->
  </div>
</div>
```

Public Methods

* `__construct($label, $options, $name = null)` constructor
* `render($twig)` render Method for Twig Template Engine

### Checkbox

Extends from `Element`

Usage

```php
$element = new Checkbox('Label','Value',true);
```

Template/HTML

```html
<div class="form-group">
  <div class="custom-control custom-checkbox">
    <input
      type="checkbox"
      class="custom-control-input"
      id="Label"
      value="Value"
      checked="checked">
    <label class="custom-control-label" for="Label">Label</label>
  </div>
</div>
```

Public Methods

* `__construct($label, $value, $checked = false)` constructor
* `render($twig)` render Method for Twig Template Engine

### CheckboxGroup

Extends from `Element`

Usage, see `Option` for more information

```php
$option = new Option();
$option->add('first',1);
$option->add('second',2);
$option->add('third',3);

$element = new CheckboxGroup('Label',$option);
```

Template/HTML

```html
<div class="form-group">
  <label for="label">Label</label>
  <div class="mt-2" id="label">
    <!-- Renders all Option Elements -->
    <div class="custom-control custom-checkbox">
        <input
            type="checkbox"
            class="custom-control-input"
            id="first"
            name="first"
            value="1">
        <label class="custom-control-label" for="first">first</label>
    </div>
    <!-- /End -->
  </div>
</div>
```

Public Methods

* `__construct($label, $options)` constructor
* `render($twig)` render Method for Twig Template Engine
* `elementKeys()` all `Option` Keys
