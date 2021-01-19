<?php

namespace Database\Seeders;

use Carbon\Carbon;
use DB;
use Illuminate\Database\Seeder;

class SingleRowSeatsMapSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('single_row_seats_map')->delete();

        DB::table('single_row_seats_map')->insert([
                [
                    'id' => 1,
                    'seat_id' => 1,
                    'sub_row_location_id' => 1,
                    'plane_type_id' => 1,
                    'seat_location_id' => 1,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ],
                [
                    'id' => 2,
                    'seat_id' => 2,
                    'sub_row_location_id' => 1,
                    'plane_type_id' => 1,
                    'seat_location_id' => 3,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ],
                [
                    'id' => 3,
                    'seat_id' => 3,
                    'sub_row_location_id' => 1,
                    'plane_type_id' => 1,
                    'seat_location_id' => 2,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ],

                [
                    'id' => 4,
                    'seat_id' => 6,
                    'sub_row_location_id' => 2,
                    'plane_type_id' => 1,
                    'seat_location_id' => 1,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ],
                [
                    'id' => 5,
                    'seat_id' => 5,
                    'sub_row_location_id' => 2,
                    'plane_type_id' => 1,
                    'seat_location_id' => 3,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ],
                [
                    'id' => 6,
                    'seat_id' => 4,
                    'sub_row_location_id' => 2,
                    'plane_type_id' => 1,
                    'seat_location_id' => 2,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ],
            ]
        );
    }
}
