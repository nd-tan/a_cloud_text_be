<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Stringable;
use Illuminate\Support\Str;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
//        for($i = 0; $i <= 20; $i++) {
//            DB::table('contractors')->insert([
//                'name' => Str::random(10),
//                'postal_code' => Str::random(10),
//                'address' => Str::random(10),
//                'phone_number' => rand(0, 999999999),
//                'person' => Str::random(10),
//                'start_date' => Carbon::now()->subMinutes(rand(1, 55)),
//                'end_date' => Carbon::now()->subMinutes(rand(1, 55)),
//                'remark' => Str::random(10),
//            ]);
//        }
//
//        for($i = 0; $i <= 500; $i++) {
//            DB::table('access_rights')->insert([
//                'contractor_id' => rand(1, 20),
//                'remark' => Str::random(10),
//                'name' => Str::random(10),
//                'access_rights' => rand(0, 2),
//                'dashboard' => rand(0, 2),
//                'data' => rand(0, 2),
//                'data_export' => rand(0, 2),
//                'device' => rand(0, 2),
//                'alert' => rand(0, 2),
//                'alert_mail' => rand(0, 2),
//                'sensor' => rand(0, 2),
//                'account' => rand(0, 2),
//                'groups' => rand(0, 2),
//                'test' => rand(0, 2),
//            ]);
//        }

        DB::table('groups')->truncate();
        for($i = 0; $i <= 50; $i++) {
            DB::table('groups')->insert([
                'group_id' => null,
                'contractor_id' => rand(1, 20),
                'name' => Str::random(10),
                'path' => '',
                'info_board' => Str::random(20),
                'latitude' => rand(-90, 90),
                'longitude' => rand(-180, 180),
                'group_week' => '[]',
                'group_start_time' => date('H:i:s', rand(0, 86399)), // Random time within a day
                'group_end_time' => date('H:i:s', rand(0, 86399)),
                'break_start_time1' => date('H:i:s', rand(0, 86399)),
                'break_end_time1' => date('H:i:s', rand(0, 86399)),
                'break_start_time2' => date('H:i:s', rand(0, 86399)),
                'break_end_time2' => date('H:i:s', rand(0, 86399)),
                'break_start_time3' => date('H:i:s', rand(0, 86399)),
                'break_end_time3' => date('H:i:s', rand(0, 86399)),
                'remark' => Str::random(30),
            ]);
        }

//        for($i = 0; $i <= 500; $i++) {
//            DB::table('groups')->insert([
//                'group_id' => rand(1, 500),
//                'contractor_id' => rand(1, 51),
//                'name' => Str::random(10),
//                'path' => '',
//                'info_board' => Str::random(20),
//                'latitude' => rand(-90, 90),
//                'longitude' => rand(-180, 180),
//                'group_week' => '[]',
//                'group_start_time' => date('H:i:s', rand(0, 86399)), // Random time within a day
//                'group_end_time' => date('H:i:s', rand(0, 86399)),
//                'break_start_time1' => date('H:i:s', rand(0, 86399)),
//                'break_end_time1' => date('H:i:s', rand(0, 86399)),
//                'break_start_time2' => date('H:i:s', rand(0, 86399)),
//                'break_end_time2' => date('H:i:s', rand(0, 86399)),
//                'break_start_time3' => date('H:i:s', rand(0, 86399)),
//                'break_end_time3' => date('H:i:s', rand(0, 86399)),
//                'remark' => Str::random(30),
//            ]);
//        }
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
