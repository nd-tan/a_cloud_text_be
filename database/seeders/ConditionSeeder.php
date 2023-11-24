<?php

namespace Database\Seeders;

use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ConditionSeeder extends Seeder
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

        DB::table('conditions')->truncate();
        for ($i = 2; $i <= $limit; $i++) {
            DB::table('conditions')->insert([
                'name' => $faker->firstName,
                'condition' => rand(1,3),
                'device_id' => rand(1, 100),
                'sensor_port_name' => $faker->firstName,
                'status' => $faker->firstName,
                'created_at' => $faker->dateTime()->format('Y-m-d H:i:s'),
                'updated_at' => $faker->dateTime()->format('Y-m-d H:i:s'),
            ]);
        }
    }
}
