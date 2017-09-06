<?php

use Illuminate\Database\Seeder;
use App\Models\Role;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role_admin = new Role();
        $role_admin->name = 'admin';
        $role_admin->description = 'A Admin User';
        $role_admin->save();

        $role_kitchen = new Role();
        $role_kitchen->name = 'kitchen';
        $role_kitchen->description = 'A Kitchen User';
        $role_kitchen->save();

        $role_server = new Role();
        $role_server->name = 'server';
        $role_server->description = 'A Server User';
        $role_server->save();
    }
}
