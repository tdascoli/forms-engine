<?php
namespace FormsEngine\Answers;

use MyCLabs\Enum\Enum;

/**
 * Class Type of Persistence
 * @package FormsEngine\Answers
 */
class PersistenceType extends Enum {
    const CSV       = 'CSV';
    const XLSX      = 'XLSX';
    const JSON      = 'JSON';
}
?>
