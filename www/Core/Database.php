<?php

namespace App\Core;

use PDOStatement;

abstract class Database
{
    private \PDO $pdo;
    private string $table;
    private string $database;

    public function __construct()
    {
        $this->database = DBNAME;
        try {
            $this->pdo = new \PDO(DBDRIVER . ":host=" . DBHOST . ";port=" . DBPORT . ";dbname=" . DBNAME, DBUSER, DBPWD);
            $this->pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        } catch (\Exception $e) {
            $error = match ($e->getCode()) {
                1005 => "",
                1044 => "",
                1045 => "",
                1698 => "",
                2002 => "",
                default => ""
            };
            ErrorHandler::displayError($error);
        }

        $classExploded = explode("\\", get_called_class());
        $this->table = DBNAME. "_" . strtolower(end($classExploded));
    }

    /**
     * @param array $parameters
     * @param array $whereConditions
     * @param string $whereClause
     * @param mixed $order
     * @param array $orderConditions
     * @param string $orderClause
     * @param string $query
     * @return false|PDOStatement
     */
    public function buildQuery(array $parameters, array $whereConditions, string $whereClause, mixed $order, array $orderConditions, string $orderClause, string $query): PDOStatement|false
    {
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

    public function find($parameters = [], $order = []): bool
    {
        $whereClause = $orderClause = '';
        $whereConditions = $orderConditions =[];
        $select = "SELECT * FROM $this->table";
        $query = $this->buildQuery($parameters, $whereConditions, $whereClause, $order, $orderConditions, $orderClause, $select);
        $query->execute();
        return $query->fetch(\PDO::FETCH_ASSOC) !== null ?  $query->fetch(\PDO::FETCH_ASSOC) : false;
    }


}

