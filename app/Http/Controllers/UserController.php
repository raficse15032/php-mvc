<?php

namespace App\Http\Controllers;

use App\View;
use PDO;

class UserController{
    public function index($id, $invoice):string
    {
        var_dump($id, $invoice);

        // $pdo = new PDO("mysql:host=php-mysql;dbname=php_mvc", "root", "secret");

        // var_dump($pdo);

        $data = ["name" => "Abu Mohammad Rafi","message" => "Welcome to MVC"];

        return View::make('user/index',$data);
    }
}