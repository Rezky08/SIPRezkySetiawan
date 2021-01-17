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
        $permissions = [
            'create', 'read', 'update', 'delete'
        ];

        $permission_data = [
            'job', 'company'
        ];

        $data = [];
        foreach ($permission_data as $p_data) {
            foreach ($permissions as $permission) {
                $data[]['permission_name'] = $p_data . '-' . $permission;
            }
        }

        foreach ($data as $item) {
            try {
                (new Permission)->firstOrCreate($item);
            } catch (\Throwable $th) {
                Log::error($th->getMessage());
            }
        }
    }
}
