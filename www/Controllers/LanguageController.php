<?php
use App\Core;

class LanguageController{

    public static function checkLanguageCookiesData(string $data, array $dataToCheck): bool
    {
        return in_array($data, $dataToCheck);
    }

    public static function getTranslate(): array
    {
        if($_COOKIE["language"] != null && self::checkLanguageCookiesData($_COOKIE["language"])){

        }
    }
}