<?php namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class ForgotPassword extends Migration
{
    public function up()
    {

        $fields = [
            'forgot_password' => [
                'type' => 'VARCHAR',
                'constraint' => 240
            ]
        ];
        $this->forge->addColumn('customer', $fields);
        $this->forge->addColumn('user', $fields);


    }

    //--------------------------------------------------------------------

    public function down()
    {
        $this->forge->dropColumn('customer', 'forgot_password');
        $this->forge->dropColumn('user', 'forgot_password');
    }
}
