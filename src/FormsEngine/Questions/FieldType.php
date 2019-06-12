<?php
namespace FormsEngine\Questions;

use MyCLabs\Enum\Enum;

/**
 * Class FieldType
 * @package FormsEngine\Questions
 */
class FieldType extends Enum {
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
}
?>
