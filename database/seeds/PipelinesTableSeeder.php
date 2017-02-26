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
            'hierarchy_level' => 1,
            'pipeline_id' => $id
        ]);
    }
}
