<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class Email extends Controller
{
    public static function envoyerEmail($destinataire, $sujet, $corpsMessage) {
        $mail = new PHPMailer(true);

        try {
            $mail->isSMTP();
            $mail->CharSet = "UTF-8";
            $mail->Host = 'mail.gmx.com';
            $mail->SMTPAuth = true;         
            $mail->Username = 'barsiofr@gmx.fr';
            $mail->Password = '0550002Dmail!';
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
            $mail->Port = 465;

            $mail->setFrom('barsiofr@gmx.fr', 'Auth-App (Barsio)');
            $mail->addAddress($destinataire);

            $mail->isHTML(true);
            $mail->Subject = $sujet;
            $mail->Body = $corpsMessage;
            $mail->AltBody = strip_tags($corpsMessage);

            $mail->send();
            return true;
        }
        catch (Exception $e) {
            return false;
        }
    }
}
