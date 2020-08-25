<?php

use Illuminate\Database\Seeder;
use App\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $hiep = User::create([
            'name' => 'hiep',
            'email' => 'hiep1998vnhn11@gmail.com',
            'password' => bcrypt('Hiep1998@@')
        ]);

        $test = User::create([
            'name' => 'test',
            'email' => 'test@gmail.com',
            'password' => bcrypt('Hiep1998@@')
        ]);
    }
}
