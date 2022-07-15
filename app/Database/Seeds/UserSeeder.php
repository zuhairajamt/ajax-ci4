<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use App\Models\UserModel;

class UserSeeder extends Seeder
{
    public function run()
    {
        $user_object = new UserModel();

        $user_object->insertBatch([
            [
                "user_name" => "u3681386_dev",
                "user_email" => "u3681386_dev@gmail.com",
                "user_password" => password_hash("1c0nplus2022", PASSWORD_DEFAULT),
                "role" => "admin"
            ],
        ]);
    }
}
