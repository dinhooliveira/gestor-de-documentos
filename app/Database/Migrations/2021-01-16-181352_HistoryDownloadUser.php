<?php namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class HistoryDownloadUser extends Migration
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
				'constraint'     => 5,
				'unsigned' => TRUE,
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
        $this->forge->addForeignKey('user_id','user','id');
        $this->forge->addForeignKey('file_id','file','id');
        $this->forge->createTable('user_download_history');
	}

	//--------------------------------------------------------------------

	public function down()
	{
		$this->forge->dropTable('user_download_history');
	}
}
