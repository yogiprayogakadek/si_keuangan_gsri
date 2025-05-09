<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    {
        $users = [
            [
                'username'  => 'Ketua',
                'role'      => 'Ketua',
                'is_active' => true,
                'password'  => password_hash('12345678', PASSWORD_DEFAULT)
            ],
            [
                'username'  => 'Sekretaris',
                'role'      => 'Sekretaris',
                'is_active' => true,
                'password'  => password_hash('12345678', PASSWORD_DEFAULT)
            ],
            [
                'username'  => 'Bendahara',
                'role'      => 'Bendahara',
                'is_active' => true,
                'password'  => password_hash('12345678', PASSWORD_DEFAULT)
            ],
        ];

        foreach($users as $user) {
            $this->db->table('users')->insert($user);
        }
    }
}
