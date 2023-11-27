<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class GroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if (config('app.env') == 'production') {
            return;
        }

        DB::table('groups')->truncate();
        for($i = 0; $i <= 500; $i++) {
            DB::table('groups')->insert([
                'group_id' => null,
                'contractor_id' => rand(1, 51),
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

        for($i = 1; $i <= 51; $i++) {
            $group =  DB::table('groups')->where('contractor_id',$i)->first();
            DB::table('groups')->insert([
                'group_id' => $group->id,
                'contractor_id' =>  $group->contractor_id,
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
    }
}
