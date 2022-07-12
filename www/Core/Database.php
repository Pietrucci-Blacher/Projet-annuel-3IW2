<?php

namespace App\Core;

interface QueryBuilder
{
    public function insert(string $table, array $columns): QueryBuilder;

    public function select(string $table, array $columns): QueryBuilder;

    public function where(string $column, string $value, string $operator = "="): QueryBuilder;

    public function rightJoin(string $table, string $fk, string $pk): QueryBuilder;

    public function limit(int $from, int $offset): QueryBuilder;

    public function getQuery(): string;
}

class MysqlBuilder implements QueryBuilder
{
    private $pdo;

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

    }

    private $query;

    private function reset()
    {
        $this->query = new \stdClass();
    }

    public function insert(string $table, array $columns): QueryBuilder
    {
        $this->reset();

        $this->query->base = "INSERT INTO " . $table . " (" . implode(", ", $columns) . ") VALUES (";

        for ($i = 0; $i < count($columns); $i++) {

            if ($i == 0) {
                $this->query->base .= '?';
            } else {
                $this->query->base .= ', ?';
            }
        }

        $this->query->base .= ')';

        return $this;
    }

    public function update(string $table, array $columns): QueryBuilder
    {
        $this->reset();

        $this->query->base = "UPDATE " . $table . " SET ";

        $x = 1;
        foreach ($columns as $name => $value) {
            $this->query->base .= "$name = $value";
            if ($x < count($columns)) {
                $this->query->base .= ", ";
            }
            $x++;
        }


        return $this;
    }

    public function select(string $table, array $columns = null): QueryBuilder
    {
        if(!$columns){
            $columns = ["*"];
        }
        $this->reset();
        $this->query->base = "SELECT " . implode(", ", $columns) . " FROM " . $table;
        return $this;
    }

    public function where(string $column, string $value, string $operator = "="): QueryBuilder
    {
        $this->query->where[] = $column . $operator . "'". $value . "'";
        return $this;
    }

    public function rightJoin(string $table, string $fk, string $pk): QueryBuilder
    {
        $this->query->join[] = " RIGHT JOIN " . $table . " ON " . $pk . " = " . $fk;
        return $this;
    }

    public function limit(int $from, int $offset): QueryBuilder
    {
        $this->query->limit = " LIMIT " . $from . ", " . $offset;
        return $this;
    }

    public function executeQuery($sql)
    {
        $query = $this->pdo->prepare($sql);
        $query->execute();
    }

    public function fetchQuery($sql): array
    {
        $query = $this->pdo->prepare($sql);
        $query->execute();
        return $query->fetchAll();
    }

    public function getQuery(): string
    {
        $query = $this->query;

        $sql = $query->base;

        if (!empty($query->join)) {
            $sql .= implode(' ', $query->join);
        }

        if (!empty($query->where)) {
            $sql .= " WHERE " . implode(' AND ', $query->where);
        }

        if (isset($query->limit)) {
            $sql .= $query->limit;
        }

        $sql .= ";";

        return $sql;
    }
}


class Database extends MysqlBuilder
{
    private $pdo;
    private $table;


    public function __construct()
    {
        parent::__construct();

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

    public function getTable(): string
    {
        return $this->table;
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
            return null;
        }

        return false;
    }

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
        $get_class = get_class($this);
        $query = $this->buildQuery($parameters, $whereConditions, $whereClause, $order, $orderConditions, $orderClause);
        return $query->fetchAll(\PDO::FETCH_CLASS, $get_class);
    }

    public function delete($id)
    {
        $sql = "DELETE FROM ".$this->table." WHERE id=:id";
        $queryPrepared = $this->pdo->prepare($sql);
        $queryPrepared->execute( ["id"=>$id] );
    }
}