<?php
namespace FormsEngine\Renderer\Element;

use PhpCollection\Sequence;

class Option {

  private $options;

  public function __construct(){
    $this->options = new Sequence();
  }

  public function add($label, $value, $selected = false){
    $this->options->add(Option::create($label, $value, $selected));
  }

  public function addAll($options){
    if (\is_array($options)){
      $this->options->addAll($options);
    }
  }

  public function all(){
    return $this->options->all();
  }

  public static function create($label, $value, $selected = false){
    if ($selected){
      $selectedValue='selected';
    }

    $option = array(
                'value' => $value,
                'label' => $label,
                'selected' => $selectedValue
              );
    return $option;
  }
}
?>
