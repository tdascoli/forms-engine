<?php
namespace FormsEngine\Questions\Pagination;

class Pagination {

  private $active;
  private $back;
  private $next;
  private $last;
  private $reset;

  public function __construct(){
    $this->active = true;
    $this->back = false;
    $this->next = false;
    $this->last = true;
    $this->reset = true;
  }

  public function prepare(){
    return \get_object_vars($this);
  }

}
?>
