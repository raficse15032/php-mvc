<?php

namespace App\Http\Controllers;

use App\App;
use App\Models\User;
use App\View;
use PDO;

class UserController{
    public function index($id, $invoice):string
    {
        $db = App::db();
        $email = 'abc@gmail.com';
        $username = 'xyz-new';
        $password = 'abc';
        $amount = 10;

        try {
            $db->beginTransaction();

            $user = new User();

            $user->create($username, $email, $password);

            $userId = (int)$db->lastInsertId();

            $newInvoiceStatement = $db->prepare(
                'INSERT INTO invoices (user_id, amount) VALUES (?, ?)'
            );

            $newInvoiceStatement->execute([$userId, $amount]);

            $db->commit();
        }
        catch (\Throwable $e) {
            if($db->inTransaction()){
                $db->rollBack();
            }
        }

        $data = ["name" => "Abu Mohammad Rafi","message" => "Welcome to MVC"];

        return View::make('user/index',$data);
    }
}