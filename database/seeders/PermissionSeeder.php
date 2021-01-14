<?php

namespace Database\Seeders;

use App\Models\Permission;
use Exception;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Log;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'permission_name' => 'create'
            ],
            [
                'permission_name' => 'read'
            ],
            [
                'permission_name' => 'update'
            ],
            [
                'permission_name' => 'delete'
            ]
        ];
        foreach ($data as $item) {
            try {
                (new Permission)->firstOrCreate($item);
            } catch (\Throwable $th) {
                Log::error($th->getMessage());
            }
        }
    }
}
