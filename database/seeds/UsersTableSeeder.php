<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'email' => "misha@gmail.com",
            'password' => Hash::make('password'),
            'name' => 'misha',
            'surname' => 'otroshchenko',
            'role' => 'admin',
            'department_id' => 1
        ]);
    }
}
