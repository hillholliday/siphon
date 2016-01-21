<?php

use Illuminate\Database\Seeder;

class TagTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	DB::table('tags')->insert([
            'feed_id' => 1,
            'title' => '#hhcc',
            'network_id' => 1,
        ]);

        DB::table('tags')->insert([
            'feed_id' => 1,
            'title' => '#hhcc',
            'network_id' => 2,
        ]);

        DB::table('tags')->insert([
            'feed_id' => 1,
            'title' => '#hillholliday',
            'network_id' => 1,
        ]);
    }
}
