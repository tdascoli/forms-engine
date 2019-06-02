<?php
namespace FormsEngine\questions;

require __DIR__ . '/../../vendor/autoload.php';

use MyCLabs\Enum\Enum;

/**
 * Class FieldType
 * @package FormsEngine\Questions
 */
class FieldType extends Enum {
    const TEXT = 'text';
    const EMAIL = 'email';
    const DATE = 'date';
    const NUMBER = 'number';
    const CHECKBOX = 'checkbox';
    const RADIO = 'radio';
    const SELECT = 'select';
}
?>
