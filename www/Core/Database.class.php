<?php

namespace App\Core;

abstract class Database
{
    private \PDO $pdo;

    public function __construct()
    {
        try{
            $this->pdo = new \PDO("");
            $this->pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        }catch (\Exception $e){
            die("Erreur d'initialisation de l'extension PDO :" . $e->getMessage());
        }
    }



    public function save():void{

    }

    public function deleteItem():void{

    }
}