<?php

use Illuminate\Database\Seeder;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Models\Role::class)->states('admin')->create();
        factory(App\Models\Role::class)->states('kitchen')->create();
        factory(App\Models\Role::class)->states('server')->create();
        factory(App\Models\Role::class)->states('user')->create();
    }
}
