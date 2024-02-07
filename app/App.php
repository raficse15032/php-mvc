<?php

namespace App;

class App
{
    private static DB $db;

    public function __construct(protected Config $config)
    {
        static::$db = new DB($config->db ?? []); 
    }

    public static function db()
    {
        return static::$db;
    }
} 