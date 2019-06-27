<?php
namespace FormsEngine\Answers\Persistence;

use FormsEngine\Config;
use FormsEngine\Answers\Persistence\Persistence;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class EMAIL implements Persistence {

  public static function persist($data){
    $mail = new PHPMailer(true);
    try {
        //Recipients
        $mail->setFrom(Config::$peristenceEmailTo, 'FormsEngine');
        $mail->addAddress(Config::$peristenceEmailTo);

        // Content
        $mail->isHTML(true);
        $mail->Subject = 'New Data from FormsEngine';
        $mail->Body    = \implode(','$data);
        $mail->AltBody = \implode(','$data);

        $mail->send();
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
  }
}
?>
