<?php

namespace App\Core;

use LanguageController;
use PDO;
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
                1005 => LanguageController::getTranslate(),
                1044 => LanguageController::getTranslate(),
                1045 => LanguageController::getTranslate(),
                1698 => LanguageController::getTranslate(),
                2002 => LanguageController::getTranslate(),
                default => LanguageController::getTranslate()
            };
            ErrorHandler::displayError((string)$error);
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
     * @param string $orderClaus
     * @return false|PDOStatement
     */
    public function buildQuery(array $parameters, array $whereConditions, string $whereClause, mixed $order, array $orderConditions, string $orderClaus): PDOStatement|false
    {
        $query = "SELECT * FROM". strtolower($this->table);
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

    public function getNameOfClass($class):string
    {
        return $class->name();
    }

    public function find($parameters = [], $order = []): bool
    {
        $whereClause = $orderClause = '';
        $whereConditions = $orderConditions =[];

        $query = $this->buildQuery($parameters, $whereConditions, $whereClause, $order, $orderConditions, $orderClause);
        $query->execute();
        return $query->fetch(\PDO::FETCH_ASSOC) !== null ?  $query->fetch(\PDO::FETCH_ASSOC) : false;
    }

    public function findAll($parameters = [], $order = []): bool
    {
        $whereClause = $orderClause = '';
        $whereConditions = $orderConditions =[];
        $get_class = "App\Model\\" . $this->getNameOfClass(get_class($this));
        $query = $this->buildQuery($parameters, $whereConditions, $whereClause, $order, $orderConditions, $orderClause);
        return $query->fetchAll(\PDO::FETCH_CLASS, $get_class);
    }


    public function save(): mixed
    {
        $columns = array_diff_key(
            get_object_vars($this),
            get_class_vars(get_class())
        );
        $query = $this->pdo->prepare('INSERT INTO ' . strtolower($this->table) . ' (' .
            implode(',', array_keys($columns)) . ') VALUES ( :' .
            implode(',:', array_keys($columns)) . ' ); ');
        $success = $query->execute($columns);
        if ($success) {
            $searchQuery = $this->pdo->prepare('SELECT * FROM ' . strtolower($this->table) . ' WHERE id = :id');
            $lastInsertId = $this->pdo->lastInsertId();
            $searchQuery->bindParam(':id', $lastInsertId, PDO::PARAM_INT);
            $searchQuery->execute();
            return $searchQuery->fetch(\PDO::FETCH_OBJ);
        }
    }



}

