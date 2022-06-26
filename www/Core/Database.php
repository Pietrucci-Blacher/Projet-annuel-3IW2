<?php

namespace App\Core;
use PDO;
use PDOStatement;


abstract class Database
{
    private $pdo;
    private $table;


    public function __construct()
    {
        //Faudra intégrer le singleton
        try{
            //Connexion à la base de données
            $this->pdo = new \PDO( DBDRIVER.":host=".DBHOST.";port=".DBPORT.";dbname=".DBNAME ,DBUSER , DBPWD );
            $this->pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        }catch(\Exception $e){
            die("Erreur SQL".$e->getMessage());
        }
        //Récupérer le nom de la table :
        // -> prefixe + nom de la classe enfant
        $classExploded = explode("\\",get_called_class());
        $this->table = DBPREFIXE.strtolower(end($classExploded));

    }

    /**
     * @param mixed $id
     */
    public function setId($id): object
    {
        $sql = "SELECT * FROM ".$this->table. " WHERE id=:id ";
        $queryPrepared = $this->pdo->prepare($sql);
        $queryPrepared->execute( ["id"=>$id] );
        return $queryPrepared->fetchObject(get_called_class());
    }


    protected function save()
    {

        $columns  = get_object_vars($this);
        $varsToExclude = get_class_vars(get_class());
        $columns = array_diff_key($columns, $varsToExclude);
        $columns = array_filter($columns);


       if( !is_null($this->getId()) ){
           foreach ($columns as $key=>$value){
                $setUpdate[]=$key."=:".$key;
           }
           $sql = "UPDATE ".$this->table." SET ".implode(",",$setUpdate)." WHERE id=".$this->getId();
       }else{
            $sql = "INSERT INTO ".$this->table." (".implode(",", array_keys($columns)).")
            VALUES (:".implode(",:", array_keys($columns)).")";
       }

        $queryPrepared = $this->pdo->prepare($sql);
        $queryPrepared->execute( $columns );
    }

    public function find($items) {
        $whereConditions = [];
        $whereClause = [];
        $query = "SELECT * FROM $this->table";
        if(!empty($items)) {
            foreach($items as $key => $value) {
                $whereConditions[] = "$key = '$value'";
            }

            $whereClause = ' WHERE ' . implode(' AND ', $whereConditions);
        }

        $queryPrepared = $this->pdo->prepare($query.$whereClause);
        $queryPrepared->execute();
        $data = $queryPrepared->fetch(\PDO::FETCH_ASSOC);

        if($data) {
            return $data;
        } else {
            return "error";
        }
    }

    /**
     * @param array $parameters
     * @param array $whereConditions
     * @param string $whereClause
     * @param mixed $order
     * @param array $orderConditions
     * @param string $orderClaus
     * @return false|PDOStatement
     */
    public function buildQuery($parameters, $whereConditions, $whereClause, $order, $orderConditions, $orderClaus)
    {
        $query = "SELECT * FROM ". strtolower($this->table);
        if (!empty($parameters)) {
            foreach ($parameters as $key => $value) {
                $whereConditions[] = "`$key` = '$value'";
            }

            $whereClause = ' WHERE ' . implode(' AND ', $whereConditions);
        }

        if (!is_null($order)) {
            foreach ($order as $key => $value) {
                $orderConditions[] = "$key " . strtoupper($value);
            }

            $orderClause = ' ORDER BY ' . implode(', ', $orderConditions);
        }

        return $this->pdo->query($query . $whereClause . (!empty($order) ? $orderClause : ''));
    }


    public function findAll($parameters = [], $order = [])
    {
        $whereClause = $orderClause = '';
        $whereConditions = $orderConditions =[];
        $get_class =  get_class($this);
        $query = $this->buildQuery($parameters, $whereConditions, $whereClause, $order, $orderConditions, $orderClause);
        return $query->fetchAll(PDO::FETCH_CLASS, $get_class);

    }
}
