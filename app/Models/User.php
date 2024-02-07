<?php

namespace App\Models;

use App\Model;

class User extends Model
{
    public function create ($username, $email, $password) {
        $newUserStatement = $this->db->prepare(
            'INSERT INTO users (username, email, password) VALUES (?, ?, ?)'
        );

        $newUserStatement->execute([$username, $email, $password]);
    }
}