<?php

namespace Database\Seeders;

use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ReceiveDataSeeder extends Seeder
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
        $limit = 1000;

        DB::table('receive_data')->truncate();
        for ($i = 2; $i <= $limit; $i++) {
            DB::table('receive_data')->insert([
                'device_id' => rand(1, 100),
                'device_name' => $faker->firstName,
                'contractor_id' => rand(1, 50),
                'group_id' => rand(1, 100),
                'group_name' => $faker->firstName,
                'tm' => $faker->dateTime()->format('Y-m-d H:i:s'),
                'd1_raw' => $this->randomDoubleNumber(),
                'd2_raw' => $this->randomDoubleNumber(),
                'd3_raw' => $this->randomDoubleNumber(),
                'd4_raw' => $this->randomDoubleNumber(),
                'd5_raw' => $this->randomDoubleNumber(),
                'd6_raw' => $this->randomDoubleNumber(),
                'd7_raw' => $this->randomDoubleNumber(),
                'd8_raw' => $this->randomDoubleNumber(),
                'd1_calc' => $this->randomDoubleNumber(),
                'd2_calc' => $this->randomDoubleNumber(),
                'd3_calc' => $this->randomDoubleNumber(),
                'd4_calc' => $this->randomDoubleNumber(),
                'd5_calc' => $this->randomDoubleNumber(),
                'd6_calc' => $this->randomDoubleNumber(),
                'd7_calc' => $this->randomDoubleNumber(),
                'd8_calc' => $this->randomDoubleNumber(),
                'a1_raw' => $this->randomDoubleNumber(),
                'a2_raw' => $this->randomDoubleNumber(),
                'a3_raw' => $this->randomDoubleNumber(),
                'a4_raw' => $this->randomDoubleNumber(),
                'a5_raw' => $this->randomDoubleNumber(),
                'a6_raw' => $this->randomDoubleNumber(),
                'a7_raw' => $this->randomDoubleNumber(),
                'a8_raw' => $this->randomDoubleNumber(),
                'a1_calc' => $this->randomDoubleNumber(),
                'a2_calc' => $this->randomDoubleNumber(),
                'a3_calc' => $this->randomDoubleNumber(),
                'a4_calc' => $this->randomDoubleNumber(),
                'a5_calc' => $this->randomDoubleNumber(),
                'a6_calc' => $this->randomDoubleNumber(),
                'a7_calc' => $this->randomDoubleNumber(),
                'a8_calc' => $this->randomDoubleNumber(),
                'adgp' => rand(1, 100),
                'eitemp' => $this->randomDoubleNumber(),
                'eihumi' => $this->randomDoubleNumber(),
                'eilprs' => $this->randomDoubleNumber(),
                'seaprs' => $this->randomDoubleNumber(),
                'msg' => $faker->paragraph(1, true),
                'rping' => rand(1, 100),
                'created_at' => $faker->dateTime()->format('Y-m-d H:i:s'),
                'updated_at' => $faker->dateTime()->format('Y-m-d H:i:s'),
            ]);
        }
    }

    public function randomDoubleNumber()
    {
        $minRange = 1.0;
        $maxRange = 1000.0;
        $randomFloatInRange = round($minRange + ($maxRange - $minRange) * rand() / getrandmax(), 2);
        return $randomFloatInRange;
    }
}
