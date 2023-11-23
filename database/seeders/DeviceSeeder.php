<?php

namespace Database\Seeders;

use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DeviceSeeder extends Seeder
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

        DB::table('devices')->truncate();
        for ($i = 2; $i <= $limit; $i++) {
            $contractorId = rand(1, 50);
            DB::table('devices')->insert([
                'device_string' => $faker->firstName,
                'contractor_id' => $contractorId,
                'group_id' => $this->getGroupId($contractorId),
                'product_id' => rand(1,50),
                'name' => $faker->firstName,
                'state' => rand(0,1),
                'is_exit' => rand(0,1),
                'is_virtual' => rand(0,1),
                'email_week' => $faker->paragraph(1, true),
                'email_start_time' => $faker->dateTime()->format('Y-m-d H:i:s'),
                'email_end_time' => $faker->dateTime()->format('Y-m-d H:i:s'),
                'email_resent_time' => rand(0,60),
                'state_time' => $faker->dateTime()->format('Y-m-d H:i:s'),
                'truble_sending' => rand(0,1),
                'machine_week' => $faker->paragraph(1, true),
                'machine_start_time' => $faker->dateTime()->format('Y-m-d H:i:s'),
                'machine_end_time' => $faker->dateTime()->format('Y-m-d H:i:s'),
                'show_sum_time1' => rand(0,1),
                'show_sum_time2' => rand(0,1),
                'break_start_time1' => $faker->dateTime()->format('Y-m-d H:i:s'),
                'break_end_time1' => $faker->dateTime()->format('Y-m-d H:i:s'),
                'break_start_time2' => $faker->dateTime()->format('Y-m-d H:i:s'),
                'break_end_time2' => $faker->dateTime()->format('Y-m-d H:i:s'),
                'break_start_time3' => $faker->dateTime()->format('Y-m-d H:i:s'),
                'break_end_time3' => $faker->dateTime()->format('Y-m-d H:i:s'),
                'remark' => $faker->paragraph(1, true),
                'created_at' => $faker->dateTime()->format('Y-m-d H:i:s'),
                'updated_at' => $faker->dateTime()->format('Y-m-d H:i:s'),
            ]);
        }
    }

    protected function getGroupId($contractorId) {
        $groups = DB::table('groups')->where('contractor_id', $contractorId)
            ->pluck('id')->toArray();
        $index = rand(0, sizeof($groups) - 1);
        $groupId = $groups[$index];
        return $groupId;
    }
}
