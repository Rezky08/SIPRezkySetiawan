<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data_insert = [
            [
                'name' => 'admin',
                'created_at' => new \DateTime
            ],
            [
                'name' => 'user',
                'created_at' => new \DateTime
            ]
        ];
        DB::table('roles')->insert($data_insert);
    }
}
