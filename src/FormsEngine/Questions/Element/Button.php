<?php
namespace FormsEngine\Questions\Element;

use FormsEngine\Questions\Type;

class Button extends Element {

  public function __construct(
                            $label,
                            $primary = false) {
      $type = Type::BUTTON()->getValue();
      $this->label = $label;
      if ($primary){
        $type = Type::SUBMIT()->getValue();
        $this->addStyle('btn-primary');
      }
      else {
        $this->addStyle('btn-secondary');
      }
      $this->type = $type;
  }

  public function render($twig){
    $template = $twig->load('button.html');
    return $template->render(parent::prepare());
  }

  /**
   * @return class
   */
  public static function deserialize($object){
    $class = new Button($object->label);
    foreach ($object as $key => $value) {
        $class->toObjectVar($key, $value);
    }
    return $class;
  }
}
?>
