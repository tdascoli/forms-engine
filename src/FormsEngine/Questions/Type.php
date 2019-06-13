<?php
namespace FormsEngine\Questions;

use MyCLabs\Enum\Enum;

/**
 * Class Type
 * @package FormsEngine\Questions
 */
class Type extends Enum {
    const TEXT      = 'text';
    const HIDDEN    = 'text';
    const EMAIL     = 'email';
    const DATE      = 'date';
    const DATETIME  = 'datetime-local';
    const NUMBER    = 'number';
    const CHECKBOX  = 'checkbox';
    const RADIO     = 'radio';
    const SELECT    = 'select';
    const BUTTON    = 'button';
    const SUBMIT    = 'submit';
    const YESNO     = 'yesNo';
}
?>
