<?php
namespace FormsEngine\Questions\Pagination;

use PhpCollection\Sequence;

class PageCondition {

  private $conditions;

  public function __construct(){
    $this->conditions = new Sequence();
  }
}
?>
