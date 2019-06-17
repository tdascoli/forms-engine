<?php
namespace FormsEngine\Questions\Pagination;

class Pagination {

  private $active;
  private $reset;
  private $static;

  private $pagesize;
  private $index;

  public function __construct($reset = false, $static = false){
    $this->active = true;
    $this->reset = $reset;
    $this->static = $static;

    $this->pagesize = 0;
    $this->index = 0;

    // ?? get page ??
  }

  public function prepare($pagesize){
    $this->setPagesize($pagesize);
    $pagination = array(
      'last' => $this->isLast(),
      'next' => $this->isNext(),
      'back' => $this->isBack(),
    );
    return array_merge($pagination, \get_object_vars($this));
  }

  private function setPagesize($pagesize){
    if ($pagesize>0){
        $this->pagesize = $pagesize;
        $this->index = 1;
    }
  }

  public function page($index){
    if ($index <= $this->pagesize){
      $this->index = $index;
    }
  }

  public function static(){
    $this->static = true;
  }

  public function hasReset(){
    $this->reset = true;
  }

  public function isLast(){
    if ($this->index == $this->pagesize){
      return true;
    }
    return false;
  }

  public function isNext(){
    if ($this->index != $this->pagesize AND
        $this->pagesize > 1){
      return true;
    }
    return false;
  }

  public function isBack(){
    if ($this->index == $this->pagesize AND
        $this->pagesize < 0){
      return true;
    }
    return false;
  }

  public static function active(){
    if (self::$active == null){
      return false;
    }
    return self::$active;
  }
}
?>
