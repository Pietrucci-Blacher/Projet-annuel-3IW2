<?php

namespace App\Core;

class Validator
{

    public static function run($config, $data): array
    {
        $result = [];

        if (count($data) != count($config["inputs"])) {
            $result[] = "Formulaire modifié par user";
        }
 
        
        foreach ($config["inputs"] as $name => $input) {
            if (!isset($data[$name])) {
                $result[] = "Champ modifié";
            }
            // if ($input["required"] == true && empty($data[$name])) {
            //     $result[] = "Vous avez supprimé l'attribut required";
            // }

            if ($input["type"] == "password" && $input["id"] == "pwdRegister" && !self::checkPassword($data[$name])) {
                $result[] = $input["error"];
            } else if ($input["type"] == "email"  && !self::checkEmail($data[$name])) {
                $result[] = $input["error"];
            }

            // if ($input["type"] == "password" && $input["id"] == "pwdConfirmRegister") {
            //     $result[] = $input["error"];
            // }

            if($input["type"] == "number" && !self::checkNumber($data[$name])) {
                $result[] = "Ce champ doit être un nombre";
            }

            if($input["type"] == "text" && !self::checkText($data[$name], $input["min"], $input["max"])) {
                $result[] = $input["error"];
            }
        }
        return $result;
    }

    public static function checkPassword($pwd): bool
    {
        return strlen($pwd) >= 4 && strlen($pwd) <= 16
            && preg_match("/[a-z]/i", $pwd, $result)
            && preg_match("/[0-9]/", $pwd, $result);
    }

    public static function checkEmail($email): bool
    {
        return filter_var($email, FILTER_VALIDATE_EMAIL);
    }

    public static function checkText($text, $min, $max): bool
    {
        return strlen($text) >= $min && strlen($text) <= $max;
    }

    public static function checkNumber($number): bool
    {
        return is_numeric($number);
    }
}
