<?php
namespace FormsEngine\Renderer\Element;

use FormsEngine\Questions\Type;

// TODO really extends from Element?

class Button extends Element {

  public function __construct(
                            $label,
                            $primary = false) {
      $this->type = Type::BUTTON();
      $this->label = $label;

      if ($this->primary){
        \array_push($this->style, 'btn-primary');
      }
      else {
        \array_push($this->style, 'btn-secondary');
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
