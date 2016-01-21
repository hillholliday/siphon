<?php

use Illuminate\Database\Seeder;

class FeedsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	DB::table('feeds')->insert([
            'team_id' => 1,
            'title' => 'tropic tundra'
        ]);

        DB::table('feeds')->insert([
            'team_id' => 1,
            'title' => 'HHCC'
        ]);
    }
}
