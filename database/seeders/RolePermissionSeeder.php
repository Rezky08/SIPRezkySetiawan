<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use App\Models\RolePermission;
use Illuminate\Database\Seeder;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permission = Permission::all();

        // admin
        $role = Role::where('name', 'admin')->first();
        foreach ($permission as $item) {
            $role_permission_data = [
                'role_id' => $role->id,
                'permission_id' => $item->id
            ];
            $role_permission = (new RolePermission)->firstOrCreate($role_permission_data);
        }

        // user
        $role = Role::where('name', 'user')->first();
        $permission = Permission::where('permission_name', 'like', '%read')->get();
        foreach ($permission as $item) {
            $role_permission_data = [
                'role_id' => $role->id,
                'permission_id' => $item->id
            ];
            $role_permission = (new RolePermission)->firstOrCreate($role_permission_data);
        }
    }
}
