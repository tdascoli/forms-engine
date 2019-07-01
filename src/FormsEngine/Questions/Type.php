<?php
namespace FormsEngine\Questions;

use MyCLabs\Enum\Enum;

/**
 * Class Type
 * @package FormsEngine\Questions
 */
class Type extends Enum {
    const TEXT      = 'text';
    const TEXTAREA  = 'textarea';
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
    const RESET     = 'reset';
    const YESNO     = 'yesNo';
    const TYPEAHEAD = 'typeahead';

    const TITLE     = 'title';
    const PARAGRAPH = 'paragraph';

    const CHECKBOX_GROUP  = 'CheckboxGroup';
    const RADIO_GROUP     = 'RadioGroup';
}
?>
