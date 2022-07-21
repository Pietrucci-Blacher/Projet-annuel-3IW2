<?php

if ($_SERVER['SERVER_NAME'] === 'localhost') {
    define("DBUSER", "root");
    define("DBPWD", "password");
    define("DBHOST", "database");

} else if ($_SERVER['SERVER_NAME'] === 'chiperz.fr') {
    define("DBUSER", "admin5978569");
    define("DBPWD", "14LNhCcIl7XlahGufU1");
    define("DBHOST", "localhost");
}


define("DBNAME", "chiperz");
define("DBDRIVER", "mysql");
define("DBPORT", "3306");
define("DBPREFIXE", "chiperz_");

define("CAPTCHA_SITEKEY", "10000000-ffff-ffff-ffff-000000000001");

