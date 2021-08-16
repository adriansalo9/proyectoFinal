<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('users')->insert([
            'id' => '1',
            'name' => 'Adrian Salo',
            'email' => 'adriansalozgz@gmail.com',
            'password' => bcrypt('metalica'),
            'role_id' => 1
        ]);

        \DB::table('users')->insert([
            'id' => '2',
            'name' => 'admin',
            'email' => 'admin@dws.es',
            'password' => bcrypt('metalica'),
            'role_id' => 2
        ]);
    }
}