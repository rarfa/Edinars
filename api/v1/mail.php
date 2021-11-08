<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require dirname(__DIR__, 2) . '/vendor/autoload.php';


function sendMail(string $to, string $subject, string $content): bool
{
    $subject = utf8_decode(htmlspecialchars_decode($subject));
    $content = utf8_decode(htmlspecialchars_decode($content));

    global $smtp_mailer, $smtp_host, $smtp_port, $smtp_user, $smtp_password, $smtp_encryption, $smtp_from_address, $smtp_from_name;

    $mail = new PHPMailer(true);

    try {
        //Server settings
        $mail->SMTPDebug = SMTP::DEBUG_OFF;                      //Enable verbose debug output _CONNECTION
        $mail->isSMTP();                                            //Send using SMTP
        $mail -> charSet  = "UTF-8";
        $mail->Host       = $smtp_host;                     //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mail->Username   = $smtp_user;                     //SMTP username
        $mail->Password   = $smtp_password;                               //SMTP password
        $mail->SMTPSecure = $smtp_encryption;            //Enable implicit TLS encryption
        $mail->Port       = $smtp_port;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

        // skip ssl this should be removed and ssl should be forced
        $mail->SMTPOptions = array(
            'ssl' => array(
                'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => true
            )
        );
        //Recipients
        $mail->setFrom($smtp_from_address, $smtp_from_name);
        $mail->addAddress($to);     //Add a recipient

        //$mail->addAddress('ellen@example.com');               //Name is optional
        //$mail->addReplyTo('info@example.com', 'Information');
        //$mail->addCC('cc@example.com');
        //$mail->addBCC('bcc@example.com');

        //Attachments
        //$mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
        //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

        //Content
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = $subject;
        $mail->Body    = $content;

        return $mail->send();

    } catch (Exception $e) {

        return false;
    }
}