<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'nama' => 'Admin',
                'username' => 'admin',
                'email' => 'admin@gmail.com',
                'password' => password_hash('admin123', PASSWORD_DEFAULT), // Ganti dengan password yang di-hash
                'level_user' => 1, // Sesuaikan dengan role_id yang sesuai
            ],

            [
                'nama' => 'Kepala Departemen',
                'username' => 'kadep',
                'email' => 'kadep@gmail.com',
                'password' => password_hash('kadep123', PASSWORD_DEFAULT), // Ganti dengan password yang di-hash
                'level_user' => 2, // Sesuaikan dengan role_id yang sesuai
            ],

            [
                'nama' => 'Kepala Dinas',
                'username' => 'kadis',
                'email' => 'kadis@gmail.com',
                'password' => password_hash('kadis123', PASSWORD_DEFAULT), // Ganti dengan password yang di-hash
                'level_user' => 3, // Sesuaikan dengan role_id yang sesuai
            ],

            [
                'nama' => 'MyUser',
                'username' => 'user',
                'email' => 'user@gmail.com',
                'password' => password_hash('user123', PASSWORD_DEFAULT), // Ganti dengan password yang di-hash
                'level_user' => 4, // Sesuaikan dengan role_id yang sesuai
            ],

        ];

        // Memasukkan data ke tabel user
        $this->db->table('user')->insertBatch($data);
    }
}
