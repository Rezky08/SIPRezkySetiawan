<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Database\Factories\RoleFactory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // make admin default
        $admin_data = [
            'role_id' => Role::where(['name' => 'admin'])->first()->id,
            'name' => 'admin',
            'username' => 'admin',
            'email' => 'admin@admin.com',
            'password' => Hash::make('password'),
        ];
        (new User)->create($admin_data);
        // make user default
        $user_data = [
            'role_id' => Role::where(['name' => 'user'])->first()->id,
            'name' => 'user',
            'username' => 'user',
            'email' => 'user@user.com',
            'password' => Hash::make('password'),
        ];
        (new User)->create($user_data);

        // random user
        User::factory()->count(10)->create();
    }
}
