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
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
