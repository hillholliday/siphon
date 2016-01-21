<?php

use Illuminate\Database\Seeder;

class TeamsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	DB::table('teams')->insert([
            'name' => 'Hill Holliday',
            'slug' => 'hill-holliday'
        ]);

        DB::table('teams')->insert([
            'name' => 'Dunkin Donuts',
            'slug' => 'dunkin-donuts'
        ]);

        DB::table('teams')->insert([
            'name' => 'Bank of America',
            'slug' => 'bank-of-america'
        ]);

        DB::table('teams')->insert([
            'name' => 'Harvard Pilgrim',
            'slug' => 'harvard-pilgrim'
        ]);

        DB::table('users_teams')->insert([
            'user_id' => 1,
            'team_id' => 1
        ]);
    }
}
