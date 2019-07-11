<?php
namespace FormsEngine\Questions\Pagination;

use PhpCollection\Sequence;

class PageCondition implements Condition {

  private $conditions;

  public function __construct(){
    $this->conditions = new Sequence();
  }

  public function addCondition($condition){
    $this->conditions->add($condition);
  }
}
?>
