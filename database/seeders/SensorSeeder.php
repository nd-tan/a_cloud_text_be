<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SensorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 1; $i <= 500; $i++) {
            DB::table('sensors')->insert([
                'contractor_id' => rand(1, 51),
                'name' => 'Sensor ' . $i,
                'maker' => 'Maker ' . $i,
                'model_number' => 'Model ' . $i,
                'interface' => rand(0, 2),
                'calc' => 'Calculation ' . $i,
                'unit' => 'Unit ' . $i,
                'remark' => 'Remark ' . $i,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
