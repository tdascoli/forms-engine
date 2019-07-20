# FormsEngine

Library to build forms on basis of Bootstrap 4 templates. This library includes customizable templates to use also other frameworks than Bootstrap, has multilanguage support and configurable  ways to persist the form data.

[![Latest Version](https://img.shields.io/packagist/v/apollo29/forms-engine.svg?style=flat-square)](https://packagist.org/packages/apollo29/forms-engine)
[![Build Status](https://travis-ci.com/tdascoli/forms-engine.svg?branch=develop)](https://travis-ci.com/tdascoli/forms-engine)

<!-- TOC depthFrom:2 depthTo:6 withLinks:1 updateOnSave:1 orderedList:0 -->

- [Install](#install)
- [Usage](#usage)
- [Dependencies](#dependencies)
- [Configuration](#configuration)
- [Translations](#translations)
- [Templates](#templates)
- [Option](#option)
- [Elements `FormsEngine\Questions\Element`](#elements-formsenginequestionselement)
	- [Text, E-Mail, Number, Date, DateTime](#text-e-mail-number-date-datetime)
	- [Textarea](#textarea)
	- [Hidden](#hidden)
	- [Typeahead](#typeahead)
	- [Radio](#radio)
	- [RadioGroup](#radiogroup)
	- [Checkbox](#checkbox)
	- [CheckboxGroup](#checkboxgroup)
	- [Select](#select)
	- [YesNo](#yesno)
	- [Paragraph](#paragraph)
	- [Title](#title)
	- [Button, Reset, Submit](#button-reset-submit)
- [Form Definition `FormsEngine\Questions\Loader`](#form-definition-formsenginequestionsloader)
- [Pagination `FormsEngine\Questions\Pagination`](#pagination-formsenginequestionspagination)
- [Persistence `FormsEngine\Answers\Persistence`](#persistence-formsengineanswerspersistence)
	- [CSV](#csv)
	- [E-Mail](#e-mail)
	- [JSON](#json)
	- [JSONDB](#jsondb)
	- [MySQL](#mysql)
	- [XLSX](#xlsx)
	- [Implement own Persistence](#implement-own-persistence)

<!-- /TOC -->

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
* [JOII (JavaScript Object Inheritance Implementation](https://github.com/haroldiedema/joii) used for JS Objects of `FormsEngine\Questions\Element`

## Configuration

*todo*

## Translations

*todo*


## Templates

*todo*

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

All Elements are - mostly - standard [HTML5 input fields](https://developer.mozilla.org/en-US/docs/Web/HTML/Element/Input) and have the following methods:

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

### Text, E-Mail, Number, Date, DateTime

Extends from `Input`

Usage

```php
$text   = new Text('Label','Placeholder','Helptext');

$email  = new Email('Label','Placeholder','Helptext');

$number = new Number('Label','Placeholder','Helptext');

$date     = new Date('Label','Placeholder','Helptext');
$dateTime = new DateTime('Label','Placeholder','Helptext');
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

### Hidden

Extends from `Element`

Usage

```php
$element = new Hidden('id','Value');
```

Template/HTML

```html
<input
    type="hidden"
    id="id"
    name="id"
    value="Value">
```

Public Methods

* `__construct($id, $value = null)` constructor
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

### RadioGroup

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

### Select

Extends from `Element`

Usage, see `Option` for more information

```php
$option = new Option();
$option->add('first',1);
$option->add('second',2);
$option->add('third',3);

$element = new Select('Label',$option,true,'Helptext');
```

Template/HTML

```html
<div class="form-group">
  <label for="label">Label</label>
  <select class="custom-select" id="label" name="label">
    <!-- Renders all Option Elements -->
    <option value="1">first</option>
    <!-- /End -->
  </select>
  <small id="label-helptext" class="form-text text-muted">Helptext</small>
</div>
```

Public Methods

* `__construct($label,$options,$nullable = false,$helptext = null)` constructor
* `render($twig)` render Method for Twig Template Engine

### YesNo

Renders a Yes/No `Radio` Element, with "Yes" / "No" or boolean values.

Extends from `ElementGroup`

Usage

```php
$element = new YesNo('Name',true);
```

Template/HTML, see `Radio` Element

Public Methods

* `__construct($name, $booleans = false)` constructor
* `render($twig)` render Method for Twig Template Engine

### Paragraph

Extends from `Element`

Usage

```php
$element = new Paragraph('Title','Description');
```

Template/HTML

```html
<h2>Title</h2>
<p>Description</p>
```

Public Methods

* `__construct($title=null,$description=null)` constructor
* `render($twig)` render Method for Twig Template Engine

### Title

There is only one `Title` Element allowed per Form.

Extends from `Paragraph`

Usage

```php
$element = new Title('Form Title','Description');
```

Template/HTML

```html
<h1>Form Title</h1>
<p>Description</p>
```

Public Methods

* `__construct($title,$description=null)` constructor
* `render($twig)` render Method for Twig Template Engine

### Button, Reset, Submit

See #26.

Extends from `Element`

Usage

```php
$button       = new Button('Button');

$reste        = new Reset('Reset'); // Shorthand
$resetButton  = new Button('Reset Button');

$submit       = new Submit('Submit'); // Shorthand
$submitButton = new Button('Submit Button');
```

Template/HTML

```html
<button type="button" class="btn btn-secondary">
  Button
</button>

<button type="reset" class="btn btn-light">
  Reset
</button>

<button type="submit" class="btn btn-primary">
  Submit
</button>
```

Public Methods

* `__construct($label,$buttonType=null)` constructor
* `render($twig)` render Method for Twig Template Engine

## Form Definition `FormsEngine\Questions\Loader`

*todo*

## Pagination `FormsEngine\Questions\Pagination`

*todo*

## Persistence `FormsEngine\Answers\Persistence`

*todo*

### CSV

### E-Mail

### JSON

### JSONDB

### MySQL

### XLSX

### Implement own Persistence
