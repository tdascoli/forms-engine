<?php
namespace FormsEngine\Questions\Loader;

use MyCLabs\Enum\Enum;

class LoaderType extends Enum {
    const COOKIE       = 'COOKIE';
    const SESSION      = 'SESSION';
    const API          = 'API';
}
?>
