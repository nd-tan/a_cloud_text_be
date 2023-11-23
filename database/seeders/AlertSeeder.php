<?php

namespace Database\Seeders;

use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AlertSeeder extends Seeder
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

        DB::table('alerts')->truncate();
        for ($i = 2; $i <= $limit; $i++) {
            DB::table('alerts')->insert([
                'name' => $faker->firstName,
                'status' => rand(0,1),
                'condition' => rand(1,3),
                'state' => rand(0,1),
                'device_id' => rand(1,50),
                'email_contents' => $faker->paragraph(3, true),
                'email_sending' => rand(0,1),
                'type' => rand(1,4),
                'priority' => rand(0,100),
                'created_at' => $faker->dateTime()->format('Y-m-d H:i:s'),
                'updated_at' => $faker->dateTime()->format('Y-m-d H:i:s'),
            ]);
        }
    }
}
