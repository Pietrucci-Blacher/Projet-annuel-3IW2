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

    public static function mailer(array $from, array $to, string $subject, array $template_params, array $template_replace, bool $isHTML = true, string $body_template)
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
        $mail->Body = $template_replace[4] . 'Click On This Link to Verify Email <a href="' . $template_replace[4] . '">fsdf</a>';

        // $message = str_replace(
        // 	$template_params,
        // 	$template_replace,
        // 	file_get_contents($_SERVER['DOCUMENT_ROOT'] . '/View/Emails/' . $body_template . '.php')
        // );
        // $mail->msgHTML($message);

        if ($mail->send()) {
            return ['error' => false, 'test' => $template_replace];
        } else {
            return ['error' => true, 'error_message' => $mail->ErrorInfo];
        }
    }
}
