<?php
namespace App\Database\Seeds;

class UserSeeder extends \CodeIgniter\Database\Seeder
{
    public function run()
    {

        $data = [
            'name' => 'admin',
            'email'    => 'admin@admin.com',
            'password' => \password_hash('admin',PASSWORD_BCRYPT)
        ];

        // Using Query Builder
        $this->db->table('user')->insert($data);
    }

}
