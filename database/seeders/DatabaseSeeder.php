<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(PlaneTypesSeeder::class);
        $this->call(PlanesSeeder::class);
        $this->call(SeatLocationsSeeder::class);
        $this->call(SeatsSeeder::class);
        $this->call(SubRowLocationsSeeder::class);
        $this->call(SingleRowSeatsMapSeeder::class);
    }
}
