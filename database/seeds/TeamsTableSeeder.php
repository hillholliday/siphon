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
            'link' => 'hill-holliday'
        ]);

        DB::table('teams')->insert([
            'name' => 'Dunkin Donuts',
            'link' => 'dunkin-donuts'
        ]);

        DB::table('teams')->insert([
            'name' => 'Bank of America',
            'link' => 'bank-of-america'
        ]);

        DB::table('teams')->insert([
            'name' => 'Harvard Pilgrim',
            'link' => 'harvard-pilgrim'
        ]);

        DB::table('users_teams')->insert([
            'user_id' => 1,
            'team_id' => 1
        ]);
    }
}
