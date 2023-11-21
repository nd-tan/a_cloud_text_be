<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ContractorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for($i = 0; $i <= 50; $i++) {
            DB::table('contractors')->insert([
                'name' => Str::random(10),
                'postal_code' => Str::random(10),
                'address' => Str::random(10),
                'phone_number' => rand(0, 999999999),
                'person' => Str::random(10),
                'start_date' => Carbon::now()->subMinutes(rand(1, 55)),
                'end_date' => Carbon::now()->subMinutes(rand(1, 55)),
                'remark' => Str::random(10),
            ]);
    }
    }
}