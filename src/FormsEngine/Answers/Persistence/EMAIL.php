<?php
namespace FormsEngine\Answers\Persistence;

use FormsEngine\Config;
use FormsEngine\Translations\Translations;
use FormsEngine\Answers\Persistence\Persistence;
use \PHPMailer\PHPMailer\PHPMailer;
use \PHPMailer\PHPMailer\Exception;

class EMAIL implements Persistence {

  public static function persist($data){
    $i18n = new Translations();

    $mail = new PHPMailer(true);
    try {
        //Recipients
        $mail->setFrom(Config::$peristenceEmailTo, 'FormsEngine');
        $mail->addAddress(Config::$peristenceEmailTo);

        // Content
        $mail->isHTML(true);
        $mail->Subject = \L::message_email_subject;
        $mail->Body    = \implode(','$data);
        $mail->AltBody = \implode(','$data);

        $mail->send();
    } catch (Exception $e) {
        echo \L::message_email_exception."{$mail->ErrorInfo}";
    }
  }
}
?>
