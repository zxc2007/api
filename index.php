<?php

require 'vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;   

  function smtest($id, $shost, $user, $pass, $port, $from, $to)
    {
        $mail = new PHPMailer(true);
        try {
            $mail->SMTPDebug = SMTP::DEBUG_OFF;
            $mail->isSMTP();
            $mail->Host       = $shost;
            $mail->SMTPAuth   = true;
            $mail->Username   = $user;
            $mail->Password   = $pass;
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port       = $port;

            //Recipients
            $mail->setFrom($from, 'Api SMTP');
            $mail->addAddress($to);

            $mail->isHTML(true);
            $mail->Subject = 'SMTP TEST '. $id;
            $mail->Body    = 'TEST SMTP No: ' . $id;
            $mail->AltBody = 'Inboc';

            $mail->send();
            return 'ok';
            //echo 'Message has been sent';
        } catch (Exception $e) {
            return 'bad';
            //echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    }

    if(isset($_GET['x']) && isset($_GET['id']) && isset($_GET['to'])){
        $x = urldecode($_GET['x']);
        $id = $_GET['id'];
        $to = $_GET['to'];

        $host = explode('|', $x)[0];
        $user = explode('|', $x)[2];
        $pass = explode('|', $x)[3];
        $port = explode('|', $x)[1];
        $from = $user;
        $r = smtest($id, $host, $user, $pass, $port, $from, $to);
        echo $r;
    }else{
        echo 'Invalid';
    }