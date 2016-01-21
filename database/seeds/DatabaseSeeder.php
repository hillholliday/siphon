<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $this->call(UsersTableSeeder::class);
        $this->call(TeamsTableSeeder::class);
        $this->call(RolesTableSeeder::class);
        $this->call(FeedsTableSeeder::class);
        $this->call(TagTableSeeder::class);

        Model::reguard();
    }
}
