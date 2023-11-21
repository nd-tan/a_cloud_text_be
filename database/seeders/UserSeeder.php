<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->truncate();

        DB::table('users')->insert([
            'username' => 'Admin',
            'password' => Hash::make('12345678'),
            'fullname' => 'Administrator',
            'role' => 1,
            'group_id' => rand(1, 1000),
            'created_at' => Carbon::now()->toDateTimeString(),
            'updated_at' => Carbon::now()->toDateTimeString(),
        ]);

        if (config('app.env') == 'production') {
            return;
        }

        $faker = Factory::create();
        $limit = 50;
        for ($i = 2; $i <= $limit; $i++) {
            DB::table('users')->insert([
                'username' => $faker->firstName,
                'password' => Hash::make('12345678'),
                'fullname' => $faker->name,
                'role' => rand(1,3),
                'note' => $faker->paragraph(6, true),
                'group_id' => rand(1,50),
                'created_at' => $faker->dateTime()->format('Y-m-d H:i:s'),
                'updated_at' => $faker->dateTime()->format('Y-m-d H:i:s'),
            ]);
        }
    }
}
