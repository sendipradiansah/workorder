<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateUsersTable extends Migration
{
    public function up()
    {
        //
        $this->forge->addField([
            'id'          => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'name' => [
                'type'              => 'VARCHAR',
                'constraint'        => 100,
                'null'				=> false,
            ],
            'username'    => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
                'null'       => false   
            ],
            'password'    => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => false   
            ],
            'role'        => [
                'type' => 'ENUM("administrator","manager_production", "operator")', 
                'default' => 'operator',
            ],
            'active' => [
                'type'      => 'ENUM("Yes", "No")',
				'default'   => 'Yes',
            ],
			'is_deleted' => [
                'type'      => 'ENUM("0", "1")',
				'default'   => '0',
            ],
            'created_by'	=> [
				'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
                'null'       => false,	
			],
			'updated_by'	=> [
				'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
                'null'       => true	
            ],
            'created_at DATETIME DEFAULT CURRENT_TIMESTAMP',
            'updated_at DATETIME DEFAULT CURRENT_TIMESTAMP'
        ]);

        $this->forge->addPrimaryKey('id');
        $this->forge->createTable('users');
    }

    public function down()
    {
        //
        $this->forge->dropTable('users');
    }
}
