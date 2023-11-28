<?php

namespace Database\Seeders;

use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ConditionSensorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if (config('app.env') == 'production') {
            return;
        }

        $faker = Factory::create();
        $limit = 100;

        DB::table('condition_sensor')->truncate();
        for ($i = 1; $i <= $limit; $i++) {
            DB::table('condition_sensor')->insert([
                'condition_id' => rand(1, 100),
                'sensor_port_id' => rand(1, 50),
                'sensor_port_name' => $faker->firstName,
                'threshould' => rand(1.0,100.0),
                'view_no' => rand(1, 10),
                'condition' => rand(1, 3),
            ]);
        }
    }
}
