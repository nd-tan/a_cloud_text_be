<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class AccessRightSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for($i = 0; $i <= 500; $i++) {
            DB::table('access_rights')->insert([
                'contractor_id' => rand(1, 51),
                'remark' => Str::random(10),
                'name' => Str::random(10),
                'access_rights' => rand(0, 2),
                'dashboard' => rand(0, 2),
                'data' => rand(0, 2),
                'data_export' => rand(0, 2),
                'device' => rand(0, 2),
                'alert' => rand(0, 2),
                'alert_mail' => rand(0, 2),
                'sensor' => rand(0, 2),
                'account' => rand(0, 2),
                'groups' => rand(0, 2),
                'test' => rand(0, 2),
            ]);
        }
    }
}
