<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Products extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'code' => [
                'type'       => 'VARCHAR',
                'constraint' => '20',
            ],
            'title' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
            ],
            'description' =>[
                'type' => "TEXT"
            ],
            'price' => [
                'type' => 'INT',
                'constraint'     => 11,
            ],
            'quantity' =>[
                'type' => 'DECIMAL',
                'constraint' => '10,2'
            ],
            'created_at' => [
                'type' => 'DATETIME',
            ]
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('Products');
    }

    public function down()
    {
        $this->forge->dropTable("Products");
    }
}
