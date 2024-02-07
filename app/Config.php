<?php

namespace App;

class Config
{
    protected array $config = [];

    public function __construct(array $env)
    {
        $this->config = [
            'db' => [
                'host'     => $env['DB_HOST'],
                'user'     => $env['DB_USERNAME'],
                'pass'     => $env['DB_PASSWORD'],
                'database' => $env['DB_NAME'],
                'driver'   => $env['DB_DRIVER'],
            ],
        ];
    }

    public function __get($name)
    {
        return $this->config[$name];
    }
}