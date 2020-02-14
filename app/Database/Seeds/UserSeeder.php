<?php
namespace App\Database\Seeds;

class UserSeeder extends \CodeIgniter\Database\Seeder
{
    public function run()
    {

        $data = [
            'name' => 'admin',
            'email'    => 'admin@gmail.com',
            'password' => \password_hash('admin',PASSWORD_BCRYPT)
        ];

//        // Simple Queries
//        $this->db->query("INSERT INTO user (name, email,password) VALUES(:name:, :email: , :password:)",
//            $data
//        );

        // Using Query Builder
        $this->db->table('user')->insert($data);
    }

}
