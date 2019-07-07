<?php
namespace FormsEngine\Questions\Pagination;

use PhpCollection\Sequence;

class ElementCondition {

  private $conditions;

  public function __construct(){
    $this->conditions = new Sequence();
  }
}
?>
