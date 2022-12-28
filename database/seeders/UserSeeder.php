<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
        $data = [
            [
                'role' => '1',
                'name' => 'test',
                'username' => 'test1',
                'phone' => '1',
                'email' => 'lxc150896@gmail.com',
                'password' => bcrypt('12345'),
            ],
            [
                'role' => '1',
                'name' => 'test',
                'username' => 'test2',
                'phone' => '2',
                'email' => 'lxc@gmail.com',
                'password' => bcrypt('12345'),
            ],
            [
                'role' => '1',
                'name' => 'test',
                'phone' => '3',

                'username' => 'test3',
                'email' => 'admin@gmail.com',
                'password' => bcrypt('12345'),
            ],
        ];
        \DB::table('users')->insert($data);
    }
}
