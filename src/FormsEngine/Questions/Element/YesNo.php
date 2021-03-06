<?php
namespace FormsEngine\Questions\Element;

use FormsEngine\Questions\Type;
use FormsEngine\Translations\Translations;

class YesNo extends ElementGroup {

  private $yesno;
  private $booleans;

  public $name;
  
  private $yesnoBooleans = array('Yes' => true,'No' => false);
  private $yesnoStrings = array('Yes' => \L::element_yesno_yes,'No' => \L::element_yesno_no);

  public function __construct($name, $booleans = false) {
      $i18n = new Translations();

      $this->type = Type::YESNO()->getValue();
      $this->name = $name;
      $this->booleans = $booleans;
      $values = $this->yesnoStrings;
      if ($this->booleans){
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
   * @return array
   */
  public function serialize() {
      return \get_object_vars($this);
  }

  /**
   * @return class
   */
  public static function deserialize($object){
    return new YesNo($object->name, $object->booleans);
  }
}
?>
