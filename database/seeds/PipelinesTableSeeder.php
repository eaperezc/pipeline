<?php

use Illuminate\Database\Seeder;

class PipelinesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $id = DB::table('pipelines')->insert([
            'name' => str_random(10)
        ]);

        DB::table('nodes')->insert([
            'name' => str_random(10),
            'type' => 'empty',
            'pipeline_id' => $id
        ]);
    }
}
