<?php namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Customer extends Migration
{
	public function up()
	{
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ],
            'name' => [
                'type' => 'VARCHAR',
                'constraint' => 240,
            ],
            'password' => [
                'type' => 'VARCHAR',
                'constraint' => 240
            ],
            'email' => [
                'type' => 'VARCHAR',
                'constraint' => 240,
                'unique'         => true,
            ],
            'created_at' => [
                'type' => 'DATETIME',
            ],
            'updated_at' => [
                'type' => 'DATETIME',
            ],

        ]);
        $this->forge->addKey('id', TRUE);
        $this->forge->createTable('customer');
	}

	//--------------------------------------------------------------------

	public function down()
	{
        $this->forge->dropTable('customer');
	}
}
