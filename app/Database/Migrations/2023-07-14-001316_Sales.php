<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Sales extends Migration
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
            'customer_id'       => [
                'type'          => 'INT',
                'unsigned'      => true,
                'constraint'    => 11,
            ],
            'employee_id'       => [
                'type'          => 'INT',
                'unsigned'      => true,
                'constraint'    => 11,
            ],
            'total'             => [
                'type'          => 'INT',
                'constraint'    => 11,
            ],
            'created_at'         => [
                'type'          => 'datetime',
                'null'          => true,
            ]
        ]);

        $this->forge->addKey('id', true);
        $this->forge->addKey('customer_id', false);
        $this->forge->addKey('employee_id', false);
        $this->forge->addForeignKey('customer_id', 'customers', 'id');
        $this->forge->addForeignKey('employee_id', 'employees', 'id');
        $this->forge->createTable('sales');
        $this->db->enableForeignKeyChecks();
    }

    public function down()
    {
        $this->forge->dropTable('sales');
    }
}
