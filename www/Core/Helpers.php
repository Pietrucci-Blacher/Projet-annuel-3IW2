<?php

namespace App\Core;

use App\Core\PHPMailer\PHPMailer;

class Helpers
{
    public static function lastname($word): string
    {
        $word = strtoupper(trim($word));
        return $word;
    }

    public static function mailer(array $from, array $to, string $subject, string $confirm_link, bool $isHTML = true)
    {


        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->CharSet = 'UTF-8';
        $mail->Encoding = 'base64';
        $mail->SMTPAuth = true;
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $mail->Host = "smtp.gmail.com";
        $mail->Port = 465;
        $mail->Username = "chiperz.esgi@gmail.com";
        $mail->Password = "dwnoukfsgajupwne";
        $mail->isHTML($isHTML);

        $mail->setFrom($from['email'], $from['name']);
        $mail->addAddress($to['email'], $to['name']);

        $mail->Subject = $subject;
        $mail->Body = 'Cliquez <a href="' . $confirm_link . '">ici</a> pour confirmer votre email';


        if ($mail->send()) {
            return ['error' => false, 'test' => $confirm_link];
        } else {
            return ['error' => true, 'error_message' => $mail->ErrorInfo];
        }
    }
}
