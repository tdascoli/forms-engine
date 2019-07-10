<?php
namespace FormsEngine\Questions;

/**
 * Class AbstractPage
 * @package FormsEngine\Questions
 */
interface AbstractPage {

  public function add($element);

  public function addRequired($element);

  public function elementKeys();

}
?>
