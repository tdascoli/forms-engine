<?php
namespace FormsEngine\Renderer\Element;

use FormsEngine\Questions\Type;

class YesNo extends ElementGroup {

  private $yesno;
  private $name;

  private $yesnoBooleans = array('Yes' => true,'No' => false);
  private $yesnoStrings = array('Yes' => 'Ja','No' => 'Nein');

  public function __construct($name, $booleans = false) {
      $this->type = Type::YESNO()->getValue();
      $this->name = $name;
      $values = $this->yesnoStrings;
      if ($booleans){
        $values = $this->yesnoBooleans;
      }

      $this->yesno = array(
        new Radio('Ja', $values['Yes'], $this->name),
        new Radio('Nein', $values['No'], $this->name)
      );
  }

  public function render($twig){
    $render='';
    foreach ($this->yesno as $element) {
      $render .= $element->render($twig);
    }
    return $render;
  }

  /**
   * @return class
   */
  public static function deserialize($object){
    $class = new YesNo($object->name);
    var_dump($object);
    /*
    foreach ($object as $key => $value) {
        $class->toObjectVar($key, $value);
    }
    */
    return $class;
  }
}
?>
