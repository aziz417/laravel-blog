<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'role_id'  => '1',
            'name'     => 'Md.Azizul Islam Admin',
            'username' => 'Admin',
            'email'    => 'admin@test.com',
            'password' => bcrypt('rootadmin'),
        ]);

        DB::table('users')->insert([
            'role_id'  => '2', 
            'name'     => 'Md.Azizul Islam Author',
            'username' => 'Author',
            'email'    => 'author@test.com',
            'password' => bcrypt('rootauthor'),
        ]);
    }
}
