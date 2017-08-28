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
        $admin->activated = true;
        $admin->save();
        $admin->assignRole($adminRole);

        $server = new User();
        $server->name = 'Server Name';
        $server->email = 'server@example.com';
        $server->password = bcrypt('secret');
        $server->activated = true;
        $server->save();
        $server->assignRole($serverRole);

        $server = new User();
        $server->name = 'Server Name2';
        $server->email = 'server2@example.com';
        $server->password = bcrypt('secret');
        $server->activated = true;
        $server->save();
        $server->assignRole($serverRole);

        $server = new User();
        $server->name = 'Server Name3';
        $server->email = 'server3@example.com';
        $server->password = bcrypt('secret');
        $server->save();
        $server->assignRole($serverRole);

        $kitchen = new User();
        $kitchen->name = 'Kitchen Name';
        $kitchen->email = 'kitchen@example.com';
        $kitchen->password = bcrypt('secret');
        $server->activated = true;
        $kitchen->save();
        $kitchen->assignRole($kitchenRole);
    }
}
