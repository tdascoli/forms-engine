<?php
namespace FormsEngine\Renderer\Element;

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
        new Element\Radio('Ja', true, $values['Yes']),
        new Element\Radio('Nein', true, $values['No'])
      );
  }

  public function render($twig){
    $render='';
    foreach ($this->yesno as $element) {
      $render .= $element->render($twig);
    }
    return $render;
  }
}
?>
