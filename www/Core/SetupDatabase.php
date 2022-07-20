<?php

namespace App\Core;

use PDO;

class SetupDatabase{
    public $db;
    protected $isDbExist;

    public function __construct()
    {
        try {
            $this->db = new PDO('mysql:host=' . Config::getInstance()->get('db_host') . ';dbname=' . Config::getInstance()->get('db_name'), Config::getInstance()->get('db_login'), Config::getInstance()->get('db_pwd'));
        } catch (\Exception $e) {
            echo $e->getMessage(), PHP_EOL;
        }

        if ($this->db->query("USE " . Config::getInstance()->get('db_name')) === false) {
            $this->isDbExist = false;
        } else{
            $this->isDbExist = true;
        }

        if(!$this->isDbExist){
            $this->createDb();
        }

    }

    public function createDb(){
        $this->db->setAttribute(PDO::MYSQL_ATTR_INIT_COMMAND, "SET NAMES 'utf8'");
        $sql = "CREATE DATABASE IF NOT EXISTS " . Config::getInstance()->get('db_name') . " CHARACTER SET 'utf8'";
        $this->db->exec($sql);
        if($this->db->query("USE " . Config::getInstance()->get('db_name')) === false){
            Session::addMessage("SUCESS_CREATE_DATABASE", "La base de données a bien été créée", "success");
        }
    }
}




