<?php
namespace FormsEngine\Answers\Persistence;

use FormsEngine\DynConfig;
use FormsEngine\Translations\Translations;
use FormsEngine\Answers\Persistence\Persistence;
use \PHPMailer\PHPMailer\PHPMailer;
use \PHPMailer\PHPMailer\Exception;

class EMAIL implements Persistence {

  public static function persist($name, $data){
    // $name could be the name of the template in Templates
    $i18n = new Translations();

    $mail = new PHPMailer(true);
    try {
        //Recipients
        $mail->setFrom(DynConfig::getInstance()->get('peristence','email')->emailTo, 'FormsEngine');
        $mail->addAddress(DynConfig::getInstance()->get('peristence','email')->emailTo);

        // Content
        $mail->isHTML(true);
        $mail->Subject = \L::message_email_subject;
        $mail->Body    = \implode(',', $data);
        $mail->AltBody = \implode(',', $data);

        $mail->send();
    } catch (Exception $e) {
        echo \L::message_email_exception."{$mail->ErrorInfo}";
    }
  }

  public static function load($name){
    return 'not possible';
  }
}
?>
