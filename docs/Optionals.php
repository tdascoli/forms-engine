<?php
error_reporting(E_ALL ^ E_NOTICE);

abstract class Option {
    protected $value;

    public function __construct($value) {
        if (isset($value)) return some($value);
        else return none();
    }

    public function __toString() {
        return get_called_class();
    }

    public function isDefined() {
        return !!isset($this->value);
    }

    public function isEmpty() {
        return !$this->isDefined();
    }

    abstract public function map($f);

    abstract public function flatMap($f);
}

class Some extends Option {

    protected $value;

    public function __construct($value) {
        if ($value === none()) return none();
        if (!$value) return none();
        else $this->value = $value;
    }

    public function get() {
       return $this->value;
    }

    public function getOrElse($default) {
       return $this->value;
    }

    public function getOrNull() {
       return $this->value;
    }

    public function map($f) {
        return option(call_user_func($f, $this->value));
    }

    public function flatMap($f) {
        $v = $this->map($f)->get();
        return option($v->get());
    }

    private function flatten($array) {
       $res = array();
       foreach ($array as $key => $value) {
           if (is_array($value)){ $res = array_merge($res, array_flatten($value));}
           else {$res[$key] = $value;}
       }
       return $res;

    }
}

class None extends Option {

    protected $value;

    public function __construct() {
        $this->value = null;
    }

    public function get() {
       return none();
    }

    public function getOrElse($default) {
       return $default;
    }

    public function toString() {
        return "None";
    }

    public function getOrNull() {
       return null;
    }

    public function map($f) {
        return none();
    }

    public function flatMap($f) {
        return none();
    }

}

function option($value) {
    if ($value !== none() && isset($value)) return some($value);
    else return none();
 }

function none() {
    static $n;
    if (!$n) $n = new None();
    return $n;
}

function some($v) {
    if ($v) return new Some($v);
    else throw new InvalidArgumentException("Value for some must not be falsy. [$v] given");
}

$a = option(null);
$b = option(4);
$c = new Some(3);
$d = some(4);
$e = none();
$f = some(array(7,8,9,10));

$chainedFlatMapOfNone = $a->flatMap(function($e) { return Some($e + 10);}); //none
$chainedFlatMapOfSome = $b->flatMap(function($e) { return Some($e + 10);}); //Some(14)

$ffaa = $chainedFlatMapOfNone->flatMap(function($e) { return Some($e + 10);}); //none
$ffbb = $chainedFlatMapOfSome->flatMap(function($e) { return Some($e + 10);});


$nestedFlatMapsOfNone = $a->flatMap(function($e) { return Some($e + 105454545);})
                          ->flatMap(function($e) { return Some($e + 10 - 3);}); //none

$nestedFlatMapsOfSomeToSome = $b->flatMap(function($e) { return Some($e + 105454545);})
                                ->flatMap(function($e) { return Some($e + 10 - 3);}); //Some(105454556)

$nestedFlatMapsOfSomeToSomeWithMapReturningOptional = $b->flatMap(function($e) { return Some($e + 105454545);})
                                                        ->flatMap(function($e) { return Some($e + 10 - 3);})
                                                        ->map(function($e) { return option($e);}); //Some(105454556)

$nestedFlatMapsOfSomeToSomeWithMap = $b->flatMap(function($e) { return Some($e + 105454545);})
                                       ->flatMap(function($e) { return Some($e + 10 - 3);})
                                       ->map(function($e) { return $e;}); //Some(105454556)

$nestedFlatMapsOfSomeToNone = $b->flatMap(function($e) { return Some($e + 105454545);})
                                ->flatMap(function($e) { return Some($e + 10 - 3);})
                                ->map(function($e) { return option(null);}); //None


assert($a->get() === none());
assert($a->getOrElse(5) === 5);

assert($b->get() === 4);
assert($b->getOrElse(23) === 4);

assert($c->get() === 3);
assert($c->getOrElse(23) === 3);

assert($d->get() === 4);
assert($d->getOrElse(23) === 4);

assert($e->get() === none());
assert($e->getOrElse(5) === 5);

assert($f->get() === array(7,8,9,10));
assert($f->getOrElse(23) === array(7,8,9,10));


assert($a->isDefined() === false);
assert($b->isDefined() === true);
assert($c->isDefined() === true);
assert($d->isDefined() === true);
assert($e->isDefined() === false);
assert($f->isDefined() === true);

assert($a->isEmpty() === true);
assert($b->isEmpty() === false);
assert($c->isEmpty() === false);
assert($d->isEmpty() === false);
assert($e->isEmpty() === true);
assert($f->isEmpty() === false);

assert($chainedFlatMapOfNone == none());
assert($chainedFlatMapOfNone->get() === none());
assert($chainedFlatMapOfNone->getOrElse(5) === 5);
assert($chainedFlatMapOfNone->getOrNull() === null);

assert($chainedFlatMapOfSome == some(14));
assert($chainedFlatMapOfSome->get() === 14);
assert($chainedFlatMapOfSome->getOrElse(5) === 14);
assert($chainedFlatMapOfSome->getOrNull() === 14);

assert($nestedFlatMapsOfNone == none());
assert($nestedFlatMapsOfNone->get() === none());
assert($nestedFlatMapsOfNone->getOrElse(5) === 5);
assert($nestedFlatMapsOfNone->getOrNull() === null);

assert($nestedFlatMapsOfSomeToSome == some(105454556));
assert($nestedFlatMapsOfSomeToSome->get() === 105454556);
assert($nestedFlatMapsOfSomeToSome->getOrElse(5) === 105454556);
assert($nestedFlatMapsOfSomeToSome->getOrNull() === 105454556);

assert($nestedFlatMapsOfSomeToSomeWithMapReturningOptional == some(some(105454556)));
assert($nestedFlatMapsOfSomeToSomeWithMapReturningOptional->get() == some(105454556));
assert($nestedFlatMapsOfSomeToSomeWithMapReturningOptional->getOrElse(5) == some(105454556));
assert($nestedFlatMapsOfSomeToSomeWithMapReturningOptional->getOrNull() == some(105454556));

assert($nestedFlatMapsOfSomeToSomeWithMap == some(105454556));
assert($nestedFlatMapsOfSomeToSomeWithMap->get() == 105454556);
assert($nestedFlatMapsOfSomeToSomeWithMap->getOrElse(5) == 105454556);
assert($nestedFlatMapsOfSomeToSomeWithMap->getOrNull() == 105454556);

assert($nestedFlatMapsOfSomeToNone == none());
assert($nestedFlatMapsOfSomeToNone->get() === none());
assert($nestedFlatMapsOfSomeToNone->getOrElse(5) === 5);
assert($nestedFlatMapsOfSomeToNone->getOrNull() === null);


forcePrint($a);
forcePrint($b);
forcePrint($c);
forcePrint($d);
forcePrint($e);
forcePrint($f);

forcePrint($chainedFlatMapOfNone);
forcePrint($chainedFlatMapOfSome);
forcePrint($nestedFlatMapsOfNone);
forcePrint($nestedFlatMapsOfSomeToSome);
forcePrint($nestedFlatMapsOfSomeToSomeWithMapReturningOptional);
forcePrint($nestedFlatMapsOfSomeToNone);

function forcePrint(Option $o) {
    $m = sprintf("The value of the [%s] is [%s]", get_class($o), $o->get());
    echo $m, PHP_EOL;
}
