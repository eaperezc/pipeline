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
        $user_id = DB::table('users')->insert([
            'name' => 'Enrique',
            'email' => 'eperez@test.com',
            'password' => bcrypt('test123')
        ]);

        $pipeline_id = DB::table('pipelines')->insert([
            'name' => str_random(10),
            'user_id' => $user_id,
            'created_at' => Carbon\Carbon::now()
        ]);

        DB::table('nodes')->insert([
            'name' => str_random(10),
            'hierarchy_level' => 1,
            'type' => 'start',
            'pipeline_id' => $pipeline_id
        ]);
    }
}
