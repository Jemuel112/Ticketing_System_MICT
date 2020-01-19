<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\User::truncate();

        \App\User::create([
            'username' => 'Administrator',
            'fname' => 'Administrator',
            'lname' => 'MCU',
            'department' => 'Administrator',
            'password' => bcrypt('123456789'),
        ]);
        \App\User::create([
            'username' => 'Jemuel',
            'fname' => 'Jemuel',
            'lname' => 'Amerila',
            'department' => 'MICT',
            'password' => bcrypt('qweqweqwe'),
        ]);
        \App\User::create([
            'username' => 'Jemuel1',
            'fname' => 'Jemuel1',
            'lname' => 'Amerila',
            'department' => 'MICT',
            'password' => bcrypt('qweqweqwe'),
        ]);
        \App\User::create([
            'username' => 'MCU',
            'fname' => 'MCU',
            'lname' => 'MCU',
            'department' => 'Admin',
            'password' => bcrypt('qweqweqwe'),
        ]);
    }
}
