<?php
namespace FormsEngine\Renderer\Element;

use FormsEngine\Questions\Type;

class Button extends Element {

  public function __construct(
                            $label,
                            $primary = false) {
      $this->type = Type::BUTTON();
      $this->label = $label;
      if ($primary){
        $this->addStyle('btn-primary');
      }
      else {
        $this->addStyle('btn-secondary');
      }
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
