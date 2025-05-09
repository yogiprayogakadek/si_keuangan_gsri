<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class UangMasuk extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'                    => [
                'type'              => 'INT',
                'unsigned'          => true,
                'auto_increment'    => true
            ],
            'jumlah'                => [
                'type'              => 'INT',
                'constraint'        => 11,
                'null'              => FALSE,
            ],
            'sumber'                => [
                'type'              => 'VARCHAR',
                'constraint'        => 255,
                'null'              => FALSE,
            ],
            'keterangan'            => [
                'type'              => 'TEXT',
                // 'null'              => FALSE,
            ],
            'tanggal'               => [
                'type'              => 'DATE',
                'null'              => FALSE,
            ],
            'user_id'               => [
                'type'              => 'INT',
                'unsigned'          => true,
            ],
            'created_at DATETIME DEFAULT CURRENT_TIMESTAMP',
        ]);

        $this->forge->addKey('id', TRUE);

        $this->forge->addForeignKey('user_id', 'users', 'id');
        
        $this->forge->createTable('uang_masuk', TRUE);
    }

    public function down()
    {
        $this->forge->dropTable('uang_masuk', TRUE);
    }
}
