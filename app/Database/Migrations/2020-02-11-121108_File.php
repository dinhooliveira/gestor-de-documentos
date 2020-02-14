<?php namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class File extends Migration
{
	public function up()
	{
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'unsigned' => TRUE,
                'constraint'     => 5,
                'auto_increment' => TRUE
            ],
            'name' => [
                'type' => 'VARCHAR',
                'constraint' => 240,
            ],
            'file_location' => [
                'type' => 'TEXT',
            ],
            'customer_id' => [
                'type' => 'INT',
                'unsigned' => TRUE,
                'constraint'     => 5,
            ],
            'user_id' => [
                'type' => 'INT',
                'unsigned' => TRUE,
                'constraint'     => 5,
            ],
            'created_at' => [
                'type' => 'DATETIME',
            ],
            'updated_at' => [
                'type' => 'DATETIME',
            ],

        ]);
        $this->forge->addKey('id', TRUE);
        $this->forge->addForeignKey('customer_id','customer','id');
        $this->forge->addForeignKey('user_id','user','id');
        $this->forge->createTable('file');
	}

	//--------------------------------------------------------------------

	public function down()
	{
        $this->forge->dropTable('file');
	}
}
