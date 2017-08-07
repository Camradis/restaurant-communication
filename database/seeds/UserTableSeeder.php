<?php

use Illuminate\Database\Seeder;
use App\Models\Role;
use App\Models\User;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $adminRole = Role::whereName('admin')->first();
        $serverRole = Role::whereName('server')->first();
        $kitchenRole = Role::whereName('kitchen')->first();

        $admin = new User();
        $admin->name = 'Admin Name';
        $admin->email = 'admin@example.com';
        $admin->password = bcrypt('secret');
        $admin->save();
        $admin->assignRole($adminRole);

        $server = new User();
        $server->name = 'Server Name';
        $server->email = 'server@example.com';
        $server->password = bcrypt('secret');
        $server->save();
        $server->assignRole($serverRole);

        $kitchen = new User();
        $kitchen->name = 'Kitchen Name';
        $kitchen->email = 'kitchen@example.com';
        $kitchen->password = bcrypt('secret');
        $kitchen->save();
        $kitchen->assignRole($kitchenRole);
    }
}
