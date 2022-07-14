<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Users extends Migration
{
    public function up()
    {
        // Membuat kolom/field untuk tabel users
        $this->forge->addField([
            'user_id'          => [
                'type'           => 'INT',
                'constraint'     => 5,
                'unsigned'       => true,
                'auto_increment' => true
            ],
            'user_name'       => [
                'type'           => 'VARCHAR',
                'constraint'     => '255'
            ],
            'user_email'      => [
                'type'           => 'VARCHAR',
                'constraint'     => '255'
            ],
            'user_password'      => [
                'type'           => 'VARCHAR',
                'constraint'     => '255'
            ],
            'user_created_at'      => [
                'type'           => 'timestamp'
            ],
            'role'               => [
                'type'           => 'enum("admin", "user")',

            ]
        ]);
 
        // Membuat primary key
        $this->forge->addKey('user_id', TRUE);
 
        // Membuat tabel users
        $this->forge->createTable('users', TRUE);
    }

    public function down()
    {
        // menghapus tabel users
        $this->forge->dropTable('users');
    }
}
