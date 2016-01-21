<?php

use Illuminate\Database\Seeder;

class NetworkTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	DB::table('networks')->insert([
            'title' => 'twitter'
        ]);

        DB::table('networks')->insert([
            'title' => 'instagram'
        ]);
    }
}
