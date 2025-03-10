<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateWorkOrdersTable extends Migration
{
    public function up()
    {
        //
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'workorder_number' => [
                'type'       => 'VARCHAR',
                'constraint' => '50',
            ],
            'product_name' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'quantity' => [
                'type'       => 'INT',
                'constraint' => 11,
            ],
            'deadline' => [
                'type' => 'DATE',
            ],
            'operator' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
                'null'       => false,
            ],
            'status' => [
                'type'       => 'ENUM',
                'constraint' => ['Pending', 'In Progress', 'Completed', 'Canceled'],
                'default'    => 'Pending',
            ],
            'is_deleted' => [
                'type'              => 'ENUM("0", "1")',
				'default'			=> '0'
            ],
            'created_by' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
                'null'       => false,
            ],
            'updated_by' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
                'null'       => true,
            ],
            'created_at DATETIME DEFAULT CURRENT_TIMESTAMP',
            'updated_at DATETIME DEFAULT CURRENT_TIMESTAMP',
        ]);
		
		$this->forge->addKey('id', true);
        $this->forge->createTable('workorders');
    }

    public function down()
    {
        //
        $this->forge->dropTable('workorders');
    }
}
