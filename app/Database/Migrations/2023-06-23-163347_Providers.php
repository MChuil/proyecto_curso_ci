<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Providers extends Migration
{
    public function up()
    {
        
        //Migracion tabla Providers
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'name' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'address' => [
                'type' => 'TEXT',
            ],
            'phone' => [
                'type' => 'INT',
                'constraint' => '11',
            ],
            'created_at' => [
                'type' => 'DATETIME',
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('Providers');
    }

    public function down()
    {
        $this->forge->dropTable('Providers');
    }
}
