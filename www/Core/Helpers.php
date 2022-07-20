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
        // 	file_get_contents($_SERVER['DOCUMENT_ROOT'] . '/Views/Emails/' . $body_template . '.php')
        // );
        // $mail->msgHTML($message);

        if ($mail->send()) {
            return ['error' => false, 'test' => $template_replace];
        } else {
            return ['error' => true, 'error_message' => $mail->ErrorInfo];
        }
    }

    public static function upload(string $directory = '', array $allowTypes = ['jpg' => 'image/jpeg', 'png' => 'image/png', 'gif' => 'image/gif']) {

        // Undefined | Multiple Files | $_FILES Corruption Attack
        // If this request falls under any of them, treat it invalid.
        if (!isset($_FILES['upfile']['error'])) {
            return false;
        }

        if (is_array($_FILES['upfile']['error'])) {
            return ['error' => 'Paramètres invalides.'];
        }

        $path = 'uploads/' . $directory . '/';
        if (!file_exists($path)) {
            mkdir($path, 0777, true);
        }
        $targetDir = $path;
        $fileName = basename($_FILES['upfile']['tmp_name']);
        $targetFilePath = $targetDir . date("Y-m-d_H-i-s") . "_" . $fileName;

        // Check $_FILES['upfile']['error'] value.
        switch ($_FILES['upfile']['error']) {
            case UPLOAD_ERR_OK:
                break;
            case UPLOAD_ERR_NO_FILE:
                return false;
            case UPLOAD_ERR_INI_SIZE:
            case UPLOAD_ERR_FORM_SIZE:
                return ['error' => "Taille maximale dépassée."];
            default:
                return ['error' => "Erreur inconnue."];
        }

        // You should also check filesize here.
        if ($_FILES['upfile']['size'] > 1000000) {
            return ['error' => "Taille maximale dépassée."];
        }

        // DO NOT TRUST $_FILES['upfile']['mime'] VALUE !!
        // Check MIME Type by yourself.
        $finfo = new \finfo(FILEINFO_MIME_TYPE);
        if (false === $ext = array_search(
                $finfo->file($_FILES['upfile']['tmp_name']),
                $allowTypes,
                true )) {
            return ['error' => "Format du fichier invalide."];
        }

        // You should name it uniquely.
        // DO NOT USE $_FILES['upfile']['name'] WITHOUT ANY VALIDATION !!
        // On this example, obtain safe unique name from its binary data.
        if (!move_uploaded_file(
            $_FILES['upfile']['tmp_name'],
            sprintf('./uploads/' . $directory . '/%s.%s',
                date("Y-m-d_H-i-s") . "_" . $fileName,
                $ext
            )
        )) {
            return ['error' => "Une erreur s'est produite lors du téléchargement du fichier."];
        }
        $image = new Image();
        $url = $targetFilePath . '.' . $ext;
        // Insert image file name with path into database
        $image->setFile_name($url);
        $image->setUser_id(get_object_vars($_SESSION['userStore'])['id']);
        $image->save();

        $image->find(['file_name' => $url]);

        if($image->getId() !== null){
            return $image->getId();
        }else{
            return ['error' => "Erreur lors de l'envoi du fichier, merci de réessayer."];
        }
    }
}
