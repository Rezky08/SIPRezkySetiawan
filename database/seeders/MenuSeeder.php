<?php

namespace Database\Seeders;

use App\Models\Menu;
use Illuminate\Database\Seeder;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $menus = [
            [
                'item_name' => 'User',
                'item_link' => url('/')
            ],
            [
                'item_name' => 'User List',
                'item_link' => url('/')
            ],
        ];
        foreach ($menus as $key => $menu) {
            (new Menu)->firstOrCreate($menu);
        }
    }
}
