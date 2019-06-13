<?php
namespace FormsEngine\Renderer\Element;

use FormsEngine\Questions\Type;

// TODO really extends from Element?

class Button extends Element {

  private $primary;

  public function __construct(
                            $label,
                            $primary = false) {
      $this->type = Type::BUTTON();
      $this->label = $label;
      $this->primary = $primary;
  }

  public function render($twig){
    $template = $twig->load('button.html');
    return $template->render($this->prepare());
  }

  public function prepare(){
    $vars = parent::prepare();
    // todo style??
    $vars['class'] = $this->btnClass();
    return $vars;
  }

  private function btnClass(){
    if ($this->primary){
      return 'btn-primary';
    }
    return 'btn-secondary';
  }

  /**
   * @return class
   */
  public static function deserialize($object){
    $class = new Button($object->label, $object->primary);
    foreach ($object as $key => $value) {
        $class->toObjectVar($key, $value);
    }
    return $class;
  }
}
?>
