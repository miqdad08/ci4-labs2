<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run()
    {
        $data = [
            ['name' => 'Teknologi'],
            ['name' => 'Pendidikan'],
            ['name' => 'Olahraga'],
        ];

        $this->db->table('categories')->insertBatch($data);
    }
}
