<?php

namespace App;

use PDO;

class DB
{
    private PDO $pdo;

    public function __construct(array $config)
    {
        try {
            $this->pdo = new PDO("mysql:host=".$config['host'].";dbname=".$config['database'], $config['user'], $config['pass']);
        }
        catch (\PDOException $e) {
            throw new \PDOException($e->getMessage(), $e->getCode());
        }
    }

    public function __call($name, $arguments)
    {
        return call_user_func_array([$this->pdo, $name], $arguments);
    }
}