<?php

namespace Database\Seeders;

use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SensorPortSeeder extends Seeder
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

        DB::table('sensor_ports')->truncate();
        for ($i = 1; $i <= $limit; $i++) {
            DB::table('sensor_ports')->insert([
                'alias_name' => $faker->firstName,
                'port_no' => $i,
                'sensor_id' => rand(1,100),
                'plus_offset' => $this->randomDoubleNumber(),
                'minus_offset' => $this->randomDoubleNumber(),
                'device_id' => rand(1,50),
                'not_round' => rand(0,1),
                'show_digits' => rand(0,2),
                'created_at' => $faker->dateTime()->format('Y-m-d H:i:s'),
                'updated_at' => $faker->dateTime()->format('Y-m-d H:i:s'),
            ]);
        }
    }

    public function randomDoubleNumber()
    {
        $minRange = 1.0;
        $maxRange = 100.0;
        $randomFloatInRange = round($minRange + ($maxRange - $minRange) * rand() / getrandmax(), 2);
        return $randomFloatInRange;
    }
}
