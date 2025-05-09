<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Users extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'                    => [
                'type'              => 'INT',
                'unsigned'          => true,
                'auto_increment'    => true
            ],
            'username'              => [
                'type'              => 'VARCHAR',
                'constraint'        => 30,
                'null'              => FALSE,
            ],
            'password'              => [
                'type'              => 'VARCHAR',
                'constraint'        => 50,
                'null'              => FALSE,
            ],
            'role'                  => [
                'type'              => 'ENUM',
                'constraint'        => ['Ketua', 'Sekretaris', 'Bendahara'],
                'null'              => FALSE,
            ],
            'is_active'             => [
                'type'              => 'BOOLEAN',
                'default'           => true
            ],
            'created_at DATETIME DEFAULT CURRENT_TIMESTAMP',
        ]);

        $this->forge->addKey('id', TRUE);
        $this->forge->createTable('users', TRUE);
    }

    public function down()
    {
        $this->forge->dropTable('users');
    }
}
