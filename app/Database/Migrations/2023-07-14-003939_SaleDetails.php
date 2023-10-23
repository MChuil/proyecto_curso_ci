<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class SaleDetails extends Migration
{
    public function up()
    {
        $this->db->disableForeignKeyChecks();
        $this->forge->addField([
            'id'                => [
                'type'          => 'INT',
                'unsigned'      => true,
                'constraint'    => 11,
                'auto_increment' => true
            ],
            'sale_id'       => [
                'type'          => 'INT',
                'unsigned'      => true,
                'constraint'    => 11,
            ],
            'product_id'       => [
                'type'          => 'INT',
                'unsigned'      => true,
                'constraint'    => 11,
            ],
            'quantity'             => [
                'type'          => 'INT',
                'constraint'    => 11,
            ],
            'price'         => [
                'type'          => 'INT',
                'constraint'    => 11,
            ],
            'created_at'         => [
                'type'          => 'datetime',
                'null'          => true,
            ]
        ]);

        $this->forge->addKey('id', true);
        $this->forge->addKey('sale_id', false);
        $this->forge->addKey('product_id', false);
        $this->forge->addForeignKey('sale_id', 'sales', 'id');
        $this->forge->addForeignKey('product_id', 'products', 'id');
        $this->forge->createTable('saledetails');
        $this->db->enableForeignKeyChecks();
    }

    public function down()
    {
        $this->forge->dropTable('saledetails');
    }
}
