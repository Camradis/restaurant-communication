<?php

use Illuminate\Database\Seeder;
use App\Models\Role;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Models\User::class)->states('admin')->create([
            'email' => 'admin@example.com',
            'name'  => 'Administrator'
        ]);

        factory(App\Models\User::class)->states('kitchen')->create([
            'email' => 'kitchen@example.com',
            'name'  => 'Kitchen Manager'
        ]);

        foreach(range(1,5) as $index)
        {
            factory(App\Models\User::class)->states('server')->create([
                'email' => "server$index@example.com"
            ]);
        }
    }
}
