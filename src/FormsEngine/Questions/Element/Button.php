<?php
namespace FormsEngine\Questions\Element;

use FormsEngine\Questions\Type;
use MyCLabs\Enum\Enum;

class Button extends Element {

  public $buttonType;

  public function __construct(
                            String $label,
                            ButtonType $buttonType = null) {
      $this->label = $label;
      $this->doButtonType($buttonType);
  }

  public function render($twig){
    $template = $twig->load('Element/button.html');
    return $template->render(parent::prepare());
  }

  private function doButtonType(ButtonType $buttonType = null):void {
    if ($buttonType == null OR !$buttonType instanceof ButtonType){
      $this->buttonType = ButtonType::BUTTON();
      $this->type = Type::BUTTON()->getValue();
    }
    else {
      $this->buttonType = $buttonType;
    }

    switch ($this->buttonType){
      case ButtonType::SUBMIT():
        $this->addStyle('btn-primary');
        $this->type = Type::SUBMIT()->getValue();
        break;
      case ButtonType::RESET():
        $this->addStyle('btn-light');
        $this->type = Type::RESET()->getValue();
        break;
      default:
        $this->addStyle('btn-secondary');
    }
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

class ButtonType extends Enum {
    const BUTTON     = 'button';
    const SUBMIT     = 'submit';
    const RESET      = 'reset';
}
?>
