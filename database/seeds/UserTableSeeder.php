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
        $kitchenRole = Role::whereName('kitchen')->first();

        $admin = new User();
        $admin->name = 'Admin Name';
        $admin->email = 'admin@example.com';
        $admin->password = bcrypt('secret');
        $admin->activated = true;
        $admin->role()->associate($adminRole);

        $admin->save();

        $admin = new User();
        $admin->name = 'Kitchen Name';
        $admin->email = 'kitchen@example.com';
        $admin->password = bcrypt('secret');
        $admin->activated = true;
        $admin->role()->associate($kitchenRole);

        $admin->save();
    }
}
