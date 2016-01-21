<?php

use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	DB::table('roles')->insert([
            'level' => 0,
            'title' => 'developer'
        ]);

        DB::table('roles')->insert([
            'level' => 1,
            'title' => 'moderator'
        ]);

        DB::table('roles')->insert([
            'level' => 3,
            'title' => 'watcher'
        ]);


        DB::table('users_roles')->insert([
            'user_id' => 1,
            'role_id' => 1
        ]);
    }
}
