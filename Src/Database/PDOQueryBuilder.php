<?php
/**
 * Created by PhpStorm.
 * User: ejfr1
 * Date: 12/29/2019
 * Time: 10:47 AM
 */

namespace App\Database;


use PDO;

class PDOQueryBuilder extends QueryBuilder
{

    public function get()
    {
        return $this->statement->fetchAll();
    }

    public function count()
    {
       return $this->statement->rowCount();
    }

    public function lastInsertedId()
    {
        $this->connection->lastInsertId();
    }

    public function prepare($query)
    {
       $this->connection->prepare($query);
    }

    public function execute($statement)
    {
        $statement->execute($this->bindings);
        $this->bindings = [];
        $this->placeholders = [];
        return $statement;
    }

    public function fetchInto($className)
    {
        $this->stament->fetchAll(PDO::FETCH_CLASS, $className);
    }
}