<?php namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class HistoryDownload extends Migration
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
			'file_id'=>[
				'type' => 'INT',
				'unsigned' => TRUE,
                'constraint'     => 5,
			],
			'customer_id' => [
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
        $this->forge->addForeignKey('file_id','file','id');
        $this->forge->createTable('customer_download_history');
	}

	//--------------------------------------------------------------------

	public function down()
	{
		$this->forge->dropTable('customer_download_history');

	}


}
