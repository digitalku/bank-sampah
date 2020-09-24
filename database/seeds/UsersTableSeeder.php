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
        App\User::create([
	       'name' => 'admin',
	       'email' => 'admin@gmail.com',
	       'username' => 'admin',
	       'alamat' => 'gg kepelan',
	       'password' => bcrypt('secret'),
	       'role_id' => 1
		]);

		App\User::create([
	       'name' => 'petugas',
	       'email' => 'petugas@gmail.com',
	       'username' => 'petugas',
	       'alamat' => 'gg muhajirin',
	       'password' => bcrypt('secret'),
	       'role_id' => 2
		]);

		App\User::create([
	       'name' => 'user',
	       'email' => 'user@gmail.com',
	       'username' => 'user',
	       'alamat' => 'gg panjunan',
	       'password' => bcrypt('secret'),
	       'role_id' => 3
		]);

    }
}
