<?php
namespace FormsEngine\Questions\Pagination;

class Pagination {

  private $active;
  private $back;
  private $next;
  private $last;
  private $reset;

  private $pagesize;
  private $index;

  public function __construct(){
    $this->active = true;
    $this->back = false;
    $this->next = false;
    $this->last = true;
    $this->reset = true;

    $this->pagesize = 0;
    $this->index = 0;

    // ?? get page ??
  }

  public function prepare($pagesize){
    $this->setPagesize($pagesize);
    // todo change, eval from vars!!! not static
    return \get_object_vars($this);
  }

  // todo refactoring -> more funcs
  private function setPagesize($pagesize){
    // init
    if ($pagesize>0){
        $this->pagesize = $pagesize;
        $this->index = 1;

        if ($pagesize>1){
            $this->next=true;
            $this->last=false;
        }
    }
  }
  // todo refactoring -> more funcs
  // last = true when next = false!!!
  // first = true when back = false!!!
  // SIMPLIFY
  public function page($index){
      if ($index<=$this->pagesize){
          $this->index=$index;

          if ($index>1){
              $this->back=true;
          }
          else {
              $this->back=false;
          }

          if ($index==$this->pagesize){
              $this->next=false;
              $this->last=true;
          }
          else {
              $this->next=true;
              $this->last=false;
          }
      }
  }
}
?>
