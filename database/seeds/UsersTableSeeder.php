<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'zulfikar',
            'email' => 'zulfikar@gmail.com',
            'password' => bcrypt('secret'),
            'akses' => "admin"
        ]);
        User::create([
            'name' => 'johan',
            'email' => 'johan@gmail.com',
            'password' => bcrypt('secret'),
            'akses' => "pelanggan"
        ]);
        User::create([
            'name' => 'sulton',
            'email' => 'sulton@gmail.com',
            'password' => bcrypt('secret'),
            'akses' => "pelanggan"
        ]);
    }
}
