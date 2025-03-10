<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateWorkOrdersLogsTable extends Migration
{
    public function up()
    {
        //
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'auto_increment' => true,
                'unsigned'       => true,
            ],
            'workorder_id' => [
                'type'       => 'INT',
                'unsigned'   => true,
                'null'       => false,
            ],
            'quantity' => [
                'type'    => 'INT',
                'default' => 0,
            ],
            'operator' => [
                'type'     => 'INT',
                'unsigned' => true,
                'null'     => false
            ],
            'status' => [
                'type'       => "ENUM('Pending', 'In Progress', 'Completed')",
                'null'       => false,
            ],
            'start_time DATETIME DEFAULT CURRENT_TIMESTAMP',
            'end_time DATETIME DEFAULT CURRENT_TIMESTAMP',
            'corrected_logs_id' => [
                'type'    => 'INT',
                'unsigned' => true,
                'null'    => true,
            ],
            'is_corrected' => [
                'type'       => "ENUM('Yes', 'No')",
                'null'       => false,
                'default'    => 'No',
            ],
            'created_by' => [
                'type'     => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'null'     => false,
            ],
            'created_at DATETIME DEFAULT CURRENT_TIMESTAMP'
        ]);

        $this->forge->addKey('id', true);
        $this->forge->createTable('workorders_logs');
        
    }

    public function down()
    {
        //
        $this->forge->dropTable('workorders_logs');
    }
}
