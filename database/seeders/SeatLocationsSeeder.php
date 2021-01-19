<?php

namespace Database\Seeders;

use Carbon\Carbon;
use DB;
use Illuminate\Database\Seeder;

class SeatLocationsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('seat_locations')->delete();

        DB::table('seat_locations')->insert([
                [
                    'id' => 1,
                    'name' => 'window',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ],
                [
                    'id' => 2,
                    'name' => 'aisle',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ],
                [
                    'id' => 3,
                    'name' => 'other',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ],
            ]
        );
    }
}
