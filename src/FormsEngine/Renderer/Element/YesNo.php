<?php
namespace FormsEngine\Renderer\Element;

// todo maybe remove and -> new Radio
use FormsEngine\Renderer\Element as Element;

class YesNo extends ElementGroup {

  private $yesno;

  private $yesnoBooleans = array('Yes' => true,'No' => false);
  private $yesnoStrings = array('Yes' => 'Ja','No' => 'Nein');

  public function __construct($name, $booleans = false) {
      $values = $this->yesnoStrings;
      if ($booleans){
        $values = $this->yesnoBooleans;
      }

      $this->yesno = array(
        new Element\Radio('Ja', $values['Yes'], $name),
        new Element\Radio('Nein', $values['No'], $name)
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
