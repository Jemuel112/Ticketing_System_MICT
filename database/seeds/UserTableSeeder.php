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
            'username' => 'cris',
            'fname' => 'Cris ',
            'lname' => 'Dela Cruz',
            'department' => 'MICT',
            'password' => '$2y$10$WFjDUGxaVl4qkTxX97MLy.8LUpZ9jYR/pSTXIq.rjjsv6zYkmCLta',
        ]);
        \App\User::create([
            'username' => 'joel',
            'fname' => 'Joel',
            'lname' => 'Pamatian',
            'department' => 'MICT',
            'password' => '$2y$10$xdeLNO16zsSlMILFz9ZF8ewazeNbt3HxV968zhcmu8zkr6txG0ZDe',
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
