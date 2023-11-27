<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Http\Controllers\AlertController;
use Illuminate\Database\Seeder;
use Stringable;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            ContractorSeeder::class,
            AccessRightSeeder::class,
            GroupSeeder::class,
            SensorSeeder::class,
            DeviceSeeder::class,
            AlertSeeder::class,
            ConditionSeeder::class,
            ConditionSensorSeeder::class,
            ReceiveDataSeeder::class,
        ]);
    }

}

