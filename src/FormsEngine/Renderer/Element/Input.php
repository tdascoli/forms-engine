<?php
namespace FormsEngine\Renderer\Element;

use PhpCollection\Map;

class Input extends Element {

  public function __construct($label,
                              $placeholder = null,
                              $helptext = null) {
      parent::__construct($label);
      if ($placeholder!=null){
        $this->placeholder = $placeholder;
      }
      if ($helptext!=null){
        $this->helptext = $helptext;
      }
  }

  public function render($twig){
    $template = $twig->load('input.html');
    return $template->render(parent::prepare());
  }

  public function attr($type, $value){
    if (!$this->attributes instanceof Map){
      $this->attributes = new Map();
    }
    $this->attributes->set($type, $value);
  }

  /**
   * @return class
   */
  public static function deserialize($object){
    $class = new Input($object->label);
    foreach ($object as $key => $value) {
        $class->toObjectVar($key, $value);
    }
    return $class;
  }
}
?>
